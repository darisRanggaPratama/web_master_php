<?php
require_once 'siswa.php';

$siswa = new Siswa();
$action = $_POST['action'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'get':
        echo json_encode(['status' => 'success', 'data' => $siswa->getAllSiswa()]);
        break;
        
    case 'add':
        $result = $siswa->addSiswa(
            $_POST['nis'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['seks']
        );
        echo json_encode(['status' => $result ? 'success' : 'error']);
        break;
        
    case 'update':
        $result = $siswa->updateSiswa(
            $_POST['nis'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['seks']
        );
        echo json_encode(['status' => $result ? 'success' : 'error']);
        break;
        
    case 'delete':
        $result = $siswa->deleteSiswa($_POST['nis']);
        echo json_encode(['status' => $result ? 'success' : 'error']);
        break;
        
    case 'truncate':
        $result = $siswa->truncateTable();
        echo json_encode(['status' => $result ? 'success' : 'error']);
        break;
        
    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>
