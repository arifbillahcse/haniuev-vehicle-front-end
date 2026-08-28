<?php
/**
 * Server-side handling for the #inquiryForm on Home, About, and Contact.
 * Include this BEFORE includes/header.php (before any output) so it can
 * run on every request. Sets $formSuccess, $formErrors, $old for
 * includes/inquiry-fields.php to render.
 */
$formSuccess = false;
$formErrors = [];
$old = ['fullName' => '', 'company' => '', 'email' => '', 'country' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hn_inquiry'])) {
    foreach ($old as $key => $_) {
        $old[$key] = trim((string) ($_POST[$key] ?? ''));
    }

    if ($old['fullName'] === '') {
        $formErrors['fullName'] = 'This field is required.';
    }
    if ($old['email'] === '') {
        $formErrors['email'] = 'This field is required.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formErrors['email'] = 'Please enter a valid email address.';
    }
    if ($old['country'] === '') {
        $formErrors['country'] = 'This field is required.';
    }
    if ($old['message'] === '') {
        $formErrors['message'] = 'This field is required.';
    }

    if (!$formErrors) {
        db_run(
            'INSERT INTO messages (full_name, company, email, country, message, source) VALUES (?, ?, ?, ?, ?, ?)',
            [$old['fullName'], $old['company'], $old['email'], $old['country'], $old['message'], basename($_SERVER['SCRIPT_NAME'])]
        );
        $formSuccess = true;
        $old = ['fullName' => '', 'company' => '', 'email' => '', 'country' => '', 'message' => ''];
    }
}
