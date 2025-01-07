document.addEventListener('DOMContentLoaded', function () {
    // Add Form Handler
    document.getElementById('addForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda yakin ingin menambah data siswa ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(this);
                formData.append('action', 'create');

                fetch('ajax.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', 'Data siswa berhasil ditambahkan', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', 'Gagal menambahkan data', 'error');
                        }
                    });
            }
        });
    });

    // Edit Form Handler
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda yakin ingin mengubah data siswa ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(this);
                formData.append('action', 'update');

                fetch('ajax.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', 'Data siswa berhasil diupdate', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', 'Gagal mengupdate data', 'error');
                        }
                    });
            }
        });
    });

    // Edit Button Click Handler
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = document.getElementById('editForm');
            form.querySelector('[name="nis"]').value = this.dataset.nis;
            form.querySelector('[name="nama"]').value = this.dataset.nama;
            form.querySelector('[name="umur"]').value = this.dataset.umur;
            form.querySelector('[name="seks"]').value = this.dataset.seks;
        });
    });

    // Delete Button Click Handler
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('tr');
            const nis = row.dataset.id;

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah anda yakin ingin menghapus data siswa ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('action', 'delete');
                    formData.append('nis', nis);

                    // Tambahkan efek terbakar sebelum menghapus
                    row.classList.add('burning');

                    // Tunggu animasi selesai baru kirim request
                    setTimeout(() => {
                        fetch('ajax.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', 'Data siswa berhasil dihapus', 'success');
                                    row.remove();
                                } else {
                                    Swal.fire('Error!', 'Gagal menghapus data', 'error');
                                    row.classList.remove('burning');
                                }
                            });
                    }, 1000); // Waktu tunggu sesuai durasi animasi
                }
            });
        });
    });

    // Truncate Button Click Handler
    document.getElementById('truncateBtn').addEventListener('click', function () {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Apakah anda yakin ingin menghapus SEMUA data siswa? Aksi ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('action', 'truncate');

                // Tambahkan efek terbakar ke semua baris
                const rows = document.querySelectorAll('#siswaTable tbody tr');
                rows.forEach(row => row.classList.add('burning'));

                // Tunggu animasi selesai baru kirim request
                setTimeout(() => {
                    fetch('ajax.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Berhasil!', 'Semua data siswa berhasil dihapus', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error!', 'Gagal menghapus data', 'error');
                                rows.forEach(row => row.classList.remove('burning'));
                            }
                        });
                }, 1000);
            }
        });
    });
});