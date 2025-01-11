document.addEventListener('DOMContentLoaded', function () {
    loadData();

    // Event Listeners
    document.getElementById('addButton').addEventListener('click', handleAdd);
    document.getElementById('editButton').addEventListener('click', handleEdit);
    document.getElementById('deleteAllBtn').addEventListener('click', handleDeleteAll);
    // Add this to existing event listeners
    document.getElementById('csvUpload').addEventListener('change', handleUpload);
});

function loadData() {
    fetch('crud.php')
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const tbody = document.getElementById('studentTableBody');
                tbody.innerHTML = '';

                data.data.forEach((student, index) => {
                    const row = document.createElement('tr');
                    row.dataset.nis = student.Nis; // Menambahkan data-nis attribute
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>
                         <button class="btn btn-sm btn-primary me-2" onclick="showEditModal('${student.Nis}', '${student.Nama}', ${student.Umur}, '${student.Seks}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                        <td>${student.Nis}</td>
                        <td>${student.Nama}</td>
                        <td>${student.Umur}</td>
                        <td>${student.Seks}</td>
                        <td>                           
                            <button class="btn btn-sm btn-danger" onclick="handleDelete('${student.Nis}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        });
}

function handleAdd() {
    const form = document.getElementById('addForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menambah data ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('crud.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire('Sukses', data.message, 'success');
                        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                        form.reset();
                        loadData();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
        }
    });
}

function showEditModal(nis, nama, umur, seks) {
    const form = document.getElementById('editForm');
    form.oldNis.value = nis;
    form.nis.value = nis;
    form.nama.value = nama;
    form.umur.value = umur;
    form.seks.value = seks;

    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function handleEdit() {
    const form = document.getElementById('editForm');
    const formData = new FormData(form);
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
                .then(data => {
                    if (data.status) {
                        Swal.fire('Sukses', data.message, 'success');
                        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                        loadData();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
        }
    });
}

function handleDelete(nis) {
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
            // Menggunakan data-nis attribute untuk menemukan baris yang akan dihapus
            const row = document.querySelector(`tr[data-nis="${nis}"]`);
            if (row) {
                row.classList.add('delete-animation');

                setTimeout(() => {
                    fetch('crud.php', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({nis: nis})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                Swal.fire('Sukses', data.message, 'success');
                                loadData();
                            } else {
                                Swal.fire('Error', data.message, 'error');
                                row.classList.remove('delete-animation');
                            }
                        });
                }, 500);
            }
        }
    });
}

function handleDeleteAll() {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus semua data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#dc3545'
    }).then((result) => {
        if (result.isConfirmed) {
            const rows = document.querySelectorAll('#studentTableBody tr');
            rows.forEach(row => row.classList.add('delete-animation'));

            setTimeout(() => {
                fetch('crud.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            Swal.fire('Sukses', data.message, 'success');
                            loadData();
                        } else {
                            Swal.fire('Error', data.message, 'error');
                            rows.forEach(row => row.classList.remove('delete-animation'));
                        }
                    });
            }, 500);
        }
    });
}

function handleUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('csvFile', file);

    Swal.fire({
        title: 'Uploading...',
        text: 'Please wait while we process your file',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('csv_operations.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                Swal.fire('Success', data.message, 'success');
                loadData();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
            event.target.value = ''; // Reset file input
        })
        .catch(error => {
            Swal.fire('Error', 'An error occurred during upload', 'error');
            event.target.value = ''; // Reset file input
        });
}

function handleDownload() {
    Swal.fire({
        title: 'Downloading...',
        text: 'Please wait while we prepare your file',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('csv_operations.php?download=true')
        .then(response => {
            const success = response.headers.get('X-Download-Success');
            const failed = response.headers.get('X-Download-Failed');

            if (response.ok) {
                response.blob().then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `students_${new Date().toISOString().slice(0, 10)}.csv`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    a.remove();

                    Swal.fire('Success', `Download completed: ${success} successful, ${failed} failed`, 'success');
                });
            } else {
                throw new Error('Download failed');
            }
        })
        .catch(error => {
            Swal.fire('Error', 'An error occurred during download', 'error');
        });
}
