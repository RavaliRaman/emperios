/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

	var bodyEl = document.body,
		content = document.querySelector( '.content-wrap' ),
		openbtnbottom = document.getElementById( 'open-button-bottom' ),
		closebtnbottom = document.getElementById( 'close-button-bottom' ),
		isOpen = false;

	function init() {
		initEvents();
	}

	function initEvents() {
		openbtnbottom.addEventListener( 'click', toggleMenu );
		if( closebtnbottom ) {
			closebtnbottom.addEventListener( 'click', toggleMenu );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		content.addEventListener( 'click', function(ev) {
			var target = ev.target;
			if( isOpen && target !== openbtnbottom ) {
				toggleMenu();
			}
		} );
	}

	function toggleMenu() {
		if( isOpen ) {
			classie.remove( bodyEl, 'show-menu-bottom' );
		}
		else {
			classie.add( bodyEl, 'show-menu-bottom' );
		}
		isOpen = !isOpen;
	}

	init();

})();