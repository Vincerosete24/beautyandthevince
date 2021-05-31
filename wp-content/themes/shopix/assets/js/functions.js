var er = er || {};

/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
er.navigation = {

	init: function() {
		const siteNavigation = document.getElementById( 'site-navigation' );

		// Return early if the navigation don't exist.
		if ( ! siteNavigation ) {
			return;
		}
	
		const button = document.getElementsByClassName( 'menu-toggle' )[ 0 ];
	
		// Return early if the button don't exist.
		if ( 'undefined' === typeof button ) {
			return;
		}
	
		const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

		const mobileMenuClose = siteNavigation.getElementsByClassName( 'mobile-menu-close' )[ 0 ];

		const mobileOverlay = document.getElementsByClassName( 'mobile-menu-overlay' )[ 0 ];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}
	
		if ( ! menu.classList.contains( 'nav-menu' ) ) {
			menu.classList.add( 'nav-menu' );
		}	

		button.addEventListener( 'click', function() {
			siteNavigation.classList.toggle( 'toggled' );

			document.body.style.overflowY = 'hidden';
			
			mobileOverlay.classList.add( 'is-displayed' );

			//Append + for submenus
			const linksWithChildren = siteNavigation.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
		
			for ( const link of linksWithChildren ) {
				link.innerHTML += '<span class="submenu-toggle" tabindex=0><span>+</span></span>';
			}

			//Toggle submenus
			const submenuToggles 	= siteNavigation.querySelectorAll( '.submenu-toggle' );
			for ( const submenuToggle of submenuToggles ) {
				submenuToggle.addEventListener( 'touchstart', function(e) {
					e.preventDefault();
					submenuToggle.getElementsByTagName( 'span' )[0].classList.toggle( 'submenu-exp' );
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				} );
				submenuToggle.addEventListener( 'click', function(e) {
					e.preventDefault();
					submenuToggle.getElementsByTagName( 'span' )[0].classList.toggle( 'submenu-exp' );
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				} );

				submenuToggle.addEventListener('keydown', function(e) {
					var isTabPressed = (e.key === 'Enter' || e.keyCode === 13);
	
					if (!isTabPressed) { 
						return; 
					}
					e.preventDefault();
					submenuToggle.getElementsByTagName( 'span' )[0].classList.toggle( 'submenu-exp' );
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				});
			}
			
			
			//Trap focus inside modal
			var focusableEls = siteNavigation.querySelectorAll('a[href]:not([disabled]), input[type="search"]:not([disabled])'),
				firstFocusableEl = focusableEls[0];  
				lastFocusableEl = focusableEls[focusableEls.length - 1];
				KEYCODE_TAB = 9;

				siteNavigation.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

				if (!isTabPressed) { 
					return; 
				}

				if ( e.shiftKey ) /* shift + tab */ {
					if (document.activeElement === firstFocusableEl) {
						button.focus();
						e.preventDefault();
						siteNavigation.classList.remove( 'toggled' );
						mobileOverlay.classList.remove( 'is-displayed' );
						document.body.style.overflowY = 'visible';						
					}
				} else /* tab */ {
					if (document.activeElement === lastFocusableEl) {
						button.click();
						e.preventDefault();
						siteNavigation.classList.remove( 'toggled' );
						mobileOverlay.classList.remove( 'is-displayed' );
						document.body.style.overflowY = 'visible';						
					}
				}
			});

			button.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

				if (!isTabPressed) { 
					return; 
				}

				if ( e.shiftKey ) /* shift + tab */ {
					if (document.activeElement === button) {
						button.click();
					}
				}
			});	

			mobileMenuClose.addEventListener('click', function(e) {
				siteNavigation.classList.remove( 'toggled' );
				mobileOverlay.classList.remove( 'is-displayed' );
				document.body.style.overflowY = 'visible';
			});	
			mobileMenuClose.addEventListener( 'keyup', function(e) {
				if (e.keyCode === 13) {
					e.preventDefault();
					siteNavigation.classList.remove( 'toggled' );
					mobileOverlay.classList.remove( 'is-displayed' );
					document.body.style.overflowY = 'visible';
				}
			});				
			mobileOverlay.addEventListener('click', function(e) {
				siteNavigation.classList.remove( 'toggled' );
				mobileOverlay.classList.remove( 'is-displayed' );
				document.body.style.overflowY = 'visible';
			});			
			
		} );

		// Get all the link elements within the menu.
		const links = menu.getElementsByTagName( 'a' );
	
		// Get all the link elements with children within the menu.
		const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	
		// Toggle focus each time a menu link is focused or blurred.
		for ( const link of links ) {
			link.addEventListener( 'focus', toggleFocus, true );
			link.addEventListener( 'blur', toggleFocus, true );
		}
	
		// Toggle focus each time a menu link with children receive a touch event.
		for ( const link of linksWithChildren ) {
			link.addEventListener( 'touchstart', toggleFocus, false );
		}
	
		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			if ( event.type === 'focus' || event.type === 'blur' ) {
				let self = this;
				// Move up through the ancestors of the current link until we hit .nav-menu.
				while ( ! self.classList.contains( 'nav-menu' ) ) {
					// On li elements toggle the class .focus.
					if ( 'li' === self.tagName.toLowerCase() ) {
						self.classList.toggle( 'focus' );
					}
					self = self.parentNode;
				}
			}
		}
	},
};

