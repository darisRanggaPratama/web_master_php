document.addEventListener('DOMContentLoaded', function() {
    loadData();

    // Event Listeners
    document.getElementById('saveBtn').addEventListener('click', handleAdd);
    document.getElementById('updateBtn').addEventListener('click', handleUpdate);
    document.getElementById('truncateBtn').addEventListener('click', handleTruncate);
    
    // Reset form when modal is hidden
    ['addModal', 'editModal'].forEach(modalId => {
        document.getElementById(modalId).addEventListener('hidden.bs.modal', function() {
            document.querySelector(`#${modalId} form`).reset();
        });
    });
});

function loadData() {
    fetch('handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=get'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const tbody = document.getElementById('siswaTableBody');
            tbody.innerHTML = '';
            
            data.data.forEach(siswa => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${siswa.Nis}</td>
                    <td>${siswa.Nama}</td>
                    <td>${siswa.Umur}</td>
                    <td>${siswa.Seks}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="prepareEdit('${siswa.Nis}', '${siswa.Nama}', ${siswa.Umur}, '${siswa.Seks}')">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="handleDelete('${siswa.Nis}', this)">
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
    formData.append('action', 'add');

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menambah data ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Berhasil!', 'Data berhasil ditambahkan', 'success');
                    bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                    loadData();
                } else {
                    Swal.fire('Error!', 'Gagal menambahkan data', 'error');
                }
            });
        }
    });
}

function prepareEdit(nis, nama, umur, seks) {
    const form = document.getElementById('editForm');
    form.elements['nis'].value = nis;
    form.elements['nama'].value = nama;
    form.elements['umur'].value = umur;
    form.elements['seks'].value = seks;
    form.querySelector('input[disabled]').value = nis;
    
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

function handleUpdate() {
    const form = document.getElementById('editForm');
    const formData = new FormData(form);
    formData.append('action', 'update');

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin mengubah data ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Berhasil!', 'Data berhasil diperbarui', 'success');
                    bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                    loadData();
                } else {
                    Swal.fire('Error!', 'Gagal memperbarui data', 'error');
                }
            });
        }
    });
}

function handleDelete(nis, button) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            const row = button.closest('tr');
            row.classList.add('delete-animation');
            
            setTimeout(() => {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('nis', nis);

                fetch('handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Berhasil!', 'Data berhasil dihapus', 'success');
                        loadData();
                    } else {
                        Swal.fire('Error!', 'Gagal menghapus data', 'error');
                        row.classList.remove('delete-animation');
                    }
                });
            }, 500);
        }
    });
}

function handleTruncate() {
    Swal.fire({
        title: 'Peringatan!',
        text: 'Apakah Anda yakin ingin menghapus SEMUA data? Tindakan ini tidak dapat dibatalkan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('action', 'truncate');

            fetch('handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Berhasil!', 'Semua data telah dihapus', 'success');
                    loadData();
                } else {
                    Swal.fire('Error!', 'Gagal menghapus data', 'error');
                }
            });
        }
    });
}
