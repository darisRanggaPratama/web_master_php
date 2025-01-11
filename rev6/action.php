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

        /* Animation for updated row */
        @keyframes blink {
            0%, 100% { background-color: transparent; }
            50% { background-color: rgba(40, 167, 69, 0.2); }
        }

        .row-updated {
            animation: blink 1s ease-in-out 3;
        }

        /* Animation for deleted row */
        @keyframes slideOut {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-100%);
            }
        }

        .row-deleted {
            animation: slideOut 0.5s ease-out forwards;
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
                                            <th>Edit</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Gender</th>
                                            <th>Drop</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        
                        $no = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr id='row-{$row['Nis']}'>
                                    <td>$no</td>
                                    <td>
                                    <button class='btn btn-sm btn-primary me-2' onclick='showEditModal(\"{$row['Nis']}\", \"{$row['Nama']}\", {$row['Umur']}, \"{$row['Seks']}\")'>
                                            <i class='bi bi-pencil'></i>
                                        </button>
                                    </td>
                                    <td>{$row['Nis']}</td>
                                    <td>{$row['Nama']}</td>
                                    <td>{$row['Umur']}</td>
                                    <td>{$row['Seks']}</td>
                                    <td>                                        
                                        <button class='btn btn-sm btn-danger' onclick='confirmDelete(\"{$row['Nis']}\")'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </td>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Data Siswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" name="oldNis" id="oldNis">
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" class="form-control" name="nis" id="editNis" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="editNama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="number" class="form-control" name="umur" id="editUmur" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="seks" id="editSeks" required>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="handleEdit()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showEditModal(nis, nama, umur, seks) {
            document.getElementById('oldNis').value = nis;
            document.getElementById('editNis').value = nis;
            document.getElementById('editNama').value = nama;
            document.getElementById('editUmur').value = umur;
            document.getElementById('editSeks').value = seks;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        function handleEdit() {
            const formData = new FormData(document.getElementById('editForm'));
            const data = Object.fromEntries(formData);

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengubah data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('crud.php', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.status) {
                            Swal.fire('Sukses', response.message, 'success');
                            const row = document.getElementById(`row-${data.oldNis}`);
                            row.classList.add('row-updated');
                            setTimeout(() => {
                                row.cells[1].textContent = data.nis;
                                row.cells[2].textContent = data.nama;
                                row.cells[3].textContent = data.umur;
                                row.cells[4].textContent = data.seks;
                                row.id = `row-${data.nis}`;
                            }, 500);
                            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    });
                }
            });
        }

        function confirmDelete(nis) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    const row = document.getElementById(`row-${nis}`);
                    row.classList.add('row-deleted');
                    
                    setTimeout(() => {
                        fetch('crud.php', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({nis: nis})
                        })
                        .then(response => response.json())
                        .then(response => {
                            if (response.status) {
                                Swal.fire('Sukses', response.message, 'success');
                                row.remove();
                            } else {
                                Swal.fire('Error', response.message, 'error');
                                row.classList.remove('row-deleted');
                            }
                        });
                    }, 500);
                }
            });
        }
    </script>
</body>
</html>
