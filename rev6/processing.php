<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .result-card {
            animation: fadeIn 0.5s ease-out;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.1);
            transform: scale(1.01);
        }
        
        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        .no-results {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">
    <a href="searching.php" class="btn btn-primary btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Pencarian
    </a>

    <div class="container mt-5 py-5">
        <div class="card shadow-lg result-card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="bi bi-table me-2"></i>
                    Hasil Pencarian
                </h3>
            </div>
            <div class="card-body">
                <?php
                include 'connect.php';
                $bagianWhere = "";
                $db = Database::getInstance();
                $connect = $db->getConnection();

                if (isset($_POST['nisCat'])) {
                    $nis = $db->escape($_POST['Nis']);
                    if (empty($bagianWhere)) {
                        $bagianWhere .= "Nis = '$nis'";
                    }
                }

                if (isset($_POST['namaCat'])) {
                    $nama = $db->escape($_POST['Nama']);
                    if (empty($bagianWhere)) {
                        $bagianWhere .= "Nama LIKE '%$nama%'";
                    } else {
                        $bagianWhere .= " AND Nama LIKE '%$nama%'";
                    }
                }

                if (isset($_POST['umurCat'])) {
                    $umur = $db->escape($_POST['Umur']);
                    if (empty($bagianWhere)) {
                        $bagianWhere .= "Umur = '$umur'";
                    } else {
                        $bagianWhere .= " AND Umur = '$umur'";
                    }
                }

                if (isset($_POST['sexCat'])) {
                    $seks = $db->escape($_POST['Seks']);
                    if (empty($bagianWhere)) {
                        $bagianWhere .= "Seks = '$seks'";
                    } else {
                        $bagianWhere .= " AND Seks = '$seks'";
                    }
                }

                if (empty($bagianWhere)) {
                    echo '<div class="no-results">
                            <i class="bi bi-exclamation-circle display-1 text-muted"></i>
                            <h4 class="mt-3">Tidak ada kriteria pencarian yang dipilih</h4>
                            <p class="text-muted">Silakan pilih minimal satu kriteria pencarian</p>
                          </div>';
                } else {
                    $query = "SELECT * FROM siswa WHERE " . $bagianWhere;
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        
                        $no = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
                                    <td>$no</td>
                                    <td>{$row['Nis']}</td>
                                    <td>{$row['Nama']}</td>
                                    <td>{$row['Umur']}</td>
                                    <td>{$row['Seks']}</td>
                                  </tr>";
                            $no++;
                        }
                        
                        echo '</tbody></table></div>';
                    } else {
                        echo '<div class="no-results">
                                <i class="bi bi-search display-1 text-muted"></i>
                                <h4 class="mt-3">Tidak ada hasil</h4>
                                <p class="text-muted">Tidak ditemukan data yang sesuai dengan kriteria pencarian</p>
                              </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
