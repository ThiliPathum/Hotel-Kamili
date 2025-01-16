<?php
require 'vendor/autoload.php'; // Ensure you have the Stripe PHP library and PHPMailer installed

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Stripe\Stripe;
use Stripe\Event;
use FPDF;

Stripe::setApiKey('sk_test_51PSgUSGS5hz4ZPJThbe8FFgINQtGjs2ilOM1A8B4iDcZGVrQWbJu2AV446yKzp3unjEWXTJ0qOwmTQR6fuLKqREb004LI206Y8');

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents('php://input');
$event = null;

try {
    $event = Event::constructFrom(
        json_decode($input, true)
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object; // contains a StripePaymentIntent
        $customerEmail = $paymentIntent->charges->data[0]->billing_details->email;

        // Generate invoice PDF
        $invoicePdf = generatePDFInvoice($paymentIntent);

        $customerEmail = "ranjanlilani@gmail.com";

        // Send email with invoice attached
        sendEmailWithAttachment($customerEmail, 'Your Invoice', 'Thank you for your payment.', $invoicePdf);
        break;
    // Add other event types as needed
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);

function generatePDFInvoice($paymentIntent) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Invoice Details: ' . $paymentIntent->id);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Amount: ' . ($paymentIntent->amount_received / 100) . ' ' . strtoupper($paymentIntent->currency));
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Customer Email: ' . $paymentIntent->charges->data[0]->billing_details->email);
    
    return $pdf->Output('S'); // Output as string
}

function sendEmailWithAttachment($to, $subject, $message, $attachmentContent) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'ranjanlilani@gmail.com'; // SMTP username
        $mail->Password = 'ssxl mbdo jhut pvko'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('ranjanlilani@gmail.com', 'Kamili Beach Villa');
        $mail->addAddress($to);

        // Attachments
        $mail->addStringAttachment($attachmentContent, 'invoice.pdf', 'base64', 'application/pdf');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
