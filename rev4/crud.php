<?php
require_once 'connect.php';

class SiswaController {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM siswa ORDER BY Nis";
        $result = mysqli_query($conn, $query);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function create($nis, $nama, $umur, $seks) {
        $conn = $this->db->getConnection();
        $nis = $this->db->escape($nis);
        $nama = $this->db->escape($nama);
        $umur = (int)$umur;
        $seks = $this->db->escape($seks);
        
        $query = "INSERT INTO siswa (Nis, Nama, Umur, Seks) 
                  VALUES ('$nis', '$nama', $umur, '$seks')";
        
        return mysqli_query($conn, $query);
    }
    
    public function update($nis, $nama, $umur, $seks) {
        $conn = $this->db->getConnection();
        $nis = $this->db->escape($nis);
        $nama = $this->db->escape($nama);
        $umur = (int)$umur;
        $seks = $this->db->escape($seks);
        
        $query = "UPDATE siswa 
                  SET Nama = '$nama', Umur = $umur, Seks = '$seks'
                  WHERE Nis = '$nis'";
        
        return mysqli_query($conn, $query);
    }
    
    public function delete($nis) {
        $conn = $this->db->getConnection();
        $nis = $this->db->escape($nis);
        
        $query = "DELETE FROM siswa WHERE Nis = '$nis'";
        return mysqli_query($conn, $query);
    }
    
    public function truncate() {
        $conn = $this->db->getConnection();
        $query = "TRUNCATE TABLE siswa";
        return mysqli_query($conn, $query);
    }
}
