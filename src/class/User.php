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
        $sql = "INSERT INTO guests (FirstName, LastName, Address, Email, Phone, password) VALUES ('$first_name', '$last_name', '$address', '$email', '$cont_no', '$password')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllGuest()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM guests";
        $result = $conn->query($sql);
        $guests = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $guests[] = $row;
            }
        }
        return $guests;
    }

    public function authenticate($email, $password)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM guests WHERE Email ='$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                return true;
            } else {
                return false;
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

    public function checkEmail($email)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM guests WHERE Email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertResetPassword($email, $token)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE guests SET token = '$token' WHERE Email = '$email'";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function checkToken($token)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM guests WHERE token = '$token'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword($token, $password)
    {
        // Get the database connection
        $conn = $this->db->getConnection();

        // Prepare the update query for changing the password
        $passwordSql = "UPDATE guests SET password = ? WHERE token = ?";
        $stmtPassword = $conn->prepare($passwordSql);
        $stmtPassword->bind_param('ss', $password, $token);

        // Prepare the update query for clearing the token
        $tokenSql = "UPDATE guests SET token = '' WHERE token = ?";
        $stmtToken = $conn->prepare($tokenSql);
        $stmtToken->bind_param('s', $token);

        // Execute the first statement to change the password
        $stmtPassword->execute();

        // Execute the second statement to clear the token
        $stmtToken->execute();

        // Check if any rows were affected by both statements
        if ($stmtPassword->affected_rows > 0 && $stmtToken->affected_rows > 0) {
            $stmtPassword->close();
            $stmtToken->close();
            return true;
        } else {
            $stmtPassword->close();
            $stmtToken->close();
            return false;
        }

    }
}