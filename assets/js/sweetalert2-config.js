$('.btn-hapus').on('click', function(e){
	e.preventDefault();

	const href = $(this).attr('href');
	const nama 	= $(this).data('nama');

	Swal.fire({
	  title: 'Apakah Anda yakin?',
	  text: "Menghapus data " + nama,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Hapus Data!'
	}).then((result) => {
	  if (result.value) {
	    document.location.href = href;
	  }
	});
});