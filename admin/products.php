<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

const BADGE_COLORS = ['red', 'navy', 'green', 'blue'];
const IMAGE_EXTS = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
const PDF_EXTS = ['pdf'];
const IMAGE_DIR = __DIR__ . '/../assets/images';
const CATALOG_DIR = __DIR__ . '/../assets/catalogs';

// Categories are managed from admin/categories.php — add/edit/remove them there.
$allCategories = db_all('SELECT slug, name FROM categories ORDER BY sort_order, name');
$categoryNames = array_column($allCategories, 'name', 'slug');
$categorySlugsValid = array_column($allCategories, 'slug');

// The 4 vehicle types are the "boss" categories — pin them to the top of the
// category dropdown, ahead of the open-ended parts categories.
usort($allCategories, function ($a, $b) {
    $aVehicle = in_array($a['slug'], VEHICLE_CATEGORY_SLUGS, true);
    $bVehicle = in_array($b['slug'], VEHICLE_CATEGORY_SLUGS, true);
    if ($aVehicle !== $bVehicle) {
        return $aVehicle ? -1 : 1;
    }
    return 0; // preserve the existing sort_order/name order within each group
});

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$flash = '';
$errors = [];

// A POST that blows past PHP's post_max_size arrives with $_POST and $_FILES
// silently emptied out — no per-field upload error to catch, the form just
// looks like it did nothing. Catch that case directly so there's a clear
// reason shown instead of a confusing, unexplained failure.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && empty($_FILES) && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
    $pageTitle = 'Products';
    $activeAdminNav = 'products';
    require __DIR__ . '/includes/chrome-top.php';
    echo '<div class="flash flash--err">The file you tried to upload is too large for this server to accept. Try a smaller file, or ask your hosting provider to raise the upload size limit (upload_max_filesize / post_max_size).</div>';
    echo '<p><a class="btn btn--ghost btn--sm" href="products.php">&larr; Back to list</a></p>';
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// ---- delete ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    db_run('DELETE FROM products WHERE id = ?', [(int) $_POST['delete_id']]);
    header('Location: products.php?deleted=1');
    exit;
}

// ---- delete one gallery image ---------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_gallery_id'])) {
    $gid = (int) $_POST['delete_gallery_id'];
    $backToId = (int) $_POST['product_id'];
    $row = db_one('SELECT image FROM product_images WHERE id = ?', [$gid]);
    if ($row) {
        db_run('DELETE FROM product_images WHERE id = ?', [$gid]);
        @unlink(IMAGE_DIR . '/' . $row['image']);
    }
    header('Location: products.php?action=edit&id=' . $backToId . '&gallery_updated=1');
    exit;
}

// ---- add gallery images to an existing product -----------------------
// Kept separate from the main save below so adding a photo never has to
// re-validate/re-save every other field on the product.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_gallery_images'])) {
    $pid = (int) $_POST['product_id'];
    $galleryErrors = [];
    if ($pid && !empty($_FILES['gallery_images']['name'][0])) {
        $nextOrder = (int) (db_one('SELECT COALESCE(MAX(sort_order), 0) AS m FROM product_images WHERE product_id = ?', [$pid])['m']);
        foreach ($_FILES['gallery_images']['name'] as $i => $name) {
            $file = [
                'name'     => $_FILES['gallery_images']['name'][$i],
                'type'     => $_FILES['gallery_images']['type'][$i],
                'tmp_name' => $_FILES['gallery_images']['tmp_name'][$i],
                'error'    => $_FILES['gallery_images']['error'][$i],
                'size'     => $_FILES['gallery_images']['size'][$i],
            ];
            $filename = save_uploaded_file($file, IMAGE_DIR, IMAGE_EXTS, true, $galleryError);
            if ($filename !== null) {
                $nextOrder += 10;
                db_run('INSERT INTO product_images (product_id, image, sort_order) VALUES (?,?,?)', [$pid, $filename, $nextOrder]);
            } elseif ($galleryError !== null) {
                $galleryErrors[] = ($name ?: 'A file') . ': ' . $galleryError;
            }
        }
    }
    if ($galleryErrors) {
        $_SESSION['gallery_errors'] = $galleryErrors;
    }
    header('Location: products.php?action=edit&id=' . $pid . '&gallery_updated=1');
    exit;
}

