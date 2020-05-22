$(document).ready(function() {
	$('.btn-delete').on('click', function(e){
		e.preventDefault();

		const href = $(this).attr('href');
		const nama 	= $(this).data('nama');

		Swal.fire({
		  title: 'Are you sure?',
		  text: "Want to delete " + nama,
		  icon: 'warning',
		  showCancelButton: true,
		  cancelButtonColor: '#3085d6',
		  confirmButtonColor: '#d33',
		  confirmButtonText: 'Delete Data!'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = href;
		  }
		});
	});
});