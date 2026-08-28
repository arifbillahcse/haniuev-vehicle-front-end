<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$errors = [];

// ---- delete ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    db_run('DELETE FROM posts WHERE id = ?', [(int) $_POST['delete_id']]);
    header('Location: posts.php?deleted=1');
    exit;
}

// ---- create / update --------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_post'])) {
    $editingId = $_POST['id'] !== '' ? (int) $_POST['id'] : null;

    $data = [
        'title'        => trim((string) ($_POST['title'] ?? '')),
        'excerpt'      => trim((string) ($_POST['excerpt'] ?? '')),
        'body'         => trim((string) ($_POST['body'] ?? '')),
        'cover_image'  => trim((string) ($_POST['cover_image'] ?? '')),
        'published_at' => trim((string) ($_POST['published_at'] ?? '')) ?: date('Y-m-d'),
    ];

    if ($data['title'] === '') {
        $errors[] = 'Title is required.';
    }
    if ($data['excerpt'] === '') {
        $errors[] = 'Excerpt is required.';
    }
    if ($data['body'] === '') {
        $errors[] = 'Body is required.';
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['published_at'])) {
        $errors[] = 'Published date must be in YYYY-MM-DD format.';
    }

    if (!$errors) {
        $slug = unique_slug($data['title'], 'posts', $editingId);
        if ($editingId) {
            db_run(
                'UPDATE posts SET title=?, slug=?, excerpt=?, body=?, cover_image=?, published_at=? WHERE id=?',
                [$data['title'], $slug, $data['excerpt'], $data['body'], $data['cover_image'], $data['published_at'], $editingId]
            );
        } else {
            db_run(
                'INSERT INTO posts (title, slug, excerpt, body, cover_image, published_at) VALUES (?,?,?,?,?,?)',
                [$data['title'], $slug, $data['excerpt'], $data['body'], $data['cover_image'], $data['published_at']]
            );
        }
        header('Location: posts.php?saved=1');
        exit;
    }

    $action = $editingId ? 'edit' : 'new';
    $id = $editingId;
}

$pageTitle = 'Blog Posts';
$activeAdminNav = 'posts';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['saved'])) echo '<div class="flash flash--ok">Post saved.</div>';
if (isset($_GET['deleted'])) echo '<div class="flash flash--ok">Post deleted.</div>';
foreach ($errors as $e) echo '<div class="flash flash--err">' . h($e) . '</div>';

// =====================================================================
// FORM (new / edit)
// =====================================================================
if ($action === 'new' || $action === 'edit') {
    $post = $data ?? ($id ? db_one('SELECT * FROM posts WHERE id = ?', [$id]) : null);
    $post = $post ?? ['title' => '', 'excerpt' => '', 'body' => '', 'cover_image' => '', 'published_at' => date('Y-m-d')];
    ?>
    <div class="admin-head">
      <div><h1><?= $id ? 'Edit Post' : 'Add Blog Post' ?></h1></div>
      <a class="btn btn--ghost btn--sm" href="posts.php">&larr; Back to list</a>
    </div>

    <div class="card" style="max-width:700px">
      <form method="post">
        <input type="hidden" name="save_post" value="1">
        <input type="hidden" name="id" value="<?= h((string) ($id ?? '')) ?>">

        <div class="field">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" value="<?= h($post['title']) ?>" required>
        </div>

        <div class="form-grid">
          <div class="field">
            <label for="published_at">Published Date</label>
            <input type="date" id="published_at" name="published_at" value="<?= h($post['published_at']) ?>" required>
          </div>
          <div class="field">
            <label for="cover_image">Cover Image Filename</label>
            <input type="text" id="cover_image" name="cover_image" value="<?= h($post['cover_image']) ?>" placeholder="e.g. blog-eec-certification.jpg">
          </div>
        </div>

        <div class="field">
          <label for="excerpt">Excerpt</label>
          <textarea id="excerpt" name="excerpt" rows="2" required><?= h($post['excerpt']) ?></textarea>
          <small>Shown on the blog listing card, under the title.</small>
        </div>

        <div class="field">
          <label for="body">Body</label>
          <textarea id="body" name="body" rows="10" required><?= h($post['body']) ?></textarea>
          <small>Plain text. Leave a blank line between paragraphs — each becomes its own paragraph on the article page.</small>
        </div>

        <button type="submit" class="btn btn--red"><?= $id ? 'Save Changes' : 'Publish Post' ?></button>
      </form>
    </div>
    <?php
    require __DIR__ . '/includes/chrome-bottom.php';
    exit;
}

// =====================================================================
// LIST
// =====================================================================
$posts = db_all('SELECT * FROM posts ORDER BY published_at DESC, id DESC');
?>

<div class="admin-head">
  <div>
    <h1>Blog Posts</h1>
    <p>Articles shown on the public Blog page.</p>
  </div>
  <a class="btn btn--red" href="posts.php?action=new">+ Add Blog Post</a>
</div>

<?php if (!$posts): ?>
  <div class="card empty">No posts yet. <a href="posts.php?action=new">Write your first one</a>.</div>
<?php else: ?>
  <table class="list">
    <thead>
      <tr><th>Title</th><th>Published</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $p): ?>
        <tr>
          <td><strong><?= h($p['title']) ?></strong><br><span style="color:var(--muted)"><?= h($p['excerpt']) ?></span></td>
          <td><?= h(date('M j, Y', strtotime($p['published_at']))) ?></td>
          <td class="actions">
            <a class="btn btn--ghost btn--sm" href="../post.php?slug=<?= urlencode($p['slug']) ?>" target="_blank" rel="noopener">View</a>
            <a class="btn btn--ghost btn--sm" href="posts.php?action=edit&id=<?= (int) $p['id'] ?>">Edit</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Delete this post?');">
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