// ---- create / update --------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_product'])) {
    $editingId = $_POST['id'] !== '' ? (int) $_POST['id'] : null;
    $existing = $editingId ? db_one('SELECT * FROM products WHERE id = ?', [$editingId]) : null;

    $data = [
        'category'    => trim((string) ($_POST['category'] ?? '')),
        'name'        => trim((string) ($_POST['name'] ?? '')),
        'cat_label'   => trim((string) ($_POST['cat_label'] ?? '')),
        'spec'        => trim((string) ($_POST['spec'] ?? '')),
        'description' => trim((string) ($_POST['description'] ?? '')),
        'badge_text'  => trim((string) ($_POST['badge_text'] ?? '')),
        'badge_color' => in_array($_POST['badge_color'] ?? '', BADGE_COLORS, true) ? $_POST['badge_color'] : 'navy',
        'featured'    => isset($_POST['featured']) ? 1 : 0,
        'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
    ];

    // New file uploads are optional — keep the existing file if none was chosen.
    $uploadedImage = save_uploaded_file($_FILES['image_file'] ?? [], IMAGE_DIR, IMAGE_EXTS, true, $imageError);
    $data['image'] = $uploadedImage ?? ($existing['image'] ?? '');
    if ($imageError !== null) {
        $errors[] = 'Main image: ' . $imageError;
    }

    $uploadedPdf = save_uploaded_file($_FILES['catalog_pdf_file'] ?? [], CATALOG_DIR, PDF_EXTS, false, $pdfError);
    $data['catalog_pdf'] = $uploadedPdf ?? ($existing['catalog_pdf'] ?? '');
    if ($pdfError !== null) {
        $errors[] = 'Catalog PDF: ' . $pdfError;
    }

    if (!in_array($data['category'], $categorySlugsValid, true)) {
        $errors[] = 'Please choose a valid category.';
    }
    if ($data['name'] === '') {
        $errors[] = 'Name is required.';
    }
    if ($data['cat_label'] === '') {
        $errors[] = 'Card label is required.';
    }
    if ($data['spec'] === '') {
        $errors[] = 'Spec line is required.';
    }

    if (!$errors) {
        $slug = unique_slug($data['name'], 'products', $editingId);
        if ($editingId) {
            db_run(
                'UPDATE products SET category=?, name=?, slug=?, cat_label=?, spec=?, description=?, badge_text=?, badge_color=?, image=?, catalog_pdf=?, featured=?, sort_order=? WHERE id=?',
                [$data['category'], $data['name'], $slug, $data['cat_label'], $data['spec'], $data['description'], $data['badge_text'], $data['badge_color'], $data['image'], $data['catalog_pdf'], $data['featured'], $data['sort_order'], $editingId]
            );
            $productId = $editingId;
        } else {
            db_run(
                'INSERT INTO products (category, name, slug, cat_label, spec, description, badge_text, badge_color, image, catalog_pdf, featured, sort_order) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)',
                [$data['category'], $data['name'], $slug, $data['cat_label'], $data['spec'], $data['description'], $data['badge_text'], $data['badge_color'], $data['image'], $data['catalog_pdf'], $data['featured'], $data['sort_order']]
            );
            $productId = (int) db()->lastInsertId();
        }

        // Specs — full replace: drop the old rows, insert whatever was submitted.
        db_run('DELETE FROM product_specs WHERE product_id = ?', [$productId]);
        $specLabels = $_POST['spec_label'] ?? [];
        $specValues = $_POST['spec_value'] ?? [];
        $specOrder = 0;
        foreach ($specLabels as $i => $label) {
            $label = trim((string) $label);
            $value = trim((string) ($specValues[$i] ?? ''));
            if ($label === '' || $value === '') {
                continue;
            }
            $specOrder += 10;
            db_run('INSERT INTO product_specs (product_id, label, value, sort_order) VALUES (?,?,?,?)', [$productId, $label, $value, $specOrder]);
        }

        // Gallery photos — append any newly uploaded ones after existing sort orders.
        if (!empty($_FILES['gallery_images']['name'][0])) {
            $nextOrder = (int) (db_one('SELECT COALESCE(MAX(sort_order), 0) AS m FROM product_images WHERE product_id = ?', [$productId])['m']);
            $galleryErrors = [];
            foreach ($_FILES['gallery_images']['name'] as $i => $name) {
                $file = [
                    'name'     => $_FILES['gallery_images']['name'][$i],
                    'type'     => $_FILES['gallery_images']['type'][$i],
                    'tmp_name' => $_FILES['gallery_images']['tmp_name'][$i],
                    'error'    => $_FILES['gallery_images']['error'][$i],
                    'size'     => $_FILES['gallery_images']['size'][$i],
                ];
                $filename = save_uploaded_file($file, IMAGE_DIR, IMAGE_EXTS, true, $galleryError);
                if ($filename !== null) {
                    $nextOrder += 10;
                    db_run('INSERT INTO product_images (product_id, image, sort_order) VALUES (?,?,?)', [$productId, $filename, $nextOrder]);
                } elseif ($galleryError !== null) {
                    $galleryErrors[] = ($name ?: 'A file') . ': ' . $galleryError;
                }
            }
            if ($galleryErrors) {
                $_SESSION['gallery_errors'] = $galleryErrors;
            }
        }

        header('Location: products.php?saved=1');
        exit;
    }

    // Validation failed — fall through to re-render the form with $data + $errors.
    $action = $editingId ? 'edit' : 'new';
    $id = $editingId;
}

