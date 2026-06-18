jQuery(document).ready(function ($) {
	
	$('#button_car').on('click', function (e) {
		e.prevendDefault;

		$.ajax({
			url: geniuscourse_ajax_script.ajaxurl,
			data: {
				'action': 'geniuscourse_ajax_example',
				'nonce': geniuscourse_ajax_script.nonce,
				'string_one': geniuscourse_ajax_script.string,
				'string_two': geniuscourse_ajax_script.string_new
			},
			success: function (data) {
				$('#car_content').append(data);
			},
			error: function (errorThrown) {
				console.log(errorThrown);
			}
		});
	});
	
});