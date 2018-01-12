try {
    window.$ = window.jQuery = require('jquery/dist/jquery');
    window.Popper = require('popper.js/dist/umd/popper');

    require('bootstrap');
} catch (e) {}

jQuery(function($) {
	$('#successModal').modal();

	$('#successModal').on('shown.bs.modal', function (e) {
		setTimeout(function() {
			$(this).modal('hide');
		}.bind($(this)), 2000);
	})
});
