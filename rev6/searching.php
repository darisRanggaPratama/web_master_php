<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .search-card {
            transition: transform 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .search-card:hover {
            transform: translateY(-5px);
        }
        
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        
        .search-animation {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body class="bg-light">
    <a href="index.php" class="btn btn-primary btn-back">
        <i class="bi bi-arrow-left-circle"></i> Home
    </a>

    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg search-card search-animation">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="bi bi-search me-2"></i>
                            Pencarian Data Siswa
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="processing.php" id="searchForm">
                            <div class="mb-4">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="nisCat" name="nisCat">
                                    <label class="form-check-label" for="nisCat">NIS</label>
                                    <input type="text" class="form-control mt-2" name="Nis" id="nisInput" disabled>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="namaCat" name="namaCat">
                                    <label class="form-check-label" for="namaCat">Nama</label>
                                    <input type="text" class="form-control mt-2" name="Nama" id="namaInput" disabled>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="umurCat" name="umurCat">
                                    <label class="form-check-label" for="umurCat">Umur</label>
                                    <input type="number" class="form-control mt-2" name="Umur" id="umurInput" disabled>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="sexCat" name="sexCat">
                                    <label class="form-check-label" for="sexCat">Jenis Kelamin</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="Seks" value="Pria" id="priaCat" disabled>
                                            <label class="form-check-label" for="priaCat">Pria</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="Seks" value="Wanita" id="wanitaCat" disabled>
                                            <label class="form-check-label" for="wanitaCat">Wanita</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-2"></i>Cari Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable/disable inputs based on checkbox state
        document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const inputId = this.id.replace('Cat', 'Input');
                const input = document.getElementById(inputId);
                if (input) {
                    input.disabled = !this.checked;
                    if (!this.checked) input.value = '';
                }
                
                if (this.id === 'sexCat') {
                    document.getElementById('priaCat').disabled = !this.checked;
                    document.getElementById('wanitaCat').disabled = !this.checked;
                    if (!this.checked) {
                        document.getElementById('priaCat').checked = false;
                        document.getElementById('wanitaCat').checked = false;
                    }
                }
            });
        });

        // Form submission animation
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            document.querySelector('.search-card').style.animation = 'slideOut 0.5s ease-out forwards';
        });
    </script>
</body>
</html>
