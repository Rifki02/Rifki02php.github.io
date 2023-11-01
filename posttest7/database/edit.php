<?php
    require "koneksi.php";
    $id = $_GET["id"];
    
    $result = mysqli_query($conn, "SELECT * FROM informasi where id='$id'");

    $informasi = [];

    while ($row = mysqli_fetch_assoc($result)){
        $informasi[] = $row;
}

$informasi = $informasi[0];


if (isset($_POST['edit'])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telephone = $_POST["telephone"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "UPDATE informasi SET nama = '$nama', alamat='$alamat', telephone='$telephone', password='$password' WHERE id = '$id' ");

    if ($result) {
        echo "
        <script>
            alert('Data berhasil Diubah!');
            document.location.href = '../admin.php'
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal Diubah!');
            document.location.href = 'edit.php'
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <section class="add-data">
        <div class="add-form-container">
            <h1>Edit Data</h1><hr><br>
            <form action="" method="post">
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
                            <input type="file" name="gambar" class="textfield">
                        </div>
                            <input type="submit" name="edit" value="Edit Data" class="login-btn">
            </form>
        </div>
    </section>
</body>
</html>