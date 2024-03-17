<?php
class User
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createUser($first_name, $last_name, $address, $email, $cont_no, $password)
    {
        $conn = $this->db->getConnection();

        // check if email already exists
        $sql = "SELECT * FROM guests WHERE Email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        }

        // hash the password before saving to database
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO guests (FirstName, LastName, Address, Email, Phone, password) VALUES ('$first_name', '$last_name', '$address', '$email', '$cont_no', '$password')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function authenticate($email, $password)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM guests WHERE Email ='$email'";

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

        $sql = "SELECT * FROM guests WHERE Email ='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['GuestID'];
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

        $sql = "SELECT * FROM guests WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullname = $row["FirstName"] . " " . $row["LastName    "];
            // capitalize fullname
            $fullname = ucwords($fullname);

            return $fullname;
        } else {
            return null;
        }
    }

    public function adminAuthenticate($email, $password)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM admins WHERE Username  ='$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['Password']) {
                return $row['AdminID'];
            } else {
                return null;
            }
        }
    }

    public function getGuests($GuestID)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM guests WHERE GuestID = '$GuestID'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
}