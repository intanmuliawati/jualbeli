//  script untuk semua data berhasil data pemesanan
const flashData = $('.flash-data').data('flashdata');

if (flashData == "error") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Format gambar salah!'
  })
}
if (flashData == "lebih dari stok!") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Pembelian melebihi stok!'
  })
}
else if (flashData == "daftar!") {
  Swal.fire({
    title: 'Akun ',
    text: 'berhasil ' + flashData,
    type: 'terdaftar'
  });
}
else if (flashData == "diinput!") {
  Swal.fire({
    title: 'Data',
    text: 'berhasil ' + flashData,
    type: 'success'
  });
}
else if (flashData == "diubah!") {
  Swal.fire({
    title: 'Data',
    text: 'berhasil ' + flashData,
    type: 'success'
  });
}
else if (flashData == "dikirim!") {
  Swal.fire({
    title: 'Data',
    text: 'berhasil ' + flashData,
    type: 'success'
  });
}
else if (flashData == "dihapus!") {
  Swal.fire({
    title: 'Data',
    text: 'berhasil ' + flashData,
    type: 'success'
  });
}
else if (flashData == "dimasukan") {
  Swal.fire({
    title: 'Data berhasil diinput!',
    text: 'Lakukan penilaian kriteria baru pada seluruh pemasok',
    type: 'success'
  });
}
else if (flashData == "error2") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Isi semua penilaian!'
  })
}
else if (flashData == "error3") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Password lama salah!'
  })
}
else if (flashData == "error4") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Password baru tetap sama!'
  })
}
else if (flashData == "error5") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Penawaran tidak bisa dihapus!'
  })
}
else if (flashData == "error6") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Password salah!'
  })
}
else if (flashData == "error7") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Akun belum aktif!'
  })
}
else if (flashData == "error6") {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Email belum terdaftar!'
  })
}


// script untuk tombol hapus data pemesanan
$('.tombol-hapus').on('click', function (e) {
  const href = $(this).attr('href');
  e.preventDefault();
  Swal.fire({
    title: 'Apakah anda yakin',
    text: "Data akan dihapus?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus data!'
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  })

});

$('.button-tolak').on('click', function (e) {
  const href = $(this).attr('href');
  e.preventDefault();
  Swal.fire({
    title: 'Apakah anda yakin',
    text: "Permintaan pengadaan ditolak?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin!'
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  })

});




