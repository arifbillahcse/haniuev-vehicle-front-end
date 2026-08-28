<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

const CATEGORIES = [
    'tricycle'     => 'Tricycle',
    'bicycle'      => 'Bicycle',
    'motorcycle'   => 'Motorcycle',
    'four-wheeler' => 'Four-Wheeler',
    'motor'        => 'Motor',
    'controller'   => 'Controller',
];
const BADGE_COLORS = ['red', 'navy', 'green', 'blue'];

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$flash = '';
$errors = [];

// ---- delete ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    db_run('DELETE FROM products WHERE id = ?', [(int) $_POST['delete_id']]);
    header('Location: products.php?deleted=1');
    exit;
}

// ---- create / update --------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_product'])) {
    $editingId = $_POST['id'] !== '' ? (int) $_POST['id'] : null;

    $data = [
        'category'    => trim((string) ($_POST['category'] ?? '')),
        'name'        => trim((string) ($_POST['name'] ?? '')),
        'cat_label'   => trim((string) ($_POST['cat_label'] ?? '')),
        'spec'        => trim((string) ($_POST['spec'] ?? '')),
        'badge_text'  => trim((string) ($_POST['badge_text'] ?? '')),
        'badge_color' => in_array($_POST['badge_color'] ?? '', BADGE_COLORS, true) ? $_POST['badge_color'] : 'navy',
        'image'       => trim((string) ($_POST['image'] ?? '')),
        'featured'    => isset($_POST['featured']) ? 1 : 0,
        'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
    ];

    if (!array_key_exists($data['category'], CATEGORIES)) {
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
                'UPDATE products SET category=?, name=?, slug=?, cat_label=?, spec=?, badge_text=?, badge_color=?, image=?, featured=?, sort_order=? WHERE id=?',
                [$data['category'], $data['name'], $slug, $data['cat_label'], $data['spec'], $data['badge_text'], $data['badge_color'], $data['image'], $data['featured'], $data['sort_order'], $editingId]
            );
        } else {
            db_run(
                'INSERT INTO products (category, name, slug, cat_label, spec, badge_text, badge_color, image, featured, sort_order) VALUES (?,?,?,?,?,?,?,?,?,?)',
                [$data['category'], $data['name'], $slug, $data['cat_label'], $data['spec'], $data['badge_text'], $data['badge_color'], $data['image'], $data['featured'], $data['sort_order']]
            );
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

// =====================================================================
// FORM (new / edit)
// =====================================================================
if ($action === 'new' || $action === 'edit') {
    $product = $data ?? ($id ? db_one('SELECT * FROM products WHERE id = ?', [$id]) : null);
    $product = $product ?? ['category' => 'bicycle', 'name' => '', 'cat_label' => '', 'spec' => '', 'badge_text' => '', 'badge_color' => 'navy', 'image' => '', 'featured' => 0, 'sort_order' => 0];
    ?>
    <div class="admin-head">
      <div><h1><?= $id ? 'Edit Product' : 'Add Product' ?></h1></div>
      <a class="btn btn--ghost btn--sm" href="products.php">&larr; Back to list</a>
    </div>

    <div class="card" style="max-width:640px">
      <form method="post">
        <input type="hidden" name="save_product" value="1">
        <input type="hidden" name="id" value="<?= h((string) ($id ?? '')) ?>">

        <div class="form-grid">
          <div class="field">
            <label for="category">Category</label>
            <select id="category" name="category">
              <?php foreach (CATEGORIES as $slug => $label): ?>
                <option value="<?= h($slug) ?>" <?= $product['category'] === $slug ? 'selected' : '' ?>><?= h($label) ?></option>
              <?php endforeach; ?>
            </select>
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
          <label for="image">Image Filename</label>
          <input type="text" id="image" name="image" value="<?= h($product['image']) ?>" placeholder="e.g. bike-urban.jpg">
          <small>Upload the file to <code>assets/images/</code> via FTP first, then enter its filename here. Leave blank to show a placeholder.</small>
        </div>

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
  <a class="btn btn--red" href="products.php?action=new">+ Add Product</a>
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
          <td><?= h(CATEGORIES[$p['category']] ?? $p['category']) ?></td>
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
