jQuery(document).ready(function($){

	jQuery(".menu__toggle").click(function () {
		jQuery(".menu__toggle").toggleClass("menu-open");
		jQuery(".nav").slideToggle('fast');

		jQuery(".modal__background").toggleClass("modal-open");
	});

	// var nav = priorityNav.init({
	// 	breakPoint: 1024
	// });

	// if (window.matchMedia('(max-width: 1023px)').matches) {
	// 	jQuery(".menu-item-has-children").click(function () {
	// 		jQuery(".first-level", this).slideToggle('fast');
	// 		jQuery(".first-level", this).toggleClass('menu-open');
	// 	});
	// }

	jQuery(".menu-item-has-children").click(function () {
			jQuery(".first-level", this).slideToggle('fast');
			jQuery(this).toggleClass('menu-open');
		});

	jQuery('.newest__products').slick({
		infinite: true,
		dots: false,
		speed: 500,
		rows: 0,
		mobileFirst:true,
		responsive: [
		{
			breakpoint: 1200,
			settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			}
		},

		{
			breakpoint: 768,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 320,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
		]
	});


	function addTax() {
		jQuery( ".tax__toggle__data" ).each(function() {
			var taxVal = jQuery(this).data("with-tax");
			jQuery(this).html('£'+taxVal);
		});
	}

	function removeTax() {
		jQuery( ".tax__toggle__data" ).each(function() {
			var taxVal = jQuery(this).data("without-tax");
			jQuery(this).html('£'+taxVal);
		});
	}

	jQuery('.switch').click(function () {
		jQuery(this).find('.slider').toggleClass('taxSet');
		var val = jQuery(this).find('.slider').hasClass('taxSet') ? 'set' : 'unset';
		localStorage.setItem('taxToggle', val);
		location.reload();
	});

	if(localStorage.getItem('taxToggle') == 'set') {
		jQuery(".switch .slider").addClass("taxSet");
		addTax();
	} else {
		removeTax();
	}

	jQuery(".quantity__input__button").on("click", function() {

		var $button = $(this);
		var oldValue = $button.parent().find("input").val();

		if ($button.hasClass('btn-plus')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
       // Don't allow decrementing below zero
       if (oldValue > 1) {
       	var newVal = parseFloat(oldValue) - 1;
       } else {
       	newVal = 1;
       }
   }

   $button.parent().find("input").val(newVal);

});

// auto update cart ammount
var timeout;
jQuery('.woocommerce').on('change', 'input.qty', function(){

	if ( timeout !== undefined ) {
		clearTimeout( timeout );
	}

	timeout = setTimeout(function() {
		$("[name='update_cart']").trigger("click");
	}, 500 ); // 1 second delay, half a second (500) seems comfortable too

});

});