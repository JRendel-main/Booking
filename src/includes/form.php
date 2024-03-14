<?php

class form
{
    private $firstname;
    private $lastname;
    private $email;
    private $contact;
    private $password;

    public function __construct($firstname, $lastname, $email, $contact, $password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->contact = $contact;
        $this->password = $password;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}