<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Siswa</h3>
            <div>
                <div class="dropdown">
                    <button class="btn btn-primary" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-filter-circle"></i>
                        Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="btn btn-primary" onclick="location.href = 'searching.php';">
                                <i class="bi bi-search"></i> Searching
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-secondary" onclick="location.href = 'browsing.php';">
                                <i class="bi bi-exposure"></i> Updating
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus-circle"></i> Add Data
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-danger" id="deleteAllBtn">
                                <i class="bi bi-trash"></i> Delete All
                            </button>
                        </li>
                        <!-- Add this inside the dropdown menu in index.php -->
                        <li>
                            <button class="btn btn-info" onclick="document.getElementById('csvUpload').click()">
                                <i class="bi bi-upload"></i> Send CSV
                            </button>
                            <input type="file" id="csvUpload" accept=".csv" style="display: none">
                        </li>
                        <li>
                            <button class="btn btn-warning" onclick="handleDownload()">
                                <i class="bi bi-download"></i> G e t CSV
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                    <tbody id="studentTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
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
                <button type="button" class="btn btn-success" id="addButton">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" name="oldNis">
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
                <button type="button" class="btn btn-primary" id="editButton">Update</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>
</body>
</html>
