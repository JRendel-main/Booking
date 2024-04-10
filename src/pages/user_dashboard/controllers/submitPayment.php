<?php
include '../../../includes/autoloader.php';
include '../../../includes/conn.php';

$connection = new conn();
$connection = $connection->conn;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Get the data from the form
        $selectedDate = $_POST['selectedDate'];
        $selectedPackage = $_POST['selectedPackage'];
        $selectedAddons = $_POST['selectedAddons'];
        $referenceNumber = $_POST['referenceNumber'];
        $sender = $_POST['sender'];
        $dateSent = date('Y-m-d H:i:s');
        $guestEmail = $_POST['guestEmail'];

        // Check if proof of payment file is uploaded
        if (isset($_FILES['proofOfPayment']) && $_FILES['proofOfPayment']['error'] === UPLOAD_ERR_OK) {
            // Get the uploaded file details
            $proofOfPayment = $_FILES['proofOfPayment'];
            $amountPaid = 0;

            // Create a new instance of the Payment class
            $payment = new Payment($connection);

            $db = new Database();
            $user = new User($db);

            $amountPaid = $payment->calculateAmount($selectedPackage, $selectedAddons);
            $GuestId = $user->getUserId($guestEmail);

            // Submit the reservation
            $reservationID = $payment->submitReservation($selectedDate, $selectedPackage, $selectedAddons, $proofOfPayment, $referenceNumber, $dateSent, $GuestId);
            // Upload proof of payment
            $uploadProofOfPayment = $payment->uploadProofOfPayment($proofOfPayment);

            // Check if upload was successful
            if ($uploadProofOfPayment !== false) {
                $amountPaid = $amountPaid / 2;
                // Submit payment
                $submitPayment = $payment->submitPayment($reservationID, $amountPaid, $dateSent, $uploadProofOfPayment, $sender, $referenceNumber);

                // Check if payment submission was successful
                if ($submitPayment !== false) {
                    // echo json_encode(array("message" => "Payment submitted successfully", "success" => true, "reservationID" => $reservationID));
                    $vendor = '../../../../vendor/autoload.php';
                    $email = new Email($vendor);
                    $to = $guestEmail;
                    $subject = 'Transcation Receipt';
                    $type = 'payment_confirmation';
                    $htmlContent = "
                    <div class='container'>
                        <h2>Transaction Receipt</h2>
                        <p>Dear Customer,</p>
                        <p>Thank you for your payment. Here are the details of your transaction:</p>
                        <table class='table'>
                            <tr>
                                <th>Package Selected</th>
                                <td>{$selectedPackage}</td>
                            </tr>
                            <tr>
                                <th>Amount Paid</th>
                                <td>{$amountPaid}</td>
                            </tr>
                            <tr>
                                <th>Payment Date</th>
                                <td>{$dateSent}</td>
                            </tr>
                            <tr>
                                <th>Reference Number</th>
                                <td>{$referenceNumber}</td>
                            </tr>
                        </table>
                        <p>If you have any questions, please contact us.</p>
                        <p>Thank you,</p>
                        <p>Your Company</p>
                    </div>";
                    $email->sendEmail($to, $subject, $type, $htmlContent);

                    if ($email) {
                        echo json_encode(array("message" => "Payment submitted successfully. Email sent to user", "success" => true, "reservationID" => $reservationID));
                    } else {
                        echo json_encode(array("message" => "Payment submitted successfully. Failed to send email to user", "success" => true, "reservationID" => $reservationID));
                    }

                } else {
                    throw new Exception("Failed to submit payment");
                }
            } else {
                throw new Exception("Failed to upload proof of payment");
            }
        } else {
            throw new Exception("Proof of payment file is missing or invalid");
        }
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "success" => false));
    }
} else {
    echo json_encode(array("message" => "Failed to submit payment", "success" => false));
}
?>