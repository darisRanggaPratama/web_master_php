<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Input Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: none;
            border-radius: 15px;
        }
        .card-header {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">Data Siswa</h3>
                    </div>
                    <div class="card-body">
                        <form id="studentForm" method="post" action="insert.php" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="txtnis" required 
                                       pattern="[0-9]{3}" maxlength="10">
                                <div class="invalid-feedback">
                                    Please enter a valid 3-digit NIS number.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="txtnama" required>
                                <div class="invalid-feedback">
                                    Please enter the student's name.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control" id="umur" name="txtumur" 
                                       required min="1" max="100">
                                <div class="invalid-feedback">
                                    Please enter a valid age between 1 and 100.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label d-block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rdoseks" 
                                           id="pria" value="Pria" required>
                                    <label class="form-check-label" for="pria">Pria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rdoseks" 
                                           id="wanita" value="Wanita">
                                    <label class="form-check-label" for="wanita">Wanita</label>
                                </div>
                                <div class="invalid-feedback">
                                    Please select a gender.
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="bi bi-x-circle"></i> Reset
                                </button>
                                <a href="index.php" class="btn btn-info">
                                    <i class="bi bi-table"></i> Lihat Data
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>
</html>
