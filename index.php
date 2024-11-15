<?php
session_start();
require_once "./config/database.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Capture form data
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password == $user['password']) {
            $accType = $user['Account_Type'];

            // Set session and redirect
            $_SESSION['user_id'] = $user['userID']; // Assuming 'id' is the primary key of users table
            header("Location: {$accType}.php");
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password. aaa";
    }

    // Close statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
    <section class="d-flex h-100 justify-content-center align-items-center" id="loginPage">
        <form class="bg-secondary p-3 align-middle rounded" action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <p>Belum memiliki akun? <a href="signup.php">Daftar disini</a></p>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</body>
<script src="./assets/js/bootstrap.min.js"></script>
</html>