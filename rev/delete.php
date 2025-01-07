<?php
require_once 'connect.php';

try {
    if (isset($_GET['nis'])) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $nis = $db->escape($_GET['nis']);
        
        // Check if data exists
        $checkQuery = "SELECT Nis FROM siswa WHERE Nis = '$nis'";
        $result = mysqli_query($conn, $checkQuery);
        
        if (mysqli_num_rows($result) === 0) {
            throw new Exception("Data siswa tidak ditemukan!");
        }
        
        // Delete data
        $query = "DELETE FROM siswa WHERE Nis = '$nis'";
        
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?status=success&message=" . urlencode("Data berhasil dihapus!"));
        } else {
            throw new Exception("Error: " . mysqli_error($conn));
        }
    } else {
        throw new Exception("NIS tidak ditemukan!");
    }
} catch (Exception $e) {
    header("Location: index.php?status=error&message=" . urlencode($e->getMessage()));
}
exit();
?>
