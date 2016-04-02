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


    $(document).ready(function() {
        $(".textarea").wysihtml5();
        $('.select2').select2();
        
        if( $('.datepicker').length ) {
	        $('.datepicker').datepicker({
	            format: 'dd/mm/yyyy',
	            startDate: '01/01/1940'
	        });
	    }
    });

})(jQuery);