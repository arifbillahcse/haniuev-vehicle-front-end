<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$errors = [];

// ---- delete ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delId = (int) $_POST['delete_id'];
    $cat = db_one('SELECT slug FROM categories WHERE id = ?', [$delId]);
    $inUse = $cat ? db_one('SELECT COUNT(*) AS n FROM products WHERE category = ?', [$cat['slug']])['n'] : 0;

    if ($inUse > 0) {
        header('Location: categories.php?error=in_use');
        exit;
    }

    db_run('DELETE FROM categories WHERE id = ?', [$delId]);
    header('Location: categories.php?deleted=1');
    exit;
}

// ---- create / update --------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_category'])) {
    $editingId = $_POST['id'] !== '' ? (int) $_POST['id'] : null;

    $data = [
        'name'       => trim((string) ($_POST['name'] ?? '')),
        'pill'       => trim((string) ($_POST['pill'] ?? '')),
        'lead'       => trim((string) ($_POST['lead'] ?? '')),
        'sort_order' => (int) ($_POST['sort_order'] ?? 0),
    ];

    if ($data['name'] === '') {
        $errors[] = 'Name is required.';
    }

    if (!$errors) {
        $slug = unique_slug($data['name'], 'categories', $editingId);
        if ($editingId) {
            db_run(
                'UPDATE categories SET name=?, pill=?, lead=?, sort_order=? WHERE id=?',
                [$data['name'], $data['pill'], $data['lead'], $data['sort_order'], $editingId]
            );
        } else {
            db_run(
                'INSERT INTO categories (slug, name, pill, lead, sort_order) VALUES (?,?,?,?,?)',
                [$slug, $data['name'], $data['pill'], $data['lead'], $data['sort_order']]
            );
        }
        header('Location: categories.php?saved=1');
        exit;
    }

    $action = $editingId ? 'edit' : 'new';
    $id = $editingId;
}

$pageTitle = 'Categories';
$activeAdminNav = 'categories';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['saved'])) echo '<div class="flash flash--ok">Category saved.</div>';
if (isset($_GET['deleted'])) echo '<div class="flash flash--ok">Category deleted.</div>';
if (isset($_GET['error']) && $_GET['error'] === 'in_use') {
    echo '<div class="flash flash--err">Can\'t delete — one or more products still use this category. Move or delete those products first.</div>';
}
foreach ($errors as $e) echo '<div class="flash flash--err">' . h($e) . '</div>';

// =====================================================================
// FORM (new / edit)
// =====================================================================
if ($action === 'new' || $action === 'edit') {
    $category = $data ?? ($id ? db_one('SELECT * FROM categories WHERE id = ?', [$id]) : null);
    $category = $category ?? ['name' => '', 'pill' => '', 'lead' => '', 'sort_order' => 0];
    ?>
    <div class="admin-head">
      <div><h1><?= $id ? 'Edit Category' : 'Add Category' ?></h1></div>
      <a class="btn btn--ghost btn--sm" href="categories.php">&larr; Back to list</a>
    </div>

    <div class="card" style="max-width:640px">
      <form method="post">
        <input type="hidden" name="save_category" value="1">
        <input type="hidden" name="id" value="<?= h((string) ($id ?? '')) ?>">

        <div class="field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="<?= h($category['name']) ?>" placeholder="e.g. Battery & Charger" required>
          <small>Used everywhere this category is shown, and to generate its URL slug.</small>
        </div>

        <div class="field">
          <label for="pill">Hero Label</label>
          <input type="text" id="pill" name="pill" value="<?= h($category['pill']) ?>" placeholder="e.g. LITHIUM & LEAD-ACID">
          <small>Small eyebrow text shown above the title on the category page.</small>
        </div>

        <div class="field">
          <label for="lead">Hero Description</label>
          <textarea id="lead" name="lead" rows="3" placeholder="One or two sentences shown under the title on the category page."><?= h($category['lead']) ?></textarea>
        </div>

        <div class="field">
          <label for="sort_order">Sort Order</label>
          <input type="number" id="sort_order" name="sort_order" value="<?= h((string) $category['sort_order']) ?>">
          <small>Lower numbers appear first in the category dropdown when adding a product.</small>
        </div>

        <button type="submit" class="btn btn--red"><?= $id ? 'Save Changes' : 'Add Category' ?></button>
      </form>
    </div>
    <?php
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// =====================================================================
// LIST
// =====================================================================
$categories = db_all(
    'SELECT c.*, (SELECT COUNT(*) FROM products p WHERE p.category = c.slug) AS product_count
     FROM categories c ORDER BY c.sort_order, c.name'
);
?>

<div class="admin-head">
  <div>
    <h1>Categories</h1>
    <p>Product categories used across the vehicle and parts menus.</p>
  </div>
  <a class="btn btn--red" href="categories.php?action=new">+ Add Category</a>
</div>

<?php if (!$categories): ?>
  <div class="card empty">No categories yet. <a href="categories.php?action=new">Add your first one</a>.</div>
<?php else: ?>
  <table class="list">
    <thead>
      <tr><th>Name</th><th>Slug</th><th>Products</th><th>Order</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($categories as $c): ?>
        <tr>
          <td><strong><?= h($c['name']) ?></strong><?php if ($c['pill'] !== ''): ?><br><span style="color:var(--muted)"><?= h($c['pill']) ?></span><?php endif; ?></td>
          <td><code><?= h($c['slug']) ?></code></td>
          <td>
            <?= (int) $c['product_count'] ?>
            <?php if ((int) $c['product_count'] > 0): ?>
              — <a href="products.php" style="font-size:12.5px">view</a>
            <?php endif; ?>
          </td>
          <td><?= (int) $c['sort_order'] ?></td>
          <td class="actions">
            <a class="btn btn--ghost btn--sm" href="../category.php?slug=<?= urlencode($c['slug']) ?>" target="_blank" rel="noopener">View</a>
            <a class="btn btn--ghost btn--sm" href="categories.php?action=edit&id=<?= (int) $c['id'] ?>">Edit</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Delete this category?');">
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