$pageTitle = 'Products';
$activeAdminNav = 'products';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['saved'])) echo '<div class="flash flash--ok">Product saved.</div>';
if (isset($_GET['deleted'])) echo '<div class="flash flash--ok">Product deleted.</div>';
foreach ($errors as $e) echo '<div class="flash flash--err">' . h($e) . '</div>';
if (!empty($_SESSION['gallery_errors'])) {
    foreach ($_SESSION['gallery_errors'] as $ge) echo '<div class="flash flash--err">' . h($ge) . '</div>';
    unset($_SESSION['gallery_errors']);
}

// =====================================================================
// FORM (new / edit)
// =====================================================================
if ($action === 'new' || $action === 'edit') {
    $product = $data ?? ($id ? db_one('SELECT * FROM products WHERE id = ?', [$id]) : null);
    $product = $product ?? ['category' => 'bicycle', 'name' => '', 'cat_label' => '', 'spec' => '', 'description' => '', 'badge_text' => '', 'badge_color' => 'navy', 'image' => '', 'catalog_pdf' => '', 'featured' => 0, 'sort_order' => 0];
    $gallery = $id ? db_all('SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order, id', [$id]) : [];
    // On a validation-failure re-render, rebuild the rows from what was just
    // submitted so nothing the admin typed gets lost; otherwise load from the DB.
    if (isset($_POST['spec_label'])) {
        $specs = [];
        foreach ($_POST['spec_label'] as $i => $label) {
            $specs[] = ['label' => $label, 'value' => $_POST['spec_value'][$i] ?? ''];
        }
    } else {
        $specs = $id ? db_all('SELECT * FROM product_specs WHERE product_id = ? ORDER BY sort_order, id', [$id]) : [];
    }
    ?>
    <div class="admin-head">
      <div><h1><?= $id ? 'Edit Product' : 'Add Product' ?></h1></div>
      <a class="btn btn--ghost btn--sm" href="products.php">&larr; Back to list</a>
    </div>

    <?php if (isset($_GET['gallery_updated'])): ?><div class="flash flash--ok">Gallery updated.</div><?php endif; ?>

    <div class="card" style="max-width:640px">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="save_product" value="1">
        <input type="hidden" name="id" value="<?= h((string) ($id ?? '')) ?>">

        <div class="form-grid">
          <div class="field">
            <label for="category">Category</label>
            <select id="category" name="category">
              <optgroup label="★ Vehicle Categories">
                <?php foreach ($allCategories as $c): ?>
                  <?php if (!in_array($c['slug'], VEHICLE_CATEGORY_SLUGS, true)) continue; ?>
                  <option value="<?= h($c['slug']) ?>" <?= $product['category'] === $c['slug'] ? 'selected' : '' ?>><?= h($c['name']) ?></option>
                <?php endforeach; ?>
              </optgroup>
              <optgroup label="Parts & Other Categories">
                <?php foreach ($allCategories as $c): ?>
                  <?php if (in_array($c['slug'], VEHICLE_CATEGORY_SLUGS, true)) continue; ?>
                  <option value="<?= h($c['slug']) ?>" <?= $product['category'] === $c['slug'] ? 'selected' : '' ?>><?= h($c['name']) ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
            <small>Need a new one? <a href="categories.php?action=new" target="_blank" rel="noopener">Add a category</a>.</small>
          </div>
          <div class="field">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= h($product['name']) ?>" placeholder="e.g. HN-B200 Urban" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="field">
            <label for="cat_label">Card Label</label>
            <input type="text" id="cat_label" name="cat_label" value="<?= h($product['cat_label']) ?>" placeholder="e.g. E-BICYCLE" required>
          </div>
          <div class="field">
            <label for="spec">Spec Line</label>
            <input type="text" id="spec" name="spec" value="<?= h($product['spec']) ?>" placeholder="e.g. 500W Motor · 48V · 80km Range" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="field">
            <label for="badge_text">Badge Text</label>
            <input type="text" id="badge_text" name="badge_text" value="<?= h($product['badge_text']) ?>" placeholder="e.g. BEST SELLER (optional)">
          </div>
          <div class="field">
            <label for="badge_color">Badge Color</label>
            <select id="badge_color" name="badge_color">
              <?php foreach (BADGE_COLORS as $c): ?>
                <option value="<?= $c ?>" <?= $product['badge_color'] === $c ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="field">
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="5" placeholder="Full product description shown on its detail page. Leave a blank line between paragraphs."><?= h($product['description'] ?? '') ?></textarea>
        </div>

        <div class="field">
          <label>Specifications</label>
          <small style="display:block;margin-bottom:8px">Add whatever fields make sense for this product — Motor, Battery, Range, Colors, Certification, etc. Blank rows are ignored.</small>
          <div id="specRows">
            <?php foreach ($specs as $s): ?>
              <div class="spec-row" style="display:flex;gap:8px;margin-bottom:8px">
                <input type="text" name="spec_label[]" value="<?= h($s['label']) ?>" placeholder="e.g. Battery" style="flex:1">
                <input type="text" name="spec_value[]" value="<?= h($s['value']) ?>" placeholder="e.g. 48V 20Ah Lithium" style="flex:1.4">
                <button type="button" class="btn btn--ghost btn--sm" onclick="this.closest('.spec-row').remove()">Remove</button>
              </div>
            <?php endforeach; ?>
            <div class="spec-row" style="display:flex;gap:8px;margin-bottom:8px">
              <input type="text" name="spec_label[]" placeholder="e.g. Battery" style="flex:1">
              <input type="text" name="spec_value[]" placeholder="e.g. 48V 20Ah Lithium" style="flex:1.4">
              <button type="button" class="btn btn--ghost btn--sm" onclick="this.closest('.spec-row').remove()">Remove</button>
            </div>
          </div>
          <button type="button" class="btn btn--ghost btn--sm" id="addSpecRow">+ Add Spec</button>
        </div>

        <div class="field">
          <label for="image_file">Main Image</label>
          <?php if ($product['image'] !== ''): ?>
            <div style="margin-bottom:8px">
              <img class="thumb" src="../assets/images/<?= h($product['image']) ?>" alt="" style="height:60px;width:auto">
            </div>
          <?php endif; ?>
          <input type="file" id="image_file" name="image_file" accept=".jpg,.jpeg,.png,.webp,.gif">
          <small><?= $product['image'] !== '' ? 'Choose a file to replace the current image, or leave blank to keep it.' : 'Leave blank to show a placeholder.' ?></small>
        </div>

        <div class="field">
          <label for="catalog_pdf_file">Catalog PDF</label>
          <?php if (($product['catalog_pdf'] ?? '') !== ''): ?>
            <p style="margin:0 0 8px"><a href="../assets/catalogs/<?= h($product['catalog_pdf']) ?>" target="_blank" rel="noopener">Current file &#8599;</a></p>
          <?php endif; ?>
          <input type="file" id="catalog_pdf_file" name="catalog_pdf_file" accept=".pdf">
          <small>Optional. Shown as a "Download Catalog" button on the product page.</small>
        </div>

        <?php if (!$id): ?>
        <div class="field">
          <label>Gallery Images</label>
          <small style="display:block;margin-bottom:8px">Optional — one photo per box below, add as many as you like. Works the same whether your file picker supports multi-select or not. You can also add more later from the edit screen.</small>
          <div class="gallery-slots" id="gallerySlotsNew">
            <?php for ($i = 0; $i < 6; $i++): ?>
              <div class="gallery-slot">
                <input type="file" name="gallery_images[]" accept=".jpg,.jpeg,.png,.webp,.gif" class="gallery-slot__input">
                <img class="gallery-slot__preview" alt="" hidden>
              </div>
            <?php endfor; ?>
          </div>
        </div>
        <?php endif; ?>

        <div class="form-grid">
          <div class="field">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="<?= h((string) $product['sort_order']) ?>">
            <small>Lower numbers appear first.</small>
          </div>
          <div class="field">
            <label>&nbsp;</label>
            <label class="checkbox-row">
              <input type="checkbox" name="featured" <?= $product['featured'] ? 'checked' : '' ?>>
              Show in homepage "Popular Models"
            </label>
          </div>
        </div>

        <button type="submit" class="btn btn--red"><?= $id ? 'Save Changes' : 'Add Product' ?></button>
      </form>
    </div>

    <?php if ($id): ?>
    <div class="card" style="max-width:640px;margin-top:20px">
      <h2 style="font-size:16px;margin:0 0 6px">Gallery Images</h2>
      <p style="margin:0 0 14px;color:var(--muted);font-size:13.5px">Extra photos shown on this product's public detail page.</p>

      <?php if ($gallery): ?>
        <div style="display:flex;flex-wrap:wrap;gap:14px;margin-bottom:16px">
          <?php foreach ($gallery as $g): ?>
            <div style="text-align:center">
              <img class="thumb" src="../assets/images/<?= h($g['image']) ?>" alt="" style="display:block;margin-bottom:6px;width:90px;height:60px">
              <form method="post" onsubmit="return confirm('Remove this gallery image?');">
                <input type="hidden" name="delete_gallery_id" value="<?= (int) $g['id'] ?>">
                <input type="hidden" name="product_id" value="<?= (int) $id ?>">
                <button type="submit" class="btn btn--ghost btn--sm">Delete</button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p style="margin:0 0 14px;color:var(--muted);font-size:13.5px">No gallery images yet.</p>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="add_gallery_images" value="1">
        <input type="hidden" name="product_id" value="<?= (int) $id ?>">
        <div class="field">
          <label>Add Photos</label>
          <small style="display:block;margin-bottom:8px">One photo per box below, add as many as you like — they're all added to the gallery together, not replaced.</small>
          <div class="gallery-slots" id="gallerySlotsEdit">
            <?php for ($i = 0; $i < 6; $i++): ?>
              <div class="gallery-slot">
                <input type="file" name="gallery_images[]" accept=".jpg,.jpeg,.png,.webp,.gif" class="gallery-slot__input">
                <img class="gallery-slot__preview" alt="" hidden>
              </div>
            <?php endfor; ?>
          </div>
        </div>
        <button type="submit" class="btn btn--red">Upload</button>
      </form>
    </div>
    <?php endif; ?>

    <script>
      document.getElementById('addSpecRow').addEventListener('click', function () {
        var row = document.createElement('div');
        row.className = 'spec-row';
        row.style.cssText = 'display:flex;gap:8px;margin-bottom:8px';
        row.innerHTML =
          '<input type="text" name="spec_label[]" placeholder="e.g. Battery" style="flex:1">' +
          '<input type="text" name="spec_value[]" placeholder="e.g. 48V 20Ah Lithium" style="flex:1.4">' +
          '<button type="button" class="btn btn--ghost btn--sm" onclick="this.closest(\'.spec-row\').remove()">Remove</button>';
        document.getElementById('specRows').appendChild(row);
      });

      // Each gallery box is its own single-file input, so multi-image adds
      // work identically everywhere — no dependency on a device/browser's
      // native multi-select gesture. Show a thumbnail as each one is filled.
      document.querySelectorAll('.gallery-slot__input').forEach(function (input) {
        input.addEventListener('change', function () {
          var preview = input.nextElementSibling;
          var file = input.files[0];
          if (file && file.type.startsWith('image/')) {
            preview.src = URL.createObjectURL(file);
            preview.hidden = false;
          } else {
            preview.hidden = true;
          }
        });
      });
    </script>
    <?php
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// =====================================================================
// LIST
// =====================================================================
$products = db_all('SELECT * FROM products ORDER BY category, sort_order, id');
?>

<div class="admin-head">
  <div>
    <h1>Products</h1>
    <p>Vehicles and parts shown on the homepage and category pages.</p>
  </div>
  <div style="display:flex;gap:10px">
    <a class="btn btn--ghost" href="categories.php">Categories</a>
    <a class="btn btn--red" href="products.php?action=new">+ Add Product</a>
  </div>
</div>

<?php if (!$products): ?>
  <div class="card empty">No products yet. <a href="products.php?action=new">Add your first one</a>.</div>
<?php else: ?>
  <table class="list">
    <thead>
      <tr><th></th><th>Name</th><th>Category</th><th>Badge</th><th>Featured</th><th>Order</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><img class="thumb" src="../assets/images/<?= h($p['image']) ?>" alt="" onerror="this.style.visibility='hidden'"></td>
          <td><strong><?= h($p['name']) ?></strong><br><span style="color:var(--muted)"><?= h($p['spec']) ?></span></td>
          <td><?= h($categoryNames[$p['category']] ?? $p['category']) ?></td>
          <td><?= $p['badge_text'] !== '' ? '<span class="pill-badge">' . h($p['badge_text']) . '</span>' : '—' ?></td>
          <td><span class="pill-badge<?= $p['featured'] ? ' pill-badge--on' : '' ?>"><?= $p['featured'] ? 'Yes' : 'No' ?></span></td>
          <td><?= (int) $p['sort_order'] ?></td>
          <td class="actions">
            <a class="btn btn--ghost btn--sm" href="products.php?action=edit&id=<?= (int) $p['id'] ?>">Edit</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Delete this product?');">
              <input type="hidden" name="delete_id" value="<?= (int) $p['id'] ?>">
              <button type="submit" class="btn btn--ghost btn--sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php require __DIR__ . '/includes/chrome-bottom.php'; ?>
