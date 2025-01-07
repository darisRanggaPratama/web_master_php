<?php
require_once 'connect.php';

header('Content-Type: application/json');

$db = Database::getInstance();
$conn = $db->getConnection();

function response($status, $message, $data = null) {
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM siswa ORDER BY Nis";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        response(true, 'Data retrieved successfully', $data);
    } else {
        response(false, 'Failed to retrieve data');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nis = $db->escape($data['nis']);
    $nama = $db->escape($data['nama']);
    $umur = (int)$data['umur'];
    $seks = $db->escape($data['seks']);
    
    $query = "INSERT INTO siswa (Nis, Nama, Umur, Seks) VALUES ('$nis', '$nama', $umur, '$seks')";
    
    if (mysqli_query($conn, $query)) {
        response(true, 'Data added successfully');
    } else {
        response(false, 'Failed to add data: ' . mysqli_error($conn));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $oldNis = $db->escape($data['oldNis']);
    $nis = $db->escape($data['nis']);
    $nama = $db->escape($data['nama']);
    $umur = (int)$data['umur'];
    $seks = $db->escape($data['seks']);
    
    $query = "UPDATE siswa SET Nis='$nis', Nama='$nama', Umur=$umur, Seks='$seks' WHERE Nis='$oldNis'";
    
    if (mysqli_query($conn, $query)) {
        response(true, 'Data updated successfully');
    } else {
        response(false, 'Failed to update data: ' . mysqli_error($conn));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['nis'])) {
        $nis = $db->escape($data['nis']);
        $query = "DELETE FROM siswa WHERE Nis='$nis'";
    } else {
        $query = "DELETE FROM siswa";
    }
    
    if (mysqli_query($conn, $query)) {
        response(true, 'Data deleted successfully');
    } else {
        response(false, 'Failed to delete data: ' . mysqli_error($conn));
    }
}
?>
