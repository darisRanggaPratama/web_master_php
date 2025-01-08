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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
    $file = $_FILES['csvFile'];
    $success = 0;
    $failed = 0;
    
    if ($file['type'] !== 'text/csv') {
        response(false, 'Please upload a CSV file');
    }
    
    $handle = fopen($file['tmp_name'], 'r');
    
    // Skip header row
    fgetcsv($handle, 1000, ';');
    
    while (($data = fgetcsv($handle, 1000, ';')) !== false) {
        if (count($data) === 4) {
            $nis = $db->escape($data[0]);
            $nama = $db->escape($data[1]);
            $umur = (int)$data[2];
            $seks = $db->escape($data[3]);
            
            if ($seks !== 'Pria' && $seks !== 'Wanita') {
                $failed++;
                continue;
            }
            
            $query = "INSERT INTO siswa (Nis, Nama, Umur, Seks) VALUES ('$nis', '$nama', $umur, '$seks')";
            
            if (mysqli_query($conn, $query)) {
                $success++;
            } else {
                $failed++;
            }
        } else {
            $failed++;
        }
    }
    
    fclose($handle);
    
    response(true, "Upload completed: $success successful, $failed failed");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['download'])) {
    $query = "SELECT * FROM siswa ORDER BY Nis";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $filename = "students_" . date('Y-m-d_His') . ".csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Write header
        fputcsv($output, ['Nis', 'Nama', 'Umur', 'Seks'], ';');
        
        $success = 0;
        $failed = 0;
        
        while ($row = mysqli_fetch_assoc($result)) {
            if (fputcsv($output, $row, ';')) {
                $success++;
            } else {
                $failed++;
            }
        }
        
        fclose($output);
        
        // Send count via header since we can't use regular response
        header("X-Download-Success: $success");
        header("X-Download-Failed: $failed");
        exit;
    } else {
        response(false, 'Failed to retrieve data');
    }
}
?>
