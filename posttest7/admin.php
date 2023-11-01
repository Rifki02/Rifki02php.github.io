<?php
    require "./database/koneksi.php";

    $result = mysqli_query($conn, "select * from informasi");

    $informasi = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $informasi[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database Akun User</title>
        <link rel="stylesheet" href="admin.css"> 
    </head>
    <body>
        <form action="" method="POST">
            <section>
                <header>
                    <table>
                        <div class="admin">
                            <div class="section">
                                <p>Database Akun User</p>
                                <tbody>
                                    <?php date_default_timezone_set("Asia/Makassar"); echo "Hari Di Samarinda Sekarang: ", date('l, d F Y, H:i:sa')?><br>
                                    
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Telephone</th>
                                            <th>Alamat</th>
                                            <th>Password</th>
                                            <th>Foto</th>
                                            <th colspan="2">Edit/Hapus</th>
                                        </tr>
                                    <?php $i = 1;
                                        foreach ($informasi as $if) : 
                                    ?>
                                    <tr>
                                        <td> <?= $i; ?> </td>
                                        <td> <?php echo $if["nama"] ?> </td>
                                        <td> <?= $if["telephone"] ?> </td>
                                        <td> <?= $if["alamat"] ?> </td>
                                        <td> <?= $if["password"] ?> </td>
                                        <td> <img style='display:block;' width='200px' height='200px'  src="Resource/<?= $if['gambar'] ?>"> </td>
                                        <td><a href="database/edit.php?id=<?=$if["id"];?>">Edit</a></td>
                                        <td><a href="database/delete.php?id=<?=$if["id"];?>">hapus</a></td>
                                    </tr>
                                    <?php $i++;
                                        endforeach; ?>
                                </tbody>
                            </div>
                        </div>
                    </table>
                </header>
            </section>
        </form>
    </body>
</html>