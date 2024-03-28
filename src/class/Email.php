<?php
class Email
{
    private $conn;
    private $email;
    private $subject;
    private $message;
    private $headers;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sendEmail($email, $subject, $message, $headers)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;

        if (mail($this->email, $this->subject, $this->message, $this->headers)) {
            return true;
        } else {
            return false;
        }
    }
}