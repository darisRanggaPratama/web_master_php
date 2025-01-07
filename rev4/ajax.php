<?php
require_once 'crud.php';

$siswa = new SiswaController();
$action = $_POST['action'] ?? '';

header('Content-Type: application/json');

switch($action) {
    case 'create':
        $result = $siswa->create(
            $_POST['nis'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['seks']
        );
        echo json_encode(['success' => $result]);
        break;
        
    case 'update':
        $result = $siswa->update(
            $_POST['nis'],
            $_POST['nama'],
            $_POST['umur'],
            $_POST['seks']
        );
        echo json_encode(['success' => $result]);
        break;
        
    case 'delete':
        $result = $siswa->delete($_POST['nis']);
        echo json_encode(['success' => $result]);
        break;
        
    case 'truncate':
        $result = $siswa->truncate();
        echo json_encode(['success' => $result]);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
