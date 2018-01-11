try {
	window.Popper = require('popper.js/dist/umd/popper');
    window.$ = window.jQuery = require('jquery/dist/jquery.slim');

    require('bootstrap');
} catch (e) {}

jQuery(function($) {
	$('.modal').modal();

	$('.modal').on('shown.bs.modal', function (e) {
		setTimeout(function() {
			$(this).modal('hide');
		}.bind($(this)), 1000);
	})
});
