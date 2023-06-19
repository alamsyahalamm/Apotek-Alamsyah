let semuaTombol = document.querySelectorAll('.btn-hapus');
semuaTombol.forEach(function (item) {
    item.addEventListener('click', konfirmasi);
})
function konfirmasi(event) {
    // Buat pesan error untuk setiap tipe tabel
    let tombol = event.currentTarget;
    let judulAlert;
    let teksAlert;
    switch (tombol.getAttribute('data-table')) {
        case 'obat':
            judulAlert = 'Hapus obat ' + tombol.getAttribute('data-name') + '?';
            teksAlert = 'Semua data <b>dosen</b>, <b>mahasiswa</b> dan ' +
                '<b>mata kuliah</b> untuk obat ini juga akan ' +
                'terhapus!';
            break;
        case 'jasa':
            judulAlert = 'Hapus jasa ' + tombol.getAttribute('data-name') + '?';
            teksAlert = 'Semua data <b>mata kuliah</b> untuk jasa ' +
                'ini juga akan terhapus!';
            break;
        case 'distributor':
            judulAlert = 'Hapus distributor ' + tombol.getAttribute('data-name') + '?';
            teksAlert = 'Semua data <b>mata kuliah</b> untuk distributor ' +
                'ini juga akan terhapus!';
            break;
        default:
            judulAlert = 'Apakah anda yakin?';
            teksAlert = 'Hapus data <b>' + tombol.getAttribute('data-name') + '</b>';
            break;
    }
    event.preventDefault();
    Swal.fire({
        title: judulAlert,
        html: teksAlert,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#6c757d',
        confirmButtonColor: '#dc3545',
        cancelButtonText: 'Tidak jadi',
        confirmButtonText: 'Ya, hapus!',

        reverseButtons: true,
    })
        .then((result) => {
            if (result.value) {
                tombol.parentElement.submit();
            }
        })
}