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

		if($('.questions-wrapper').length) {
			$(window).bind('beforeunload', function(){
			    return 'Quiz akan hilang jika anda berpindah halaman. Simpan quiz terlebih dahulu.';
			});
		}		

		$('.multiple-choice-form').submit(function(){
		    $(window).unbind('beforeunload');
		});

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

			if($('.questions-wrapper').length === 1) {
				$('.remove-question').attr('disabled', true);
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
		
	});

	function addQuestionForm(btn, callback){
		var count = 0;
		var qContainer = $('#questions-container');

		btn.click(function(e){
			e.preventDefault();

			var dom2copy = $('div[id^="question-"]:last');
			var num = extractNumberFromId(dom2copy) + 1;
			var newDom = dom2copy.clone(true).appendTo(qContainer);

			newDom.find('textarea').val('');
			newDom.find('input[type="text"]').val('');
			newDom.attr('id', 'question-' +  num).find('.count-question').html(num);

			count++;
			return callback(count);
		});
	}

	function removeQuestionForm(btn, callback){
		btn.click(function(e){
			e.preventDefault();

			var parentDOM = $(this).parents('.questions-wrapper');
			var parentSiblings = parentDOM.nextAll('.questions-wrapper');
			return callback(parentDOM, parentSiblings);
		});
	}

	function extractNumberFromId(dom){
		return parseInt(dom.attr('id').match(/\d+/g));
	}

})(jQuery);