/**
 * Back to top
 */
er.backToTop = {

	init: function() {
		this.showIcon();	
	},

	setup: function() {
		let icon 	= document.getElementById( 'backtotop' );

		var vertDist = window.scrollY;

		if ( vertDist > 200 ) {
			icon.classList.add( 'show' );
		} else {
			icon.classList.remove( 'show' );
		}
	
		icon.addEventListener( 'click', function() {
			window.scrollTo({
				top: 0,
				left: 0,
				behavior: 'smooth',
			});
		} );
	},

	showIcon: function() {
		this.setup();

		window.addEventListener( 'scroll', function() {
			this.setup();
		}.bind( this ) );		
	},
};

/**
 * Sidebar cart
 */
er.sidebarCart = {

	init: function() {

		if ( window.jQuery ) { 
			jQuery( 'body' ).on( 'adding_to_cart', function(){
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];

				sidebarCart.classList.add( 'is-open' );
				overlay.classList.add( 'show-overlay' );
			});

			jQuery( '.site-header .cart-contents' ).on( 'click', function(){
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];

				sidebarCart.classList.add( 'is-open' );
				overlay.classList.add( 'show-overlay' );
			});		

			jQuery( '.site-header .cart-contents' ).keypress(function (e) {
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];
				const close 		= document.getElementsByClassName( 'sidebar-cart-close')[0];
				if ( e.keyCode == 13 ) {
					sidebarCart.classList.add( 'is-open' );
					overlay.classList.add( 'show-overlay' );
					close.focus();
				}
				
			});

			jQuery( '.sidebar-cart-close' ).keypress(function (e) {

				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];
				if ( e.keyCode == 13 ) {
					sidebarCart.classList.remove( 'is-open' );
					overlay.classList.remove( 'show-overlay' );
				}
			});			

			jQuery( '.shop-filters-toggle' ).on( 'click', function(){
				const sidebarFilters 	= document.getElementsByClassName( 'sidebar-filters' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];

				sidebarFilters.classList.add( 'is-open' );
				overlay.classList.add( 'show-overlay' );
			});		

			jQuery( '.cart-overlay, .sidebar-cart-close .er-icon' ).on( 'click', function(e){
				e.preventDefault();
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];
				const sidebarFilters 	= document.getElementsByClassName( 'sidebar-filters' )[0];

				sidebarCart.classList.remove( 'is-open' );

				if (typeof sidebarFilters !== 'undefined') {
					sidebarFilters.classList.remove( 'is-open' );
				}	

				overlay.classList.remove( 'show-overlay' );
			});	

			jQuery( '.cart-overlay' ).on( 'click', function(){
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];

				sidebarCart.classList.remove( 'is-open' );
				overlay.classList.remove( 'show-overlay' );
			});	

			jQuery( document ).keyup(function(e) {
				const sidebarCart 	= document.getElementsByClassName( 'sidebar-cart' )[0];
				const overlay 		= document.getElementsByClassName( 'cart-overlay' )[0];
				const sidebarFilters 	= document.getElementsByClassName( 'sidebar-filters' )[0];

				if ( e.keyCode == 27 ) {
					sidebarCart.classList.remove( 'is-open' );
					overlay.classList.remove( 'show-overlay' );
					sidebarFilters.classList.remove( 'is-open' );
				}
			});

		}
	},

};

/**
 * Sticky header
 *
 */
er.stickyHeader = {

	init: function() {

		if ( !document.body.classList.contains( 'header-inline' ) ) {
			return;
		}

		const stickyElm = document.querySelector('.site-header');

		if ( document.body.classList.contains( 'admin-bar' ) ) {
			var observer = new IntersectionObserver(function (_ref) {
				var e = _ref[0];
				return e.target.classList.toggle('isSticky', e.intersectionRatio < 1);
			}, {
				rootMargin: '-33px 0px 0px 0px',
				threshold: [1]
			});
		} else {
			var observer = new IntersectionObserver(function (_ref) {
				var e = _ref[0];
				return e.target.classList.toggle('isSticky', e.intersectionRatio < 1);
			}, {
				rootMargin: '-1px 0px 0px 0px',
				threshold: [1]
			});
		}	

		observer.observe( stickyElm );
	},
};

