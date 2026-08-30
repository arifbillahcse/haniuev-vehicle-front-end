<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

const CERT_IMAGE_EXTS = ['jpg', 'jpeg', 'png', 'webp'];
const CERT_IMAGE_DIR = __DIR__ . '/../assets/images';

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$errors = [];

// A POST that blows past PHP's post_max_size arrives with $_POST and $_FILES
// silently emptied out — catch that case directly so there's a clear reason
// shown instead of the form just looking like it did nothing.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && empty($_FILES) && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
    $pageTitle = 'Certificates';
    $activeAdminNav = 'certificates';
    require __DIR__ . '/includes/chrome-top.php';
    echo '<div class="flash flash--err">That file is too large for this server to accept. Try a smaller file, or ask your hosting provider to raise the upload size limit.</div>';
    echo '<p><a class="btn btn--ghost btn--sm" href="certificates.php">&larr; Back to list</a></p>';
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// ---- delete ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delId = (int) $_POST['delete_id'];
    $row = db_one('SELECT image FROM certificates WHERE id = ?', [$delId]);
    if ($row) {
        db_run('DELETE FROM certificates WHERE id = ?', [$delId]);
        @unlink(CERT_IMAGE_DIR . '/' . $row['image']);
    }
    header('Location: certificates.php?deleted=1');
    exit;
}

// ---- create / update --------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_certificate'])) {
    $editingId = $_POST['id'] !== '' ? (int) $_POST['id'] : null;
    $existing = $editingId ? db_one('SELECT * FROM certificates WHERE id = ?', [$editingId]) : null;

    $data = [
        'name'       => trim((string) ($_POST['name'] ?? '')),
        'sort_order' => (int) ($_POST['sort_order'] ?? 0),
    ];

    $uploadedImage = save_uploaded_file($_FILES['image_file'] ?? [], CERT_IMAGE_DIR, CERT_IMAGE_EXTS, true, $imageError);
    $data['image'] = $uploadedImage ?? ($existing['image'] ?? '');
    if ($imageError !== null) {
        $errors[] = 'Image: ' . $imageError;
    }

    if ($data['name'] === '') {
        $errors[] = 'Name is required.';
    }
    if ($data['image'] === '') {
        $errors[] = 'An image is required.';
    }

    if (!$errors) {
        if ($editingId) {
            db_run('UPDATE certificates SET name=?, image=?, sort_order=? WHERE id=?', [$data['name'], $data['image'], $data['sort_order'], $editingId]);
        } else {
            db_run('INSERT INTO certificates (name, image, sort_order) VALUES (?,?,?)', [$data['name'], $data['image'], $data['sort_order']]);
        }
        header('Location: certificates.php?saved=1');
        exit;
    }

    $action = $editingId ? 'edit' : 'new';
    $id = $editingId;
}

$pageTitle = 'Certificates';
$activeAdminNav = 'certificates';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['saved'])) echo '<div class="flash flash--ok">Certificate saved.</div>';
if (isset($_GET['deleted'])) echo '<div class="flash flash--ok">Certificate deleted.</div>';
foreach ($errors as $e) echo '<div class="flash flash--err">' . h($e) . '</div>';

// =====================================================================
// FORM (new / edit)
// =====================================================================
if ($action === 'new' || $action === 'edit') {
    $cert = $data ?? ($id ? db_one('SELECT * FROM certificates WHERE id = ?', [$id]) : null);
    $cert = $cert ?? ['name' => '', 'image' => '', 'sort_order' => 0];
    ?>
    <div class="admin-head">
      <div><h1><?= $id ? 'Edit Certificate' : 'Add Certificate' ?></h1></div>
      <a class="btn btn--ghost btn--sm" href="certificates.php">&larr; Back to list</a>
    </div>

    <div class="card" style="max-width:560px">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="save_certificate" value="1">
        <input type="hidden" name="id" value="<?= h((string) ($id ?? '')) ?>">

        <div class="field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="<?= h($cert['name']) ?>" placeholder="e.g. ISO 9001:2015 Quality Management" required>
        </div>

        <div class="field">
          <label for="image_file">Certificate Image</label>
          <?php if ($cert['image'] !== ''): ?>
            <div style="margin-bottom:8px">
              <img class="thumb" src="../assets/images/<?= h($cert['image']) ?>" alt="" style="height:70px;width:auto">
            </div>
          <?php endif; ?>
          <input type="file" id="image_file" name="image_file" accept=".jpg,.jpeg,.png,.webp">
          <small><?= $cert['image'] !== '' ? 'Choose a file to replace the current image, or leave blank to keep it.' : 'A clear photo or scan of the certificate.' ?></small>
        </div>

        <div class="field">
          <label for="sort_order">Sort Order</label>
          <input type="number" id="sort_order" name="sort_order" value="<?= h((string) $cert['sort_order']) ?>">
          <small>Lower numbers appear first.</small>
        </div>

        <button type="submit" class="btn btn--red"><?= $id ? 'Save Changes' : 'Add Certificate' ?></button>
      </form>
    </div>
    <?php
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// =====================================================================
// LIST
// =====================================================================
$certificates = db_all('SELECT * FROM certificates ORDER BY sort_order, id');
?>

<div class="admin-head">
  <div>
    <h1>Certificates</h1>
    <p>Shown on the About page — add as many as you like.</p>
  </div>
  <a class="btn btn--red" href="certificates.php?action=new">+ Add Certificate</a>
</div>

<?php if (!$certificates): ?>
  <div class="card empty">No certificates yet. <a href="certificates.php?action=new">Add your first one</a>.</div>
<?php else: ?>
  <table class="list">
    <thead>
      <tr><th></th><th>Name</th><th>Order</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($certificates as $c): ?>
        <tr>
          <td><img class="thumb" src="../assets/images/<?= h($c['image']) ?>" alt="" onerror="this.style.visibility='hidden'"></td>
          <td><strong><?= h($c['name']) ?></strong></td>
          <td><?= (int) $c['sort_order'] ?></td>
          <td class="actions">
            <a class="btn btn--ghost btn--sm" href="certificates.php?action=edit&id=<?= (int) $c['id'] ?>">Edit</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Delete this certificate?');">
              <input type="hidden" name="delete_id" value="<?= (int) $c['id'] ?>">
              <button type="submit" class="btn btn--ghost btn--sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php require __DIR__ . '/includes/chrome-bottom.php'; ?>
