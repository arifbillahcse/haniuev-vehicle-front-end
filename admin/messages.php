<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    db_run('DELETE FROM messages WHERE id = ?', [(int) $_POST['delete_id']]);
    header('Location: messages.php?deleted=1');
    exit;
}

// Fetch first so this page still shows which ones were unread *before* this
// visit, then mark everything read — visiting the inbox is what clears it.
$messages = db_all('SELECT * FROM messages ORDER BY created_at DESC');
db_run('UPDATE messages SET is_read = 1 WHERE is_read = 0');

$pageTitle = 'Messages';
$activeAdminNav = 'messages';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['deleted'])) echo '<div class="flash flash--ok">Message deleted.</div>';
?>

<div class="admin-head">
  <div>
    <h1>Messages</h1>
    <p>Inquiries submitted through the contact forms on Home, About, and Contact.</p>
  </div>
</div>

<?php if (!$messages): ?>
  <div class="card empty">No inquiries yet.</div>
<?php else: ?>
  <table class="list">
    <thead>
      <tr><th>From</th><th>Country</th><th>Message</th><th>Page</th><th>Received</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($messages as $m): ?>
        <tr>
          <td>
            <?php if (!$m['is_read']): ?><span class="pill-badge pill-badge--on" style="margin-bottom:4px">New</span><br><?php endif; ?>
            <strong><?= h($m['full_name']) ?></strong>
            <?php if ($m['company'] !== ''): ?><br><span style="color:var(--muted)"><?= h($m['company']) ?></span><?php endif; ?>
            <br><a href="mailto:<?= h($m['email']) ?>"><?= h($m['email']) ?></a>
          </td>
          <td><?= h($m['country']) ?></td>
          <td style="max-width:340px;white-space:pre-wrap"><?= h($m['message']) ?></td>
          <td><?= h($m['source'] ?: '—') ?></td>
          <td><?= h(date('M j, Y g:ia', strtotime($m['created_at']))) ?></td>
          <td class="actions">
            <form method="post" onsubmit="return confirm('Delete this message?');">
              <input type="hidden" name="delete_id" value="<?= (int) $m['id'] ?>">
              <button type="submit" class="btn btn--ghost btn--sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php require __DIR__ . '/includes/chrome-bottom.php'; ?>
