
<?php
require "database/koneksi.php";
session_start();

$id = null; // Initialize $id to null

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    // Handle the case where 'id' is not set, perhaps by displaying an error message or redirecting.
}

$result = mysqli_query($conn, "SELECT * FROM informasi WHERE id='$id'");

$informasi = [];

if (!empty($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $informasi[] = $row;
    }
    if (!empty($informasi)) {
        $informasi = $informasi[0];
    } else {
        // Handle the case where the array is empty, perhaps by displaying an error message.
    }
} else {
    // Handle the case where the query fails, perhaps by displaying an error message.
}

if (isset($_POST["Register"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];  // Corrected the input name
    $telephone = $_POST["telephone"];  // Corrected the input name
    $password = $_POST["password"];
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));

    $new_foto = "$nama.$ekstensi";
    $tmp = $_FILES['foto']['tmp_name'];

    // Destination directory for file uploads (make sure it exists and is writable)
    $destination_directory = "../Resource/";  // Adjust the path to the correct directory

    if (file_exists($destination_directory) && is_writable($destination_directory)) {
        $new_file_path = $destination_directory . $new_foto;
    }
        if (move_uploaded_file($tmp, $new_file_path)) {
            // The file was successfully moved.

            $get_foto = mysqli_query($conn, "SELECT foto FROM informasi WHERE id = $id");
            $data_old = mysqli_fetch_array($get_foto);
            unlink("../img/".$data_old['foto']);

            $result = mysqli_query($conn, "UPDATE informasi SET nama='$nama', alamat='$alamat', telephone='$telephone', password='$password', foto='$new_foto' WHERE id = $id");

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
                    document.location.href = 'Register.php';
                    </script>
                ";
            }
        } else {
            echo "Error: Failed to move the uploaded file.";
        }
//     } else {
//         echo "Error: Destination directory doesn't exist or is not writable.";
//     }
// }
?>

<!-- Your HTML form with corrected labels and input names -->
<!-- Make sure the action attribute points to the correct PHP script -->

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
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="wrapper">
                <div class="form-box-register">
                    <h2>Register</h2>
                    <div class="input-box">
                        <label for="nama" id="UserLabel"></label>
                        <input type="text" name="nama" maxlength="100" placeholder="nama"/>
                    </div>
                    <div class="input-box">
                        <label for="alamat" id="alamat"></label>
                        <input type="text" name="alamat" maxlength="50" placeholder="alamat"/>
                    </div>
                    <div class="input-box">
                        <label for="telephone" id="telephone"></label>
                        <input type="text" name="telephone" maxlength="50" placeholder="telephone"/>
                    </div>
                    <div class="input-box">
                        <label for="password" id="password"></label>
                        <input type="password" name="password" maxlength="50" placeholder="password"/>
                    </div>
                    <div class="inputBox">
                        <input type="file" name="foto" class="textfield">
                    </div>
                    <div class="inputBox">
                        <button type="submit" name="Register" id="Register">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </header>
</body>
</html>
