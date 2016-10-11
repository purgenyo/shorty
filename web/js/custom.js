
var button = $('.button-generate');
var urlPlace = $('.url-place');

button.on('click', function(){

	$('.error-content').html('');

	if(!button.hasClass('disabled')){
		urlPlace.attr('disabled', 1);
		button.addClass('disabled');

		$('.button-generate-loader').show();

		var url = $(this).data('href');

		var obj = {};
		obj[urlPlace.attr('name')] = urlPlace.val();

		$.ajax({
			method: 'POST',
			url: url,
			data: obj,
			cache: false
		})
		.done(function( data ) {
			var errorTemplate   = $('.message-error');
			var successTemplate = $('.message-success-template');
			if(data.success==0){
				for (var error in data.errors) {
					if ({}.hasOwnProperty.call(data.errors, error)) {
						var alert = errorTemplate.clone();
						$(alert)
							.removeClass('hidden')
							.text(data.errors[error]);
						$('.error-content').prepend(alert);
					}
				}
			} else {
				var link_success_template = successTemplate.clone();
				$(link_success_template)
					.removeClass('hidden')
					.removeClass('message-success-template')
					.text(data.url).css('background', '#a1ff94');
				$('.success-content').prepend(link_success_template);

				setTimeout(function(){
					$('.message-success').css('background', '#F8F8F9');
				}, 300);

				urlPlace.val('');
			}

			urlPlace.removeAttr('disabled').select();
			$('.button-generate-loader').hide();
			button.removeClass('disabled');
		});
	}
});
