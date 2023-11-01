<?php
session_start();
require 'database/koneksi.php';

if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            header('Location: index.html');
            exit;
        }
    }
    
    else if($nama == "admin" && $password == "admin"){
        $_SESSION["login"] = true;
        $_SESSION["nama"] = $nama;
        header("Location: admin.php");
        exit;
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Login</title>
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <header>
        <div class="wrapper">
            <div class="form-box-login">
                <h2>Login</h2>
                <form action="" method="POST">
                    <div class="input-box">
                        <label for="nama" id="UserLabel"></label>
                        <input type="text" name="nama" maxlength="100" placeholder="nama"/>
                    </div>
                    <div class="input-box">
                        <label for="password" id="password"></label>
                        <input type="password" name="password" maxlength="50" placeholder="password"/>
                    </div>
                    <div class="button">
                        <input type="submit" value="Login" name="login">
                    </div>
                        <div class="regis_link">
                        Tidak Punya Akun? <a href="register.php">Register</a><br>
                        <a href="Register.php"></a>
                    </div>
                </form>
            </div>
        </div>
    </header>
</body>
</html>

