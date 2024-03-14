<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up | Confirmation</title>
</head>

<body>
    <?php
    // Start a session
    session_start();

    // Connect to MySQL
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "booking";

    $conn = mysqli_connect($host, $user, $password, $database);

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // If the sign-up form has been submitted
    $sql = "INSERT INTO user (first_name, last_name, email_address, password, contact_no)
        VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssi",
        $_POST["first_name"],
        $_POST["last_name"],
        $_POST["email"],
        $password_hash,
        $_POST["cont_no"]

    );


    if ($stmt->execute()) {

        echo "Success";
        header("Location: login.php");
        exit;

    } else {

        if ($conn->errno === 1062) {
            die("Email already taken");
        } else {
            die($conn->error . " " . $conn->errno);
        }
    }



    /*

    $connect_sql= require __DIR__ ."/database.php";

    $sql = "INSERT INTO user (first_name, last_name, email_address)
            VALUES (?, ?, ?)";

    $stmt = $connect_sql->stmt_init();

    if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $connect_sql->error);
    }

    $stmt->bind_param("sss",
                      $_POST["first_name"],
                      $_POST["last_name"],
                      $_POST["email"]);

                      
    */






    ?>

</body>

</html>