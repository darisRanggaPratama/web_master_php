<?php
require_once 'connect.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        // Validate and sanitize input
        $nis = $db->escape($_POST['nis']);
        $nama = $db->escape($_POST['nama']);
        $umur = filter_var($_POST['umur'], FILTER_VALIDATE_INT);
        $seks = $db->escape($_POST['seks']);
        
        // Validation checks
        if (empty($nis) || empty($nama) || $umur === false || empty($seks)) {
            throw new Exception("Semua field harus diisi dengan benar!");
        }
        
        if ($umur < 1 || $umur > 100) {
            throw new Exception("Umur harus antara 1-100 tahun!");
        }
        
        if (!in_array($seks, ['Pria', 'Wanita'])) {
            throw new Exception("Jenis kelamin tidak valid!");
        }
        
        // Update data
        $query = "UPDATE siswa SET Nama = '$nama', Umur = $umur, Seks = '$seks' WHERE Nis = '$nis'";
        
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?status=success&message=" . urlencode("Data berhasil diperbarui!"));
        } else {
            throw new Exception("Error: " . mysqli_error($conn));
        }
    }
} catch (Exception $e) {
    header("Location: index.php?status=error&message=" . urlencode($e->getMessage()));
}
exit();
?>
