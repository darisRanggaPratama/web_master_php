document.addEventListener('DOMContentLoaded', function() {
    loadData();

    // Event Listeners
    document.getElementById('addForm').addEventListener('submit', handleAdd);
    document.getElementById('editForm').addEventListener('submit', handleEdit);
    document.getElementById('deleteAllBtn').addEventListener('click', handleDeleteAll);

    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function loadData() {
    fetch('crud.php')
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const tbody = document.querySelector('#siswaTable tbody');
                tbody.innerHTML = '';

                data.data.forEach(siswa => {
                    const row = `
                        <tr>
                            <td>${siswa.Nis}</td>
                            <td>${siswa.Nama}</td>
                            <td>${siswa.Umur}</td>
                            <td>${siswa.Seks}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="showEditModal('${siswa.Nis}', '${siswa.Nama}', ${siswa.Umur}, '${siswa.Seks}')" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="handleDelete('${siswa.Nis}')" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }
        })
        .catch(error => showAlert('error', 'Gagal memuat data'));
}

function handleAdd(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
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
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        showAlert('success', data.message);
                        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                        e.target.reset();
                        loadData();
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => showAlert('error', 'Gagal menambah data'));
        }
    });
}

function showEditModal(nis, nama, umur, seks) {
    const form = document.getElementById('editForm');
    form.elements['oldNis'].value = nis;
    form.elements['nis'].value = nis;
    form.elements['nama'].value = nama;
    form.elements['umur'].value = umur;
    form.elements['seks'].value = seks;

    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function handleEdit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
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
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        showAlert('success', data.message);
                        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                        loadData();
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => showAlert('error', 'Gagal mengubah data'));
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
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('crud.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ nis: nis })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        showAlert('success', data.message);
                        loadData();
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => showAlert('error', 'Gagal menghapus data'));
        }
    });
}

function handleDeleteAll() {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus SEMUA data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        dangerMode: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('crud.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        showAlert('success', data.message);
                        loadData();
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => showAlert('error', 'Gagal menghapus semua data'));
        }
    });
}

function showAlert(icon, text) {
    Swal.fire({
        icon: icon,
        text: text,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}