/**
 * Move product actions into placeholder
 *
 */
er.productActions = {

	init: function() {

		const destination 	= document.querySelectorAll( '.products .product' );

		Array.prototype.forEach.call(destination, function (product) {
			
			placeholder = product.getElementsByClassName('product-placeholder')[0];
			
			yithwcqv = product.getElementsByClassName('yith-wcqv-button');
			yithwcwl = product.getElementsByClassName('yith-wcwl-add-to-wishlist');
			yithwcco = product.getElementsByClassName('compare');
			tiwl	 = product.getElementsByClassName('tinvwl-loop-button-wrapper');

			if ( yithwcqv.length ) {
				placeholder.appendChild(yithwcqv[0]);
			}

			if ( yithwcwl.length ) {
				placeholder.appendChild(yithwcwl[0]);
			}		
			
			if ( tiwl.length ) {
				placeholder.appendChild(tiwl[0]);
			}	
			
			if ( yithwcco.length ) {
				placeholder.appendChild(yithwcco[0]);

			}			

		});
	},
};

/**
 * Mobile header
 */
er.mobileHeader = {

	init: function() {

		var mq = window.matchMedia('(max-width: 1024px)');

		const mobileHeader 	= document.getElementsByClassName( 'mobile-header' )[0];
		const mhClone	= mobileHeader.cloneNode(true);
		const desktopHeader = document.getElementsByClassName( 'desktop-header' )[0];
		const dhClone	= desktopHeader.cloneNode(true);
		const anchor = document.getElementById( 'header-anchor' );
		if ( document.getElementById( 'header-bottom' ) ) {
			var headerBottom 	=  document.getElementsByClassName( 'header-bottom' )[0];
			var hbClone		= headerBottom.cloneNode(true);		
		}
		const page = document.getElementById( 'page' );


		if (mq.matches) {
			desktopHeader.remove();
			if (typeof hbClone !== 'undefined') {
				headerBottom.remove();
			}			
			er.navigation.init();
			er.mobileSearch.init();
		} else {
			mobileHeader.remove();
		}	

		mq.addEventListener( 'change', (e) => {
			if (mq.matches) {
				desktopHeader.remove();
				dhClone.remove();
				if (typeof hbClone !== 'undefined') {
					headerBottom.remove();
					hbClone.remove();
				}				
				page.insertBefore( mhClone, anchor );
				er.navigation.init();
				er.mobileSearch.init();
			} else {
				mobileHeader.remove();
				mhClone.remove();
				page.insertBefore( dhClone, anchor );
				if (typeof hbClone !== 'undefined') {
					page.insertBefore( hbClone, anchor );
				}
			}
		});
	},
};

/**
 * Mobile search
 */
 er.mobileSearch = {
	init: function() {
		const searchToggle 			= document.getElementsByClassName( 'mobile-search-toggle' )[0];
		const mobileHeader 			= document.getElementsByClassName( 'mobile-header' )[0];
		const searchOverlayWrapper 	= mobileHeader.getElementsByClassName( 'search-overlay-wrapper' )[0];
		const searchCancel 			= searchOverlayWrapper.getElementsByClassName( 'search-cancel' )[0];

		searchToggle.addEventListener( 'click', function(e) {
			e.preventDefault();
			searchOverlayWrapper.classList.add( 'display-search' );
		} );

		searchToggle.addEventListener( 'keyup', function(e) {
			if (e.keyCode === 13) {
				e.preventDefault();
				searchOverlayWrapper.classList.add( 'display-search' );
			}
		});		

		searchCancel.addEventListener( 'click', function(e) {
			e.preventDefault();
			searchOverlayWrapper.classList.remove( 'display-search' );
		} );

		searchCancel.addEventListener( 'keyup', function(e) {
			if (e.keyCode === 13) {
				e.preventDefault();
				searchOverlayWrapper.classList.remove( 'display-search' );
			}
		});		
	}	
};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
function erDomReady( fn ) {
	if ( typeof fn !== 'function' ) {
		return;
	}

	if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
		return fn();
	}

	document.addEventListener( 'DOMContentLoaded', fn, false );
}

erDomReady( function() {
	er.navigation.init();
	er.backToTop.init();
	er.sidebarCart.init();
	er.stickyHeader.init();
	er.productActions.init();
	er.mobileHeader.init();
} );

