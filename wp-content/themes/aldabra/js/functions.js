/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '#menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.twentysixteen', function() {
			$( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );

			// jscs:disable
			$( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.twentysixteen', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.twentysixteen', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.twentysixteen' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.twentysixteen', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.twentysixteen blur.twentysixteen', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 910 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				siteNavigation.attr( 'aria-expanded', 'true' );
				socialNavigation.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigation.attr( 'aria-expanded', 'false' );
				socialNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			siteNavigation.removeAttr( 'aria-expanded' );
			socialNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		if ( body.hasClass( 'page' ) || body.hasClass( 'search' ) || body.hasClass( 'single-attachment' ) || body.hasClass( 'error404' ) ) {
			return;
		}

		$( '.entry-content' ).find( param ).each( function() {
			var element              = $( this ),
				elementPos           = element.offset(),
				elementPosTop        = elementPos.top,
				entryFooter          = element.closest( 'article' ).find( '.entry-footer' ),
				entryFooterPos       = entryFooter.offset(),
				entryFooterPosBottom = entryFooterPos.top + ( entryFooter.height() + 28 ),
				caption              = element.closest( 'figure' ),
				newImg;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > entryFooterPosBottom ) {

				// Check if full-size images and captions are larger than or equal to 840px.
				if ( 'img.size-full' === param ) {

					// Create an image to find native image width of resized images (i.e. max-width: 100%).
					newImg = new Image();
					newImg.src = element.attr( 'src' );

					$( newImg ).on( 'load.twentysixteen', function() {
						if ( newImg.width >= 840  ) {
							element.addClass( 'below-entry-meta' );

							if ( caption.hasClass( 'wp-caption' ) ) {
								caption.addClass( 'below-entry-meta' );
								caption.removeAttr( 'style' );
							}
						}
					} );
				} else {
					element.addClass( 'below-entry-meta' );
				}
			} else {
				element.removeClass( 'below-entry-meta' );
				caption.removeClass( 'below-entry-meta' );
			}
		} );
	}

	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	$( document ).ready( function() {

		var inactive = false;

		$('#home-animation').each(function() {

		});

		$('#map').each(function() {
			var $this = $(this);
			if (typeof google != 'undefined' && google) {
				var $map = $(this),
					center = new google.maps.LatLng( parseFloat($this.data('lat')), parseFloat($this.data('lng')) ),
					map = new google.maps.Map($map.get(0), {center: center, zoom: 17, disableDefaultUI: true});
				    marker = new google.maps.Marker({map: map, position: center, icon: '../wp-content/themes/aldabra/images/map.png',});
					map.setZoom( 14 );


				google.maps.event.addDomListener(window, "resize", function() {
					center = map.getCenter();
					google.maps.event.trigger(map, "resize");
					map.setCenter(center);
				});
			}
		});

		$('.news-table .description.table .cell').each(function() {
			$clamp($(this).get(0), {clamp: 5});
		});

		$('.filters .filter').each(function() {
			var $that = $(this);
			$that.find('.name').on('click', function() {
				if ( ! $('.body', $that).is(':visible')) {
					$('.filters .filter .body').slideUp('fast');
					$('.body', $that).slideDown('fast');
				} else {
					$('.body', $that).slideUp('fast');
				}
			});
		});

		$('#gallery').each(function() {
			var $this = $(this);
			$(window).load(function() {
				$( '.content', $this ).jGallery({
					zoomSize: 'fill',
                    tooltips: false,
					thumbHeight: 67,
					thumbWidth: 114,
					thumbnailsPosition: 'bottom',
					height: '546px',
                    thumbnailsHideOnMobile: true,
                    draggableZoomHideNavigationOnMobile: true,
                    maxMobileWidth: 767,
                    draggableZoom: true,
                    swipeEvents: true,
                    slideshowAutostart: true,
                    title: false
				});
				$('.slides', $this).hide();

                setTimeout(function() {
                    $('#gallery').fadeTo( "slow", 1 );
                }, 300);
			});
		});

        $('.single-news').each(function() {
            var height = $('.description .content').outerHeight();
            if (height < 300) {
                height = 300;
            }
            $('.description .other').height(height);
        });

		$('#subscribe-to-estate').on('click', function() {
			$('#estate-form').slideToggle();
		});

        $(".other").each(function() {
            $(this).niceScroll({
                cursorcolor:"#cf6240",
                cursorwidth: '7px',
                touchbehavior: true,
                autohidemode: false
            });
        });

        $(".home .box").each(function() {
            $(this).niceScroll({
                cursorcolor:"#cf6240",
                cursorwidth: '7px',
                touchbehavior: true
            });
        });

		$('.mobile-button').on('mousedown', function() {
			if ($(this).hasClass('active')) {
				$('.main-navigation').slideUp();
			} else {
				$('.main-navigation').slideDown();
			}
			$(this).toggleClass('active');
		});

		$('#subscribe-to-estate-button').on('click', function() {
			if (inactive) {
				return false;
			}

			inactive = true;
			var firstname = $('#firstname').val(),
				lastname = $('#lastname').val(),
				email = $('#email').val(),
				phone = $('#phone').val(),
				estate_id = $('#estate_id').val(),
				url = $('#url').val(),
				nonce = $('#set_estate_subscriber').val();

			var errors = false;

			if (firstname == '') {
				$('#firstname').addClass('error');
				errors = true;
			} else {
				$('#firstname').removeClass('error');
			}

			if (lastname == '') {
				$('#lastname').addClass('error');
				errors = true;
			} else {
				$('#lastname').removeClass('error');
			}

			if (!email || !validateEmail(email)) {
				$('#email').addClass('error');
				errors = true;
			} else {
				$('#email').removeClass('error');
			}

			if (!phone ) {
				$('#phone').addClass('error');
				errors = true;
			} else {
				$('#phone').removeClass('error');
			}

			var data = {
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    estate_id: estate_id,
                    nonce: nonce,
					full_form: 0
                }
			};

			if (!errors) {
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					cache: false,
					data: data,
					beforeSend: function (xhr) {
						$('#loading').show();
					},
					complete: function() {
						$('#loading').hide();
						inactive = false;
					},
					success: function (result) {
                        if (!result) {
                            return false;
                        }
						if (typeof result['success'] != 'undefined' && result['success']) {
                            $('#estate-form').slideUp();
						} else {
                            if (typeof result['errors']) {
                                $.each(result['errors'], function (inx, value) {
                                    $('#' + value).addClass('error');
                                });
                            }
                        }
					},
					error: function (jqXHR, textStatus, errorThrown) {}
				});
			} else {
				inactive = false;
			}
		});

		$('#subscribe-form .body').on('click', function(event) {
			event.stopPropagation();
			$('.options').slideUp();
		});

		$('#subscribe-form .close').on('click', function() {
				$('#subscribe-form').fadeOut('fast');
		});

		$('.options .option').on('click', function(event) {
			event.stopPropagation();
			var active = $(this).data('active');
			if (active) {
				$(this).removeClass('active');
				$(this).data('active', 0);
			} else {
				$(this).addClass('active');
				$(this).data('active', 1);
			}

			//find all active options
			var items = [];
			$(this).parent().find('.option').each(function() {
				active = $(this).data('active');

				if (active) {
					var name = $(this).data('type');
					if (name) {
						items.push(name);
					}
				}
			});

			if (items.length > 0) {
				$(this).parent().parent().find('.input').val(items.join('/'));
				$(this).parent().parent().find('.text').text(items.join('/'));
			} else {
				$(this).parent().parent().find('.input').val('');
				$(this).parent().parent().find('.text').text('');
			}
		});

		$('.input.multiselect').on('click', function(event) {
			event.stopPropagation();
			$('.options', this).slideToggle();
		});

		$('#subscribe-form').on('click', function(event) {
			$('#subscribe-form').fadeOut('fast');
		});

		$('#subscribe-show').on('click', function(event) {
			$('#subscribe-form').fadeIn('fast');
		});

		$('#submit-full-subscribe').on('click', function() {
			if (inactive) {
				return false;
			}

			inactive = true;
			var firstname = $('#firstname').val(),
				lastname = $('#lastname').val(),
				email = $('#email').val(),
				phone = $('#phone').val(),
				location = $('#location').val(),
				type = $('#type_input').val(),
				room_number = $('#room_number').val(),
				budget = $('#budget').val(),
				url = $('#url').val(),
				nonce = $('#set_estate_subscriber').val();

			var errors = false;

			if (firstname == '') {
				$('#firstname').addClass('error');
				errors = true;
			} else {
				$('#firstname').removeClass('error');
			}

			if (lastname == '') {
				$('#lastname').addClass('error');
				errors = true;
			} else {
				$('#lastname').removeClass('error');
			}

			if (!email || !validateEmail(email)) {
				$('#email').addClass('error');
				errors = true;
			} else {
				$('#email').removeClass('error');
			}

			if (location == '') {
				$('#location').addClass('error');
				errors = true;
			} else {
				$('#location').removeClass('error');
			}

			if (!type) {
				$('#type').addClass('error');
				errors = true;
			} else {
				$('#type').removeClass('error');
			}

			if (!room_number) {
				$('#room_number').addClass('error');
				errors = true;
			} else {
				$('#room_number').removeClass('error');
			}

			if (!budget) {
				$('#budget').addClass('error');
				errors = true;
			} else {
				$('#budget').removeClass('error');
			}

			var data = {
				data: {
					firstname: firstname,
					lastname: lastname,
					email: email,
					phone: phone,
					location: location,
					type: type,
					room_number: room_number,
					budget: budget,
					nonce: nonce,
					full_form: 1
				}
			};

			if (!errors) {
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					cache: false,
					data: data,
					beforeSend: function (xhr) {
						$('#loading').show();
					},
					complete: function() {
						$('#loading').hide();
						inactive = false;
					},
					success: function (result) {
						if (!result) {
							return false;
						}
						if (typeof result['success'] != 'undefined' && result['success']) {
							$('#subscribe-form .content').slideUp(function() {
								$('#subscribe-form .content-success').slideDown();
							});
						} else {
							if (typeof result['errors']) {
								$.each(result['errors'], function (inx, value) {
									$('#' + value).addClass('error');
								});
							}
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {}
				});
			} else {
				inactive = false;
			}
		});

        function setHorizontalSlider() {
            if (window.innerWidth <=768) {
                var count = $('.other').find('.item').size();
                count = count < 1 ? 1 : count;
                var other_width = $('.other').width();
                $('.other .wrapper').width((count * window.innerWidth) + '%');
                $('.other').find('.item').width(other_width + 'px');
                $('.other').addClass('height');
            } else {
                $('.other .wrapper').width('100%');
				$('.other').removeClass('height');
            }
        }

        var controller = null;

        function scrollAnimation() {
            $('#home-animation').each(function() {
                $(this).css({
                    width: window.innerWidth,
                    height: window.innerHeight,
                });

                if (controller) {
                    controller = controller.destroy(true);
                }

                var el = document.getElementById('header-image-position');
                var viewportOffset = el.getBoundingClientRect();
                // these are relative to the viewport, i.e. the window
                var top = viewportOffset.top;
                var left = viewportOffset.left;

                var height = '65px';
                if (window.innerWidth < 768) {
                    height = '40px';
                }

                // center image
                var i_height = $('#header-image').outerHeight();
                var i_width = $('#header-image').outerWidth();

                $('#header-image').css({
                    'top': '50%',
                    'left': '50%',
                    'margin-left': ((i_width / -2) + 'px'),
                    'margin-top': ((i_height / -2) + 'px'),
                });

                var scrolltonav = TweenMax.to("#header-image", 1, {
                    height: height,
                    top: top,
                    left: left,
                    'margin-left': 0,
                    'margin-top': 0
                });

                var scrollOpacity = TweenMax.to(".opacity-animate", 1, {
                    opacity: 1
                });

                controller = new ScrollMagic.Controller();
                var containerScene = new ScrollMagic.Scene({
                    //triggerElement: 'body',
                    duration: window.innerHeight,
                    triggerHook: "onLeave"
                })
                    .setTween(scrolltonav)
                    .addTo(controller);

                var containerScene2 = new ScrollMagic.Scene({
                    triggerElement: '.box',
                    duration: ($('#main-content').height() / 4),
                    //triggerHook: "onLeave"
                    //triggerHook: "onLeave"
                })
                    .setTween(scrollOpacity)
                    .addTo(controller);
            });
        }

        $(window).resize(function() {
            setHorizontalSlider();
            scrollAnimation();
        });

        setHorizontalSlider();
        scrollAnimation();


	} );
} )( jQuery );
