<html>
<head>
    <title>
        INSERT DATA
    </title>
</head>
<body>
<?php
global $connect; // Pastikan ada spasi antara 'global' dan '$connect'
include "connect.php"; // Mengimpor file koneksi

if ($connect) {
    // Mengambil data dari form dengan sanitasi untuk mencegah SQL injection
    $NIS = mysqli_real_escape_string($connect, $_POST['txtnis']);
    $NAMA = mysqli_real_escape_string($connect, $_POST['txtnama']);
    $UMUR = mysqli_real_escape_string($connect, $_POST['txtumur']);
    $SEX = mysqli_real_escape_string($connect, $_POST['rdoseks']);

    // Menyiapkan query SQL dengan parameter
    $SQL = "INSERT INTO siswa (Nis, Nama, Umur, Seks) VALUES ('$NIS', '$NAMA', '$UMUR', '$SEX')";

    // Menjalankan query dan mengecek hasilnya
    if (mysqli_query($connect, $SQL)) {
        echo "SUKSES KIRIM DATA"."<br>";
        echo "[<a href='view.php'>VIEW DATA</a>]";
    } else {
        die("GAGAL KIRIM DATA! <br> [" . mysqli_error($connect) . "] <br> [<a href='view.php'>VIEW DATA</a>]");
    }
}
?>

</body>
</html>
