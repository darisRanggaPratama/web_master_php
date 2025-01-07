<?php
require_once 'connect.php';
$db = Database::getInstance();
$conn = $db->getConnection();

// Handle CRUD Operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $response = ['status' => 'error', 'message' => 'Unknown error occurred'];

        switch ($_POST['action']) {
            case 'create':
                $nis = $db->escape($_POST['nis']);
                $nama = $db->escape($_POST['nama']);
                $umur = (int)$_POST['umur'];
                $seks = $db->escape($_POST['seks']);

                $sql = "INSERT INTO siswa (Nis, Nama, Umur, Seks) VALUES ('$nis', '$nama', $umur, '$seks')";
                if ($conn->query($sql)) {
                    $response = ['status' => 'success', 'message' => 'Data siswa berhasil ditambahkan'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal menambahkan data: ' . $conn->error];
                }
                break;

            case 'update':
                $nis = $db->escape($_POST['nis']);
                $nama = $db->escape($_POST['nama']);
                $umur = (int)$_POST['umur'];
                $seks = $db->escape($_POST['seks']);

                $sql = "UPDATE siswa SET Nama='$nama', Umur=$umur, Seks='$seks' WHERE Nis='$nis'";
                if ($conn->query($sql)) {
                    $response = ['status' => 'success', 'message' => 'Data siswa berhasil diperbarui'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal memperbarui data: ' . $conn->error];
                }
                break;

            case 'delete':
                $nis = $db->escape($_POST['nis']);
                $sql = "DELETE FROM siswa WHERE Nis='$nis'";
                if ($conn->query($sql)) {
                    $response = ['status' => 'success', 'message' => 'Data siswa berhasil dihapus'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal menghapus data: ' . $conn->error];
                }
                break;

            case 'truncate':
                $sql = "TRUNCATE TABLE siswa";
                if ($conn->query($sql)) {
                    $response = ['status' => 'success', 'message' => 'Semua data siswa berhasil dihapus'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal menghapus semua data: ' . $conn->error];
                }
                break;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 20px;
            margin: 20px 0;
        }
        .btn-floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .table th {
            background: linear-gradient(45deg, #1a237e, #283593);
            color: white;
        }
        .modal-content {
            border-radius: 15px;
        }
        .animate-fade {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="table-container animate-fade">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="bi bi-people-fill me-2"></i>Data Siswa</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-lg me-2"></i>Tambah Siswa
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $conn->query("SELECT * FROM siswa ORDER BY Nis");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                    <td>{$row['Nis']}</td>
                                    <td>{$row['Nama']}</td>
                                    <td>{$row['Umur']}</td>
                                    <td>{$row['Seks']}</td>
                                    <td>
                                        <button class='btn btn-sm btn-warning edit-btn' 
                                                data-nis='{$row['Nis']}'
                                                data-nama='{$row['Nama']}'
                                                data-umur='{$row['Umur']}'
                                                data-seks='{$row['Seks']}'>
                                            <i class='bi bi-pencil'></i>
                                        </button>
                                        <button class='btn btn-sm btn-danger delete-btn' data-nis='{$row['Nis']}'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </td>
                                </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Floating Delete All Button -->
<button class="btn btn-danger btn-lg btn-floating rounded-circle" id="deleteAllBtn">
    <i class="bi bi-trash3-fill"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Siswa Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <input type="hidden" name="action" value="create">
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Umur</label>
                        <input type="number" class="form-control" name="umur" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="seks" required>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveAddBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="nis" id="editNis">
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
                <button type="button" class="btn btn-primary" id="saveEditBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Data
        document.getElementById('saveAddBtn').addEventListener('click', function() {
            const form = document.getElementById('addForm');
            const formData = new FormData(form);

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data siswa ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: data.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                text: data.message,
                                icon: data.status,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                if (data.status === 'success') {
                                    location.reload();
                                }
                            });
                        });
                }
            });
        });

        // Edit Data
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                document.getElementById('editNis').value = this.dataset.nis;
                document.getElementById('editNama').value = this.dataset.nama;
                document.getElementById('editUmur').value = this.dataset.umur;
                document.getElementById('editSeks').value = this.dataset.seks;
                modal.show();
            });
        });

        // Save Edit
        document.getElementById('saveEditBtn').addEventListener('click', function() {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengubah data siswa ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: data.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                text: data.message,
                                icon: data.status,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                if (data.status === 'success') {
                                    location.reload();
                                }
                            });
                        });
                }
            });
        });

        // Delete Single Data
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const nis = this.dataset.nis;
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus data siswa ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('action', 'delete');
                        formData.append('nis', nis);

                        fetch(window.location.href, {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    title: data.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                    text: data.message,
                                    icon: data.status,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    if (data.status === 'success') {
                                        location.reload();
                                    }
                                });
                            });
                    }
                });
            });
        });

        // Delete All Data
        document.getElementById('deleteAllBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus SEMUA data siswa? Tindakan ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('action', 'truncate');

                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: data.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                text: data.message,
                                icon: data.status,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                if (data.status === 'success') {
                                    location.reload();
                                }
                            });
                        });
                }
            });
        });

        // Form Validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });

        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
</body>
</html>
