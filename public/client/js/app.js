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
    var date = new Date();
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    if($('#calendar').length) {
      $('#calendar').fullCalendar({
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
          events: [
              {
                title: 'All Day Event',
                start: new Date(y, m, 1),
                backgroundColor: "#f56954", //red
                borderColor: "#f56954" //red
              }
          ],
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

    // Prevent refresh multiple choice form
    if($('.questions-wrapper, .question-detail').length) {
      $(window).bind('beforeunload', function(){
          return 'Quiz akan hilang jika anda berpindah halaman. Submit quiz terlebih dahulu.';
      });
    }

    // Form clone, remove & validation
    if($('#questions-container').length > 0) {
      formTotal = parseInt(localStorage.getItem('form-count'));
      for (var i = 0; i < formTotal; i++) {
        cloneForm();
      }
      if(formTotal > 0) {
        $('.remove-question').removeAttr('disabled');
      }
    }
    addQuestionForm($('#add-question'), function(count){
      if(count > 0) {
        $('.remove-question').removeAttr('disabled');
      }
    });
    removeQuestionForm($('.remove-question'), function(parentDOM, parentSiblings){
      parentSiblings.each(function(){
        var newnum = extractNumberFromId($(this)) - 1;
        $(this).attr('id', 'question-' + newnum);
        $(this).find('.count-question').html(newnum);
      });
      parentDOM.remove();
      if($('.remove-question').length === 1) {
        $('.remove-question').attr('disabled', true);
      }
    });    
    $('#submit-mc').click(function(e){
      e.preventDefault();
      validateForm(function(isValid){
        if(isValid) {         
          swal({
            title: 'Simpan Quiz?',
            type: 'info',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#205081',
            confirmButtonText: 'Ya, simpan!',
            closeOnConfirm: true
          },
          function() {
            $(window).unbind('beforeunload');
            $('.multiple-choice-form').submit();
          });
        }
      });
    });

    $('#mc-form-detail-submit').click(function(e){
      e.preventDefault();
      console.log('Submit quiz');
      validateQuiz(function(isValid){
        if(isValid){
          $(window).unbind('beforeunload');
          $('#multiplechoice-form').submit();
        }
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

    var assignmentData = [];

    $.ajax({
      method: 'get',
      url: 'http://ilearn.app/api/assignments',
    })
    .done(function(data) {
      assignmentData.push(data);
      console.log(assignmentData); 
    });
   
  });

  function cloneForm() {
    var qContainer = $('#questions-container');
    var dom2copy = $('div[id^="question-"]:last');
    var num = extractNumberFromId(dom2copy) + 1;
    var newDom = dom2copy.clone(true).appendTo(qContainer);

    localStorage.setItem('form-count', extractNumberFromId(dom2copy));
    newDom.find('textarea').val('');
    newDom.find('input[type="text"]').val('');
    newDom.find('input[type="radio"]').removeAttr('checked');
    newDom.attr('id', 'question-' +  num).find('.count-question').html(num);
    newDom.find('textarea').attr('name', 'questions\[' + num + '\]\[question\]');
    newDom.find('input').each(function(){
      var newName = $(this).attr('name')
        .replace('questions\[' + extractNumberFromId(dom2copy) + '\]', 'questions\[' + num + '\]');
      $(this).attr('name', newName);
    });
  }

  function addQuestionForm(btn, callback){
    var count = 0;

    btn.click(function(e){
      e.preventDefault();
      cloneForm();
      count++;
      return callback(count);
    });
  }

  function removeQuestionForm(btn, callback){
    btn.click(function(e){
      e.preventDefault();

      var reduceFormTotal = parseInt(localStorage.getItem('form-count')) - 1;
      localStorage.setItem('form-count', reduceFormTotal);
      var parentDOM = $(this).parents('.questions-wrapper');
      var parentSiblings = parentDOM.nextAll('.questions-wrapper');
      return callback(parentDOM, parentSiblings);
    });
  }

  function extractNumberFromId(dom){
    return parseInt(dom.attr('id').match(/\d+/g));
  }

  function validateForm(callback) {
    var isValid = true;
    var textarea = $('.questions-wrapper textarea');
    var answers = $('.questions-wrapper input[type=text]');
    var correctAnswer = $('.questions-wrapper input[type=radio]');

    textarea.each(function() {
      validate($(this), function(valid) {
        if(!valid) {
          isValid = false;
        }
      });
    });
    answers.each(function() {
      validate($(this), function(valid) {
        if(!valid) {
          isValid = false;
        }
      });
    })
    // Get all names
    var names = [];
    correctAnswer.each(function () {
      var name = $(this).attr('name');
      if ($.inArray(name, names) == -1) {
        names.push(name);
      }
    });
    // Validate all radio by name
    $.each(names, function (i, name) {
      if ($('input[name="' + name + '"]:checked').length === 0) {
        $('input[name="' + name + '"]').parents('.anwers_wrapper')
          .css('border', '1px solid red');
          isValid = false;
      } else {
        $('input[name="' + name + '"]').parents('.anwers_wrapper')
          .css('border', '1px solid #ccc');
      }
    });
    if(isValid) {
      return callback(true);
    }
    return callback(false);
  }

  function validate(el, callback) {    
    if(el.val() === '') {
      el.css('border', '1px solid red');
      callback(false);
    } else {
      el.css('border', '1px solid #ccc');
      callback(true);
    }
  }

  function validateQuiz(callback) {
    var isValid = true;
    var questionNames = [];

    $('.question-detail input[type="radio"]').each(function(){
      var questionName = $(this).attr('name');
      if($.inArray(questionName, questionNames) == -1) {
        questionNames.push(questionName);
      }
    });

    $.each(questionNames, function(i, name) {
      if($('input[name="' + name + '"]:checked').length === 0) {
        $('input[name="' + name + '"]').parents('.question-detail')
          .css('border', '1px solid red');
        isValid = false;
      } else {
        $('input[name="' + name + '"]').parents('.question-detail')
          .css('border', '1px solid #fff');;
      }
    });

    if(isValid) {
      return callback(true);
    }

    return callback(false);
  }

})(jQuery);