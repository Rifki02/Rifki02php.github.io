<?php
    require "database/koneksi.php";
    session_start();
    if (isset($_POST["Register"])) {
        $nama = $_POST["nama"];
        $alamat = $_POST["email"];
        $telephone = $_POST["telephone"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "insert into informasi
            (id, nama, alamat, telephone, password) 
            values ('', '$nama', '$alamat', '$telephone', '$password')");

        if ($result) {
            $last_id = $conn->insert_id;
            $_SESSION["id"] = $last_id;
            echo "
                    <script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location.href = 'index.html';
                    </script>
                ";
        } else {
            echo "
                <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href = 'tambah.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi User</title>
    <link rel="stylesheet" href="register.css" />
</head>
<body>
    <header>
        <form action="" method="POST">
            <div class="wrapper">
                <div class="form-box-register">
                    <h2>Register</h2>
                        <div class="input-box">
                            <label for="nama" id="UserLabel"></label>
                            <input type="text" name="nama" maxlength="100" placeholder="nama"/>
                        </div>
                        <div class="input-box">
                            <label for="SignAlamat" id="alamat"></label>
                            <input type="alamat" name="alamat" maxlength="50" placeholder="alamat"/>
                        </div>
                        <div class="input-box">
                            <label for="SignTelephone" id="telephone"></label>
                            <input type="text" name="username" maxlength="50" placeholder="telephone"/>
                        </div>
                        <div class="input-box">
                            <label for="SignPassword" id="password"></label>
                            <input type="password" name="password" maxlength="50" placeholder="password"/>
                        </div>
                        <div class="inputBox">
                            <button type="submit" name="Register" id="Register">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </header>
</body>
</html>
