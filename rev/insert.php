<?php
require_once 'connect.php';

function displayAlert($message, $type = 'success') {
    return "
    <div class='container mt-4'>
        <div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
            {$message}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    </div>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        // Validate and sanitize input
        $nis = $db->escape($_POST['txtnis']);
        $nama = $db->escape($_POST['txtnama']);
        $umur = filter_var($_POST['txtumur'], FILTER_VALIDATE_INT);
        $seks = $db->escape($_POST['rdoseks']);
        
        // Validation checks
        if (empty($nis) || empty($nama) || $umur === false || empty($seks)) {
            throw new Exception("Semua field harus diisi dengan benar!");
        }
        
        if (!preg_match('/^[0-9]{3}$/', $nis)) {
            throw new Exception("NIS harus berupa 10 digit angka!");
        }
        
        if ($umur < 1 || $umur > 100) {
            throw new Exception("Umur harus antara 1-100 tahun!");
        }
        
        if (!in_array($seks, ['Pria', 'Wanita'])) {
            throw new Exception("Jenis kelamin tidak valid!");
        }
        
        // Check if NIS already exists
        $checkQuery = "SELECT Nis FROM siswa WHERE Nis = '$nis'";
        $result = mysqli_query($conn, $checkQuery);
        
        if (mysqli_num_rows($result) > 0) {
            throw new Exception("NIS sudah terdaftar!");
        }
        
        // Insert data
        $query = "INSERT INTO siswa (Nis, Nama, Umur, Seks) VALUES ('$nis', '$nama', $umur, '$seks')";
        
        if (mysqli_query($conn, $query)) {
            echo displayAlert("
                <i class='bi bi-check-circle-fill'></i> Data berhasil disimpan!
                <br>
                <div class='mt-2'>
                    <a href='add.php' class='btn btn-sm btn-primary me-2'>
                        <i class='bi bi-plus-circle'></i> Tambah Data Baru
                    </a>
                    <a href='index.php' class='btn btn-sm btn-info'>
                        <i class='bi bi-table'></i> Lihat Data
                    </a>
                </div>
            ");
        } else {
            throw new Exception("Error: " . mysqli_error($conn));
        }
    }
} catch (Exception $e) {
    echo displayAlert($e->getMessage(), 'danger');
    echo "
    <div class='container text-center mt-3'>
        <a href='javascript:history.back()' class='btn btn-primary'>
            <i class='bi bi-arrow-left'></i> Kembali
        </a>
    </div>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
