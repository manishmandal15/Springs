<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['to'] ?? '';
    $subject = $_POST['subject'] ?? 'No subject';
    $message = $_POST['message'] ?? '';
    $from = "you@yourdomain.com"; // change to your email

    if (!$to || !$message) {
        echo json_encode(['error' => 'Recipient and message required']);
        exit;
    }

    // Headers
    $headers  = "From: {$from}\r\n";
    $headers .= "Reply-To: {$from}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send mail
    $sent = mail($to, $subject, $message, $headers);

    if ($sent) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Mail not sent (server may block mail())']);
    }
}
?>
