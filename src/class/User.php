<?php
class User
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createUser($first_name, $last_name, $email, $cont_no, $password)
    {
        $conn = $this->db->getConnection();

        // check if email already exists
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        }

        // hash the password before saving to database
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (first_name, last_name, email_address, contact_no, password) VALUES ('$first_name', '$last_name', '$email', '$cont_no', '$password')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function authenticate($email, $password)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM user WHERE email_address ='$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return true;
            }
        }

    }

    public function getUserId($email)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email ='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            return null;
        }
    }

    public function getUserEmail($email)
    {
        return $email;
    }

    public function getUserName($email)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullname = $row["first_name"] . " " . $row["lastname"];
            // capitalize fullname
            $fullname = ucwords($fullname);

            return $fullname;
        } else {
            return null;
        }
    }
}