

$('.button-generate').on('click', function(){

	$('.error-content').html("");
	if(!$('.button-generate').hasClass('disabled')){
		$('.url-place').attr('disabled', 1);
		$('.button-generate').addClass('disabled');
		$('.button-generate-loader').show();

		var url = $(this).data('href');

		var obj = {};
		obj[$('.url-place').attr('name')] = $('.url-place').val();

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
						.text(data.url).css('background', '#afafaf');
					$('.success-content').prepend(link_success_template);

					setTimeout(function(){
						$('.message-success').css('background', '#F8F8F9');
					}, 300);

					$('.url-place').val('');
				}


				$('.url-place').removeAttr('disabled').select();
				$('.button-generate-loader').hide();
				$('.button-generate').removeClass('disabled');

			});
	}
});
