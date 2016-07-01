(function($) {
  $(document).ready(function() {

    // Prevent refresh multiple choice form
    if($('.questions-wrapper, .question-detail').length) {
      $(window).on('beforeunload', function(){
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

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json'
    });

    var meta = {
      classroom_id: $('#mc-form-detail-submit').data('classroom_id'),
      quiz_id: $('#mc-form-detail-submit').data('quiz_id')
    }

    $('#mc-form-detail-submit').click(function(e){
      e.preventDefault();

      validateQuiz(function(isValid){
        if(isValid){
          $(window).unbind('beforeunload');
          submitQuiz(meta);
        } else {
          swal({
            title: 'Kumpul Quiz Sekarang?',
            text: 'Quiz yang tidak terjawab tidak akan mendapatkan nilai.',
            type: 'error',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d9534f',
            confirmButtonText: 'Ya, kumpul sekarang!',
            closeOnConfirm: true
          },
          function() {
            $(window).unbind('beforeunload');
            submitQuiz(meta);
          });
        }
      });
    });

    $('#start-quiz').click(function(e){
      var _startBtn = $(this);
      e.preventDefault();   
      swal({
        title: 'Kerjakan Quiz?',
        text: 'Waktu pengerjaan akan berjalan jika anda memulai quiz sekarang',
        type: 'info',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#205081',
        confirmButtonText: 'Oke, Saya Mengerti!',
        closeOnConfirm: true
      },
      function() {
        $.ajax({
          method: 'POST',
          url: '/api/quizzes/start',
          data: {
            classroom_id: _startBtn.data('classroom_id'),
            quiz_id: _startBtn.data('quiz_id')
          }
        })
        .done(function(data) {
          if(data.redirect) {
            window.location.replace(data.redirect);
          }
          return;
        })
        .fail(function(){
          console.log('Unknown error occured.');
        });
      });
    });

    /* Do QUIZ */
    $('#lms-paginator').lmsPaginate({
      perPage: 1,
      prevNext: false,
      firstLast: false,
      containerClass: 'mc-pagination',
      insertAfter: '#luar'
    });

    $('input[name^="answer"]').each(function(){
      var _radio = $(this);
      
      _radio.on('click', function(e){
        e.stopPropagation();
        data = $('.answers').serialize() + '&' + $.param(meta);

        $.ajax({
          method: 'POST',
          url: '/api/quizzes/submit',
          data: data,
          beforeSend: function() {
            $('.quiz-loading').show();
          }
        })
        .always(function(data) {
          $('.quiz-loading').hide();
          $('#unansweredQuestion').html(data.unanswered);
        })
        .fail(function(err ){
          $('body').append(err.responseText);
          $('#refresh').modal('show');
          $('#refresh-quiz').click(function(e){
            e.preventDefault();
            window.location.reload();
          });
        });
      });
    });

    var timerDOM = $('.timer');
    var endTime = new Date(timerDOM.data('endtime'));

    countdown.resetLabels();
    countdown.setLabels(
      'milidetik | detik | menit | jam | hari | minggu | bulan | tahun | abad | milenium',
      'milidetik | detik | menit | jam | hari | minggu | bulan | tahun | abad | milenium',
      ' ',
      ', ',
      '',
      function(n) { return n.toString(); }
    );

    timerDOM.html(countdown(endTime).toString());

    setInterval(function() {
      timerDOM.text(countdown(moment().valueOf(), endTime).toString());
    }, 1000);

    if($('#mc-form-detail-submit').length) {
      setTimeout(function() {
        submitQuiz(meta);
      }, endTime - new Date());
    }
  });

  function submitQuiz(meta) {
    data = $('.answers').serialize() + '&' + $.param(meta) + '&status=done';

    $.ajax({
      method: 'POST',
      url: '/api/quizzes/submit',
      data: data,
      beforeSend: function() {
        $('.quiz-loading').show();
      }
    })
    .always(function(data) {
      $('.quiz-loading').hide();
    })
    .done(function(data) {
      if(data.redirect) {
        window.location.replace(data.redirect);
      }
      return;
    })
    .fail(function(err) {
      if(err.status === 422 ) {
        $('#err-422').show();
        setTimeout(function() {
          $('#err-422').fadeOut();
        }, 3000);        
      } else {
        $('#refresh').modal('show');
        $('#refresh-quiz').click(function(e){
          e.preventDefault();
          window.location.reload();
        });
      }
    });
  }

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