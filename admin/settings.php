<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

const SOCIAL_KEYS = [
    'social_linkedin'  => 'LinkedIn',
    'social_facebook'  => 'Facebook',
    'social_instagram' => 'Instagram',
    'social_youtube'   => 'YouTube',
    'social_tiktok'    => 'TikTok',
    'social_whatsapp'  => 'WhatsApp',
];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    $values = [];
    foreach (SOCIAL_KEYS as $key => $label) {
        $value = trim((string) ($_POST[$key] ?? ''));
        if ($value !== '' && !filter_var($value, FILTER_VALIDATE_URL)) {
            $errors[] = $label . ' must be a valid URL (starting with https://) or left blank.';
        }
        $values[$key] = $value;
    }

    if (!$errors) {
        foreach ($values as $key => $value) {
            db_run('UPDATE settings SET setting_value = ? WHERE setting_key = ?', [$value, $key]);
        }
        header('Location: settings.php?saved=1');
        exit;
    }
}

$current = $values ?? settings();

$pageTitle = 'Settings';
$activeAdminNav = 'settings';
require __DIR__ . '/includes/chrome-top.php';

if (isset($_GET['saved'])) echo '<div class="flash flash--ok">Settings saved.</div>';
foreach ($errors as $e) echo '<div class="flash flash--err">' . h($e) . '</div>';
?>

<div class="admin-head">
  <div>
    <h1>Settings</h1>
    <p>Social media links shown in the footer and on the Contact page.</p>
  </div>
</div>

<div class="card" style="max-width:560px">
  <form method="post">
    <input type="hidden" name="save_settings" value="1">
    <?php foreach (SOCIAL_KEYS as $key => $label): ?>
      <div class="field">
        <label for="<?= h($key) ?>"><?= h($label) ?> URL</label>
        <input type="url" id="<?= h($key) ?>" name="<?= h($key) ?>" value="<?= h($current[$key] ?? '') ?>" placeholder="https://...">
      </div>
    <?php endforeach; ?>
    <small style="display:block;margin-bottom:16px;color:var(--muted)">Leave any field blank to hide that icon on the site instead of linking nowhere.</small>
    <button type="submit" class="btn btn--red">Save Settings</button>
  </form>
</div>

<?php require __DIR__ . '/includes/chrome-bottom.php'; ?>
