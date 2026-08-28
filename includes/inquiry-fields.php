<?php
/**
 * The Full Name / Company / Email / Country / Message fields + submit
 * button, shared by every page's #inquiryForm. Expects $formErrors, $old
 * (from includes/inquiry-handler.php) and optional $dark (bool, About
 * page's translucent field style).
 */
$dark = $dark ?? false;
$fieldClass = 'field' . ($dark ? ' field--dark' : '');
$err = fn(string $key) => $formErrors[$key] ?? '';
$hasErr = fn(string $key) => isset($formErrors[$key]) ? ' has-error' : '';
$label = fn(string $text) => $dark ? strtoupper($text) : $text;
?>
<input type="hidden" name="hn_inquiry" value="1">

<div class="field-row">
  <div class="<?= $fieldClass . $hasErr('fullName') ?>">
    <label for="fullName"><?= h($label('Full Name')) ?> <span class="req">*</span></label>
    <input type="text" id="fullName" name="fullName" placeholder="<?= $dark ? 'John Smith' : 'Your full name' ?>" value="<?= h($old['fullName']) ?>" required>
    <small class="field__err"><?= h($err('fullName')) ?></small>
  </div>
  <div class="<?= $fieldClass ?>">
    <label for="company"><?= h($label($dark ? 'Company' : 'Company Name')) ?></label>
    <input type="text" id="company" name="company" placeholder="<?= $dark ? 'Your Company' : 'Your company' ?>" value="<?= h($old['company']) ?>">
  </div>
</div>

<div class="field-row">
  <div class="<?= $fieldClass . $hasErr('email') ?>">
    <label for="email"><?= h($label('Email Address')) ?> <span class="req">*</span></label>
    <input type="email" id="email" name="email" placeholder="you@<?= $dark ? 'company' : 'email' ?>.com" value="<?= h($old['email']) ?>" required>
    <small class="field__err"><?= h($err('email')) ?></small>
  </div>
  <div class="<?= $fieldClass . $hasErr('country') ?>">
    <label for="country"><?= h($label('Country')) ?> <span class="req">*</span></label>
    <input type="text" id="country" name="country" placeholder="e.g. Romania" value="<?= h($old['country']) ?>" required>
    <small class="field__err"><?= h($err('country')) ?></small>
  </div>
</div>

<div class="<?= $fieldClass . $hasErr('message') ?>">
  <label for="message"><?= h($label('Message')) ?> <span class="req">*</span></label>
  <textarea id="message" name="message" rows="<?= $dark ? 4 : 5 ?>" placeholder="Tell us about your requirements, target market, and expected order volumes..." required><?= h($old['message']) ?></textarea>
  <small class="field__err"><?= h($err('message')) ?></small>
</div>

<button type="submit" class="btn btn--red btn--block-sm" id="submitBtn">
  <span class="btn__label">Send Inquiry</span>
  <svg><use href="#i-arrow-right"/></svg>
</button>
<p class="inq-form__note">
  By submitting this form, you agree to be contacted by HANIU's export team regarding your inquiry.
</p>
<p class="form-status<?= $formSuccess ? ' is-shown' : '' ?>" id="formStatus" role="status" aria-live="polite">
  <?= $formSuccess ? 'Thank you — your inquiry has been received. Our export team will reply within 24 hours.' : '' ?>
</p>
