(function($){
  $(document).ready(function(){

    // Fade out success message
    if($('.hide-auto').length){
      setTimeout(function(){
        $('.hide-auto').remove();
      }, 2000);
    }

    // Plugin
    $('.textarea').wysihtml5();
    $('.select2').select2();
    $('[data-toggle="tooltip"]').tooltip();
    if($('.datepicker').length) {
      $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        startDate: '+1d'
      });
    }

    if($('.datepicker-bod').length) {
      $('.datepicker-bod').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '1950-01-01'
      });
    }

    if($('#calendar').length) {
      $('#calendar').fullCalendar({
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
          events: '/api/assignments'
        });
    }

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
  });

  $('#open-left-panel').click(function(e) {
    e.preventDefault();
    $('#open-left-panel').velocity('fadeOut', { duration: 0 });
    $('#left-panel-overlay').velocity('fadeIn');

    $('.panel-left').velocity({ translateX: ['0%', '-100%'] });
    $('#close-left-panel').velocity('fadeIn', { duration: 0 });
  });

  $('#close-left-panel, #left-panel-overlay').click(function(e) {
    e.preventDefault();
    $('#close-left-panel').velocity('reverse', { duration: 0 });
    $('#left-panel-overlay').velocity('fadeOut');

    $('.panel-left').velocity('reverse');
    $('#open-left-panel').velocity('fadeIn', { duration: 0 });
  });

})(jQuery);