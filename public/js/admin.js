(function($){

	$(document.body).on('click', '.warning-delete', function(e) {
		e.preventDefault();
		var $form = $(this).closest('form'),
			title = $(this).data('title');

		swal({
			title: 'Anda yakin?',
			text: 'Anda akan menghapus ' + title + ' !',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Batal',
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Ya, lanjutkan!',
			closeOnConfirm: true
		},
		function() {
			$form.submit();
		});
	});

})(jQuery);