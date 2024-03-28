<?php

class Payment
{
    private $connection;
    private $session;

    private $selectedDate;
    private $selectedPackage;
    private $selectedAddons;
    private $proofOfPayment;
    private $referenceNumber;
    private $dateSent;
    private $guestId;

    private $reservationId;
    private $amountPaid;
    private $paymentDate;
    private $paymentProof;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function calculateAmount($package, $addons)
    {
        $sql = "SELECT Price FROM packages WHERE PackageID = '$package'";
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $amount = $row['Price'];
        } else {
            $amount = 0;
        }

        $totalAmount = 0;

        $jacuzzi = 300;
        $gas = 250;
        $dryer = 200;
        $charcoal = 100;
        $airfryer = 150;

        // separate the addons by comma
        $addons = explode(",", $addons);

        foreach ($addons as $addon) {
            if ($addon == "Jacuzzi") {
                $totalAmount += $jacuzzi;
            } else if ($addon == "Gas Stove") {
                $totalAmount += $gas;
            } else if ($addon == "Dryer Machine") {
                $totalAmount += $dryer;
            } else if ($addon == "Himalayan Charcoal") {
                $totalAmount += $charcoal;
            } else if ($addon == "Air Fryer") {
                $totalAmount += $airfryer;
            }
        }

        return $totalAmount + $amount;
    }

    public function submitReservation($selectedDate, $selectedPackage, $selectedAddons, $proofOfPayment, $referenceNumber, $dateSent, $GuestId)
    {
        try {
            $this->selectedDate = $selectedDate;
            $this->selectedPackage = $selectedPackage;
            $this->selectedAddons = $selectedAddons;
            $this->proofOfPayment = $proofOfPayment;
            $this->referenceNumber = $referenceNumber;
            $this->dateSent = $dateSent;
            $this->guestId = $GuestId;


            // check what package

            $totalAmount = $this->calculateAmount($selectedPackage, $selectedAddons);

            $sql = "INSERT INTO reservations (GuestID, PackageID, CheckInDate, CheckOutDate, TotalAmount) 
                    VALUES ('$GuestId', '$selectedPackage', '$selectedDate', '$selectedDate', '$totalAmount')";
            if ($this->connection->query($sql) === TRUE) {
                // Get the id
                $reservationId = $this->connection->insert_id;
                return $reservationId;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function uploadProofOfPayment($proofOfPayment)
    {
        try {
            // Define the target directory for uploads
            $target_dir = "../uploads/payments/";

            // Ensure the target directory exists, create it if it doesn't
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // 0777 for full permissions, adjust as necessary
            }

            // Define the target file path
            $originalFileName = basename($proofOfPayment["name"]);
            $target_file = $target_dir . $originalFileName;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image
            $check = getimagesize($proofOfPayment["tmp_name"]);
            if ($check === false) {
                throw new \Exception("File is not an image.");
            }

            // Allow certain file formats
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                throw new \Exception("Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.");
            }

            // If file already exists, add a number to the filename
            $counter = 1;
            while (file_exists($target_file)) {
                $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $counter . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;
                $counter++;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                throw new \Exception("An error occurred during upload.");
            } else {
                if (move_uploaded_file($proofOfPayment["tmp_name"], $target_file)) {
                    return basename($target_file); // Return the file name if upload successful
                } else {
                    throw new \Exception("Failed to move uploaded file.");
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function submitPayment($reservationId, $amountPaid, $paymentDate, $PaymentProof, $referenceNumber)
    {
        try {
            $this->reservationId = $reservationId;
            $this->amountPaid = $amountPaid;
            $this->paymentDate = $paymentDate;
            $this->paymentProof = $PaymentProof;
            $this->referenceNumber = $referenceNumber;

            $sql = "INSERT INTO payments (ReservationID, AmountPaid, PaymentDate, PaymentProof, ReferenceNumber) 
                    VALUES ('$reservationId', '$amountPaid', '$paymentDate', '$PaymentProof', '$referenceNumber')";
            if ($this->connection->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getTotalEarnings()
    {
        $sql = "SELECT SUM(AmountPaid) as TotalEarnings FROM payments";
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['TotalEarnings'];
        } else {
            return 0;
        }
    }
}