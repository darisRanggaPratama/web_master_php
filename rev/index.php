<?php
require_once 'connect.php';
$db = Database::getInstance();
$conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        .card-header {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .modal-header {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Siswa</h4>
                <a href="add.php" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Siswa
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM siswa ORDER BY Nis";
                            $result = mysqli_query($conn, $query);
                            $no = 1;

                            
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>". $no++ ."</td>";
                                    echo "<td>{$row['Nis']}</td>";
                                    echo "<td>{$row['Nama']}</td>";
                                    echo "<td>{$row['Umur']}</td>";
                                    echo "<td>{$row['Seks']}</td>";
                                    echo "<td class='text-center'>";
                                    echo "<button class='btn btn-warning btn-action me-1' onclick='editData(\"{$row['Nis']}\", \"{$row['Nama']}\", {$row['Umur']}, \"{$row['Seks']}\")'>";
                                    echo "<i class='bi bi-pencil'></i>";
                                    echo "</button>";
                                    echo "<button class='btn btn-danger btn-action' onclick='confirmDelete(\"{$row['Nis']}\")'>";
                                    echo "<i class='bi bi-trash'></i>";
                                    echo "</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Tidak ada data siswa</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="update.php" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="editNis" name="nis" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                            <div class="invalid-feedback">Nama tidak boleh kosong</div>
                        </div>
                        <div class="mb-3">
                            <label for="editUmur" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="editUmur" name="umur" required min="1" max="100">
                            <div class="invalid-feedback">Umur harus antara 1-100 tahun</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seks" id="editPria" value="Pria" required>
                                    <label class="form-check-label" for="editPria">Pria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seks" id="editWanita" value="Wanita">
                                    <label class="form-check-label" for="editWanita">Wanita</label>
                                </div>
                                <div class="invalid-feedback">Pilih jenis kelamin</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Edit data
        function editData(nis, nama, umur, seks) {
            document.getElementById('editNis').value = nis;
            document.getElementById('editNama').value = nama;
            document.getElementById('editUmur').value = umur;
            if (seks === 'Pria') {
                document.getElementById('editPria').checked = true;
            } else {
                document.getElementById('editWanita').checked = true;
            }
            
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        // Delete confirmation
        function confirmDelete(nis) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?nis=${nis}`;
                }
            })
        }

        // Show success/error message from URL parameter
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');
            
            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Berhasil!' : 'Gagal!',
                    text: decodeURIComponent(message),
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    </script>
</body>
</html>
