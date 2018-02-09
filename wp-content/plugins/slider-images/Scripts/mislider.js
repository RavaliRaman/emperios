;(function( $, window, document, Math, undefined ) {
"use strict";
var MiSlider = function( stageEl, options ) {
	var o = this;
	o.optionsInit = {
		speed: 700,
		pause: 4000,
		increment: 1,
		stageHeight: false,
		slidesOnStage: 1,
		slidesContinuous: true,
		slidePosition: "left",
		slideStart: "beg",
		slideWidth: false,
		slideScaling: 100,
		offsetV: 0,
		centerV: false,
		navList: true,
		navButtons: true,
		navButtonsShow: false,
		navButtonsOpacity: 1,
		randomize: false,
		slidesLoaded: false,
		beforeTrans: false,
		afterTrans: false,
		classStage: "mis-stage",
		classSlider: "mis-slider",
		classSlide: "mis-slide",
		classNavButtons: "mis-nav-buttons",
		classNavList: "mis-nav-list",
		selectorSlider: "ol",
		selectorSlide: "li"
	};
	o.options = {};
	o.stage = false;
	o.slider = false;
	o.slides = false;
	o.navButtons = false;
	o.prev = false;
	o.next = false;
	o.navList = false;
	o.navListItems = false;
	o.slideCurrent = false;
	o.animatedElements = $();
	o.stageWidth = 0;
	o.stageHeight = 0;
	o.sliderWidth = 0;
	o.slideWidth = 0;
	o.slideWidthCurrent = 0;
	o.slideScaling = o.optionsInit.slideScaling;
	o.scalingWidth = 0;
	o.scalingMargin = 0;
	o.offsetV = o.optionsInit.offsetV;
	o.slidesLengthOrig = 0;
	o.slidesLength = 0;
	o.indexCurrent = 0;
	o.indexFirst = 0;
	o.indexLast = 0;
	o.increment = o.optionsInit.increment;
	o.slidesOnStage = o.optionsInit.slidesOnStage;
    o.imagesLoaded = true;
	o.speed = o.optionsInit.speed;
	o.navButtonsOpacity = o.optionsInit.navButtonsOpacity;
	o.navButtonsFade = false;
	o.slidesContinuous = o.optionsInit.slidesContinuous;
	o.pause = o.optionsInit.pause;
	o.timer = false;
	o.resizeTimer = false;
	o.after = false;
	o.classSlideClone = "mis-clone";
	o.classSlideContainer = "mis-container";
	o.classCurrent = "mis-current";
	o.classPrev = "mis-prev";
	o.classNext = "mis-next";
	o.init = function( stageEl, options ) { 
		o.options = $.extend( {}, o.optionsInit, options );
		o.stage = $( stageEl );
		o.stage.fadeTo( 0, 0 );
		o.slider = o.stage.children( o.options.selectorSlider ).first();
		o.slides = o.slider.children( o.options.selectorSlide );
		o.slidesLengthOrig = o.slides.length;
		o.animatedElements = o.animatedElements.add( o.slider ).add( o.slides );
		if ( String( o.options.slideStart ) === "beg" ) {
			o.indexCurrent = 0;
		} else if ( String( o.options.slideStart ) === "mid" ) {
			o.indexCurrent = Math.ceil( o.slidesLengthOrig / 2 ) - 1;
		} else if ( String( o.options.slideStart ) === "end" ) {
			o.indexCurrent = o.slidesLengthOrig - 1;
		} else if ($.isNumeric( o.options.slideStart ) &&
			parseInt( o.options.slideStart, 10 ) <= o.slidesLengthOrig &&
			parseInt( o.options.slideStart, 10 ) > 0) {
				o.indexCurrent = parseInt( o.options.slideStart, 10 ) - 1;
		} else {
			o.indexCurrent = 0;
		}
		if ( o.options.randomize ) {
			o.randomize();
		}
        o.stage.addClass( o.options.classStage );
        o.slider.addClass( o.options.classSlider );
		if ( o.options.speed && $.isNumeric( o.options.speed ) ) {
			o.speed = Math.abs( parseInt( o.options.speed, 10 ) );
		}
		if ( o.options.pause === false ) { 
			o.pause = false;
		} else if ( $.isNumeric( o.options.pause ) ) {
			o.pause = Math.abs( parseInt( o.options.pause, 10 ) );
		}
		if ( $.isNumeric( o.options.offsetV ) ) {
			o.offsetV = Number( o.options.offsetV );
		}
		if ($.isNumeric(o.options.navButtonsOpacity) &&
			Number(o.options.navButtonsOpacity) >= 0 &&
			Number(o.options.navButtonsOpacity) <= 1) {
				o.navButtonsOpacity = Number( o.options.navButtonsOpacity );
		}
		if ( $.isNumeric( o.options.slideScaling ) && Number( o.options.slideScaling ) >= 100 ) {
			o.slideScaling = Number( o.options.slideScaling );
		}
		// if ( !supportTransform( stageEl ) ) {
			// o.slideScaling = 100;
		// }
		o.optionsInit.slideScaling = o.slideScaling;
		if ( $.isNumeric( o.options.increment ) && parseInt( o.options.increment, 10 ) !== 0 ) {
			o.increment = parseInt( o.options.increment, 10 );
			o.optionsInit.increment = o.increment;
		}
		if ( o.options.navButtons ) {
			o.addNavButtons( o.stage );
			o.animatedElements = o.animatedElements.add( o.navButtons );
			if ( !o.options.navButtonsShow ) {
				o.navButtonsFade = true;
			}
		}
		if ( o.options.navList ) {
			o.addNavList();
		}
		o.setup();
		if ( o.slidesOnStage > 1 ) {
			o.slider.on( "click", o.options.selectorSlide, function( e ) {
				if ( $( this ).index() !== o.indexCurrent ) {
					e.preventDefault();
					o.autoplayOff();
					o.transition( $( this ).index(), false, o.autoplayOn( o.increment ) );
				}
			});
		}
		if ( o.pause !== false || o.navButtonsFade ) { // Note: 0 must return true for o.pause
			o.stage.on({
				"mouseenter": function() {
					if ( o.pause !== false ) {
						o.autoplayOff();
					}
					if ( o.navButtonsFade ) {
						if ( !o.animatedElements.is( ":animated" ) ) {
							o.navButtons.fadeTo( 400, o.navButtonsOpacity );
						} else {
							if ( $.isFunction( o.after ) ) {
								var after = o.after;
								o.after = function() {
									after();
									o.navButtons.fadeTo( 400, o.navButtonsOpacity );
								};
							} else {
								o.after = function() {
									o.navButtons.fadeTo( 400, o.navButtonsOpacity );
								};
							}
						}
					}
				},
				"mouseleave": function() {
					if ( o.pause !== false ) {
						o.autoplayOn( o.increment );
					}
					if ( o.navButtonsFade ) {
						o.navButtons.fadeTo( 100, 0 );
					}
				}
			});
		}
		$( window ).on({
			"resize": function() {
				o.autoplayOff();
				clearTimeout( o.resizeTimer );
				o.resizeTimer = setTimeout(o.resetSlider, 500 );
			}
		});
		return this;
	};
	o.setup = function() {
		var slidesMaxNum,
			incrementTest,
			slidesOffStage,
            calcSlideWidth = !( $.isNumeric( o.options.slideWidth ) && parseInt( o.options.slideWidth, 10 ) > 0 ),
            calcStageHeight = !( $.isNumeric( o.options.stageHeight ) && parseInt( o.options.stageHeight, 10 ) > 0 );
		o.slides.each( function() {
            var slide = $( this ),
                image = slide.find('img');
            o.imagesLoaded = image.prop('complete');
            if ( !o.imagesLoaded ) {
                image.on( 'load', o.setup );
                return false;
            } else {
                slide.addClass( o.options.classSlide );
                // if ( !slide.children().hasClass( o.classSlideContainer ) ) {
                    // slide.wrapInner( "<div class='" + o.classSlideContainer + "'></div>" );
                // }
                if ( calcSlideWidth ) {
                    var width = slide.outerWidth();
                    if ( width > o.slideWidthCurrent ) {
                        o.slideWidthCurrent = width;
                    }
                }
                if ( calcStageHeight ) {
                    var height = slide.outerHeight();
                    if ( height > o.stageHeight ) {
                        o.stageHeight = height;
                    }
                }
            }
		});
        if (!o.imagesLoaded) {
            return false;
        }
        o.slidesLength = o.slidesLengthOrig;
        o.indexLast = o.slidesLength - 1;
		if ( $.isNumeric( o.options.slideWidth ) && parseInt( o.options.slideWidth, 10 ) > 0 ) {
			o.slideWidthCurrent = parseInt( o.options.slideWidth, 10 );
		}
		if ( $.isNumeric( o.options.stageHeight ) && parseInt( o.options.stageHeight, 10 ) > 0 ) {
			o.stageHeight = parseInt( o.options.stageHeight, 10 );
		}
		o.stage.css({
			"height": o.stageHeight
		});
        o.indexCurrent = normalizeIndex( o.indexCurrent );
		o.stageWidth = o.stage.outerWidth();
		slidesMaxNum = Math.floor( ( o.stageWidth - o.slideWidthCurrent ) /
			( o.slideWidthCurrent * 100 / o.slideScaling ) ) + 1;
		slidesMaxNum = ( slidesMaxNum < 1 ) ? 1 : slidesMaxNum;
		o.slidesOnStage = slidesMaxNum;  // Fit as many as possible
		if ($.isNumeric( o.options.slidesOnStage ) &&
			parseInt( o.options.slidesOnStage, 10 ) >= 1 &&
			parseInt( o.options.slidesOnStage, 10 ) <= slidesMaxNum) {
				o.slidesOnStage = parseInt( o.options.slidesOnStage, 10 );
		}
		if ( o.options.slidePosition === "center" ) {
			o.slidesOnStage = ( Math.ceil( o.slidesOnStage / 2 ) * 2 ) - 1;
		}
		incrementTest = ( o.increment + o.slidesOnStage ) / 2;
		if ( incrementTest > o.slidesOnStage ) { 
			o.increment = o.slidesOnStage;
		} else if ( incrementTest < 0 ) { 
			o.increment = -( o.slidesOnStage );
		}
		if ( o.slidesOnStage > 1 ) {
			o.slideWidth = ( o.stageWidth - o.slideWidthCurrent ) / ( o.slidesOnStage - 1 );
			if ( o.slideWidthCurrent < o.slideWidth && !o.options.slideWidth ) {
				o.slideWidth = o.stageWidth / o.slidesOnStage;
				o.slideWidthCurrent = o.slideWidth;
			}
		} else {
			o.slideWidth = o.stageWidth;
			o.slideWidthCurrent = o.slideWidth;
			o.slideScaling = 100;
		}
		o.scalingWidth = o.slideWidth * o.slideScaling / 100;
		o.scalingMargin = ( o.slideWidth - o.scalingWidth ) / 2;
		slidesOffStage = o.slidesLengthOrig - o.slidesOnStage;
		if ( slidesOffStage >= 0 && o.options.slidesContinuous ) {
			o.slidesContinuous = true;
			o.slidesToClone = o.slidesOnStage + Math.abs( o.increment ) - 1;
			o.slides
				.slice( o.slidesLength - o.slidesToClone )
					.clone()
					.addClass( o.classSlideClone )
					.removeAttr( "id" )
					.prependTo( o.slider )
					.find( "*" )
						.removeAttr( "id" );
			o.slides
				.slice( 0, o.slidesToClone )
					.clone()
					.addClass( o.classSlideClone )
					.removeAttr( "id" )
					.appendTo( o.slider )
					.find( "*" )
						.removeAttr( "id" );
			o.indexFirst = o.slidesToClone;
			o.indexLast = o.slidesLength + o.slidesToClone - 1;
			o.indexCurrent = o.indexCurrent + o.slidesToClone;
			o.slides = o.slider.children( o.options.selectorSlide );
			o.slidesLength = o.slides.length;
		} else {
			o.slidesContinuous = false;
		}
		o.slideCurrent = o.slides.eq( o.indexCurrent );
		o.sliderWidth = o.slideWidthCurrent + ( o.slideWidth * ( o.slidesLength - 1 ) ) + 1;
		o.slider
			.css({
				"left": leftOffsetter( o.indexCurrent ),
				"width": o.sliderWidth
			})
		;
		o.updateNavList( o.indexCurrent );
        o.slideSetup();
        o.updateNavButtons();
        o.stage.fadeTo( 600, 1 );
        o.autoplayOn( o.increment );
        if ( $.isFunction( o.options.slidesLoaded ) ) {
            o.options.slidesLoaded();
        }
		return this;
	};
	o.transition = function( indexTo, beforeTrans, afterTrans, navButtonsFadeIn ) {
		if ( !o.animatedElements.is( ":animated" ) && indexTo !== o.indexCurrent ) {
			var indexDiff,
				indexToAdjusted = indexTo,
				indexCurrentAdjusted = o.indexCurrent;
			if ( o.slidesContinuous ) {
				if ( indexTo < o.indexFirst ) {
					indexToAdjusted = indexTo + o.slidesLengthOrig;
				} else if ( indexTo > o.indexLast ) {
					indexToAdjusted = indexTo - o.slidesLengthOrig;
				}
				if ( indexToAdjusted !== indexTo ) { 
					indexCurrentAdjusted = o.indexCurrent + o.slidesLengthOrig;
					if ( indexToAdjusted < indexTo ) {
						indexCurrentAdjusted = o.indexCurrent - o.slidesLengthOrig;
					}
				}
			} else {
				indexToAdjusted = normalizeIndex( indexTo );
			}
			indexDiff = normalizeIndex( indexToAdjusted ) -
                normalizeIndex( indexCurrentAdjusted );
			if ( indexDiff ) {
				var after;
				if ( $.isFunction( beforeTrans ) ) {
					beforeTrans();
				}
				if ( $.isFunction( o.options.beforeTrans ) ) {
					o.options.beforeTrans();
				}
				after = function() {
					if ( $.isFunction( afterTrans ) ) {
						afterTrans();
					}
					if ( $.isFunction( o.options.afterTrans ) ) {
						o.options.afterTrans();
					}
					if ( $.isFunction( o.after ) ) {
						o.after();
						o.after = false;
					}
				};
				if ( o.slidesContinuous && indexCurrentAdjusted !== o.indexCurrent ) {
					var slideCurrentAdjusted = o.slides.eq( indexCurrentAdjusted );
					if ( o.slideScaling !== 100 ) {
						slideCurrentAdjusted.css({
							"transform": "scale(1)",
							"width": o.slideWidthCurrent,
							"marginLeft": "0",
							"marginRight": "0",
							"borderSpacing": "100px"
						});
						if ( o.options.centerV ) {
							slideCurrentAdjusted.children().first().css({
								"marginTop": slideCurrentAdjusted.data( "slideMarginTopCurrent" )
							});
						}
					}
					slideCurrentAdjusted
						.addClass( o.classCurrent )
						.siblings()
							.removeClass( o.classCurrent );
					o.slider.css( "left", leftOffsetter( indexCurrentAdjusted ) );
					if ( o.slideScaling !== 100 ) {
						o.slideCurrent.css({
							"transform": "scale(" + ( 100 / o.slideScaling ) + ")",
							"width": o.scalingWidth,
							"marginLeft": o.scalingMargin,
							"marginRight": o.scalingMargin,
							"borderSpacing": o.slideScaling
						});
						if ( o.options.centerV ) {
							o.slideCurrent.children().first().css({
								"marginTop": o.slideCurrent.data( "slideMarginTop" )
							});
						}
					}
					o.indexCurrent = indexCurrentAdjusted;
					o.slideCurrent = o.slides.eq( o.indexCurrent );
				}
				if ( o.navButtons ) {
					o.navButtons.fadeTo( 100, ( navButtonsFadeIn ) ? o.navButtonsOpacity : 0,
						function() {
							o.navButtons.fadeTo( 100, 0, function() {
								o.animateSlides( indexToAdjusted, function() {
									if ( o.stage.find( ":hover" ).length ||
										o.options.navButtonsShow ) {
										o.navButtons.fadeTo( 400, o.navButtonsOpacity, after );
									} else {
										after();
									}
								});
							});
						}
					);
				} else {
					o.animateSlides( indexToAdjusted, after );
				}
			}
		}
		return this;
	};
	o.animateSlides = function( indexTo, afterTrans ) {
		o.slideCurrent.removeClass( o.classCurrent );
		var slideTo = o.slides.eq( indexTo );
		if ( o.slideScaling !== 100 ) { 
			slideTo
				.animate({
					"marginLeft": "0",
					"marginRight": "0",
					"width": o.slideWidthCurrent
				}, {
					duration: o.speed,
					queue: false
				})
				.animate({
					"borderSpacing": "100px"
				}, {    
					step: function ( now ) {
						$( this ).css({
							"transform": "scale(" + 100 / now + ")"
						});
					},
					duration: o.speed,
					queue: false
				})
			;
			o.slideCurrent
				.animate({
					"marginLeft": o.scalingMargin,
					"marginRight": o.scalingMargin,
					"width": o.scalingWidth
				}, {
					duration: o.speed,
					queue: false
				})
				.animate({
					"borderSpacing": o.slideScaling
				}, {
					step: function ( now ) {
						$( this ).css({
							"transform": "scale(" + 100 / now + ")"
						});
					},
					duration: o.speed,
					queue: false
				})
			;
			if ( o.options.centerV ) {
				slideTo
					.children()
						.first()
							.animate({
								"marginTop": slideTo.data( "slideMarginTopCurrent" )
							}, {
								duration: o.speed,
								queue: false
							});
				o.slideCurrent
					.children()
						.first()
							.animate({
								"marginTop": o.slideCurrent.data( "slideMarginTop" )
							}, {
								duration: o.speed,
								queue: false
							});
			}
		}
		o.slider.animate({
			"left": leftOffsetter( indexTo )
		}, {
			duration: o.speed,
			queue: false,
			complete: function() {
				o.indexCurrent = indexTo;
				o.slideCurrent = slideTo;
				o.updateNavList( indexTo );
				o.slideCurrent
					.addClass( o.classCurrent )
					.siblings()
						.removeClass( o.classCurrent )
				;
				if ( $.isFunction( afterTrans ) ) {
					afterTrans();
				}
			}
		});
		return this;
	};
	o.autoplayOn = function( incr ) {
		if ( o.pause !== false ) { 
			clearInterval( o.timer );
			if ( !o.stage.find( ":hover" ).length ) {
				o.timer = setInterval(function() {
					if ( !o.animatedElements.is( ":animated" ) ) {
						o.transition( o.indexCurrent + incr );
					}
				}, o.pause );
			}
		}
		return this;
	};
	o.autoplayOff = function() {
		clearInterval( o.timer );
		return this;
	};
	o.addNavButtons = function( element ) {
		var navButtons,
			$el = $( element );
		navButtons = $( "<div class='" +
			o.options.classNavButtons +
			"'><a href='#' class='" +
			o.classPrev +
			"'>Prev</a><a href='#' class='" +
			o.classNext +
			"'>Next</a></div>" );
		navButtons
			.css({
				"opacity": ( ( o.options.navButtonsShow ) ? o.navButtonsOpacity : 0 )
			})
			.children( "a" )
				.on( "click", function( e ) {
					e.preventDefault();
					if ( this.className === o.classPrev ) {
						o.autoplayOff();
						o.transition( o.indexCurrent - Math.abs( o.increment ),
							false, o.autoplayOn( o.increment ), true );
					} else if ( this.className === o.classNext ) {
						o.autoplayOff();
						o.transition( o.indexCurrent + Math.abs( o.increment ),
							false, o.autoplayOn( o.increment ), true );
					}
				});
		$el.append( navButtons );
		o.navButtons = $el.find( "." + o.options.classNavButtons );
		o.prev = o.navButtons.find( "." + o.classPrev );
		o.next = o.navButtons.find( "." + o.classNext );
		return this;
	};
	o.updateNavButtons = function() {
		if ( o.navButtons ) {
			o.navButtons
				.css({
					"width": o.slideWidthCurrent,
					"left": ( o.slideCurrent.offset().left - o.stage.offset().left )
				})
				.children( "a" )
					.css({
						"height": o.stageHeight,
						"paddingTop": ( 50 + o.offsetV ) * o.stageHeight / 100
					})
			;
		}
		console.log( o.stage.offset().left);
	};
	o.addNavList = function() {
		var navList,
			listHtml = "<ol class='" + o.options.classNavList + "'>";
		o.slides.each(function( index ) {
			var caption,
				itemText = index + 1;
			caption = $( this ).find( ":header" ).sort(function( a, b ) {
				var aTag = $( a ).prop( "tagName" ),
					bTag = $( b ).prop( "tagName" );
				return parseInt( aTag.match( /\d+/ ), 10 ) - parseInt( bTag.match( /\d+/ ), 10 );
			}).eq( 0 ).html();
			if ( caption ) {
				itemText = caption;
			} else {
				caption = $( this ).find( "figcaption" ).eq( 0 ).html();
				if ( caption ) {
					itemText = caption;
				} else {
					caption = $( this ).find( "img" ).eq( 0 ).attr( "title" );
					if ( caption ) {
						itemText = caption;
					}
				}
			}
			listHtml += "<li><a href='#' title='" + itemText + "'>" + itemText + "</a></li>";
		});
		listHtml += "</ol>";
		navList = $( listHtml )
			.on( "click", "li", function( e ) {
				e.preventDefault();
				if ( $( this ).index() !== ( o.indexCurrent - o.indexFirst ) ) {
					o.autoplayOff();
					o.transition( $( this ).index() + o.indexFirst, false, o.autoplayOn( o.increment ) );
				}
			})
		;
		o.stage.prepend( navList );
		o.navList = o.stage.children().first();
		o.navListItems = o.navList.children( "li" );
		return this;
	};
	o.updateNavList = function( index ) {
		if ( o.navListItems.length ) {
			o.navListItems
				.eq( index - o.indexFirst )
					.addClass( o.classCurrent )
					.siblings()
						.removeClass( o.classCurrent )
			;
		}
	};
	o.randomize = function() {
		o.slides.sort(function() {
			return ( 0.5 - Math.random() );
		});
		o.slides.detach().appendTo( o.slider );
		return this;
	};
	o.resetSlider = function() {
		if ( o.animatedElements.is( ":animated" ) ) {
			if ( $.isFunction( o.after ) ) {
				var after = o.after;
				o.after = function() {
					after();
					o.resetSlider();
				};
			} else {
				o.after = o.resetSlider;
			}
		} else {
			o.autoplayOff();
			o.stage.removeAttr( "style" );
			o.slider.removeAttr( "style" );
			o.slides.removeAttr( "style" );
			o.slides.filter( "." + o.classSlideClone ).remove();
			o.slides = o.slider.children( o.options.selectorSlide );
			o.stageHeight = 0;
			o.slideWidthCurrent = 0;
			o.slideScaling = o.optionsInit.slideScaling;
			o.indexCurrent -= o.slidesToClone;
			o.indexFirst = 0;
			o.increment = o.optionsInit.increment;
			o.after = false;
			o.setup();
			o.slideSetup();
			o.updateNavButtons();
			o.autoplayOn( o.increment );
		}
		return this;
	};
	o.slideSetup = function() {
		o.slides.each(function( i ) {
			var slide = $( this );
			slide.css({
				"transform-origin": "50% " + String( 50 + o.offsetV ) + "%",
				"width": o.slideWidthCurrent,
                "display": "block",
                "opacity": "1"
			});
			if ( o.options.centerV ) {
                getMarginTop( slide, "slideMarginTopCurrent" );
			}
			slide.css({
				"width": o.scalingWidth
			});
			if ( o.slideScaling !== 100 ) {
				slide.css({
					"marginLeft": o.scalingMargin,
					"marginRight": o.scalingMargin,
					"transform": "scale(" + ( 100 / o.slideScaling ) + ")",
					"borderSpacing": o.slideScaling
				});
			}
			if ( o.options.centerV ) {
				slide.children().first().css({
					"marginTop": getMarginTop( slide, "slideMarginTop" )
				});
			}
			if ( i === o.indexCurrent ) {
				slide
					.css({
						"borderSpacing": "100px",
						"width": o.slideWidthCurrent,
						"marginLeft": 0,
						"marginRight": 0,
						"transform": "scale(1)"
					})
					.addClass( o.classCurrent )
					.siblings()
						.removeClass( o.classCurrent )
				;
				if ( o.options.centerV ) {
					slide.children().first().css({
						"marginTop": getMarginTop( slide, "slideMarginTopCurrent" )
					});
				}
			}
		});
	};
    function leftOffsetter( index ) {
        var indexOffset = o.slideWidth * index * -1,
            leftOffset = indexOffset;
        if ( o.options.slidePosition === "center" ) {
            leftOffset = indexOffset + ( Math.floor( o.slidesOnStage / 2 ) * o.slideWidth );
        } else if (o.options.slidePosition === "right") {
            leftOffset = ( indexOffset + ( ( o.slidesOnStage - 1) * o.slideWidth ) );
        }
        return leftOffset;
    }
	function getMarginTop( slide, dataKey ) {
		var height = slide.children().first().outerHeight(),
				slideMarginTop = 0;
		if (height > o.stageHeight) {
			slideMarginTop = ( o.stageHeight - height ) / 2;
		}
		slide.data( dataKey, slideMarginTop );
		return slideMarginTop;
	}

    function normalizeIndex( index ) {
        index = ( ( index % o.slidesLengthOrig ) + o.slidesLengthOrig ) % o.slidesLengthOrig;
        return index;
    }
	function supportTransform( element ) {
		var test = false;
		if ( typeof Modernizr !== 'undefined' ) {
			if ( Modernizr.csstransforms ) {
				test = true;
			}
		} else {
			var style = element.style;
			if (typeof style.transform !== "undefined" ||
				typeof style.WebkitTransform !== "undefined" ||
				typeof style.msTransform !== "undefined") {
					test = true;
			}
		}
		return test;
	}
	o.init( stageEl, options );
	return this;
};
$.fn.miSlider = function( options ) {
	return this.each(function() {
		var stage = $( this );
		if ( !stage.data( "miSlider" ) ) {
			stage.data( "miSlider", new MiSlider( this, options ) );
		}
	});
};
})( jQuery, window, document, Math );