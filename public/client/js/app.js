(function($){
    $(document).ready(function(){
        if($('.hide-auto').length){
            setTimeout(function(){
                $('.hide-auto').remove();
            }, 2000);
        }

        $('.textarea').wysihtml5();
        $('.select2').select2();
        $('[data-toggle="tooltip"]').tooltip();
        
        if( $('.datepicker').length ) {
            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                startDate: '+1d'
            });
        }
    });

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

    $('.changeImage').click(function(e){
        e.preventDefault();
        var form = $('input.field_type'),
            el = $(this).attr('id');
            
        switch(el){
            case 'chg-picture':
                form.val('picture');
                break;
            case 'chg-cover':
                form.val('cover');
                break;
            default:
                form.val('picture');
                break;
        }
    });

})(jQuery);