;(function($, elementor){
'use strict';
// make the window global for site js
var $window = $(window);

var debounce = function(func, wait, immediate) {
    // 'private' variable for instance
    // The returned function will be able to reference this due to closure.
    // Each call to the returned function will share this common timer.
    var timeout;

    // Calling debounce returns a new anonymous function
    return function() {
        // reference the context and args for the setTimeout function
        var context = this,
            args = arguments;

        // Should the function be called now? If immediate is true
        //   and not already in a timeout then the answer is: Yes
        var callNow = immediate && !timeout;

        // This is the basic debounce behaviour where you can call this
        //   function several times, but it will only execute once
        //   [before or after imposing a delay].
        //   Each time the returned function is called, the timer starts over.
        clearTimeout(timeout);

        // Set the new timeout
        timeout = setTimeout(function() {

            // Inside the timeout function, clear the timeout variable
            // which will let the next execution run when in 'immediate' mode
            timeout = null;

            // Check if the function already ran with the immediate flag
            if (!immediate) {
                // Call the original function with apply
                // apply lets you define the 'this' object as well as the arguments
                //    (both captured before setTimeout)
                func.apply(context, args);
            }
        }, wait);

        // Immediate mode and no wait timer? Execute the function..
        if (callNow) func.apply(context, args);
    };
};
/**
 * Start advanced icon box widget script
 */

(function($, elementor) {

    'use strict';

    // Accordion
    var widgetAdvancedIconBox = function($scope, $) {

        var $avdDivider = $scope.find('.bdt-advanced-icon-box'),
            divider = $($avdDivider).find('.bdt-title-separator-wrapper > img');

        if (!$avdDivider.length) {
            return;
        }

        elementorFrontend.waypoint(divider, function() {
            bdtUIkit.svg(this, {
                strokeAnimation: true
            });
        }, {
            offset: 'bottom-in-view'
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-icon-box.default', widgetAdvancedIconBox);
    });

}(jQuery, window.elementorFrontend));

/**
 * End advanced icon box widget script
 */


/**
 * Start advanced gmap widget script
 */

(function ($, elementor) {
	'use strict';

	//Adavanced Google Map
	var widgetAvdGoogleMap = function ($scope, $) {

		var $advancedGoogleMap = $scope.find('.bdt-advanced-gmap'),
			map_settings = $advancedGoogleMap.data('map_settings'),
			markers = $advancedGoogleMap.data('map_markers'),
			map_lists = $scope.find('ul.bdt-gmap-lists div.bdt-gmap-list-item'),
			map_search_form = $scope.find('.bdt-search'),
			map_search_text_box = $scope.find('.bdt-search-input'),
			map_form = $scope.find('.bdt-gmap-search-wrapper > form');

		if (!$advancedGoogleMap.length) {
			return;
		}

		var avdGoogleMap = new GMaps(map_settings);
		for (var i in markers) {
			let listMarker = markers[i].image;
			avdGoogleMap.addMarker({
				lat: markers[i].lat,
				lng: markers[i].lng,
				title: markers[i].title,
				icon: markers[i].icon,
				infoWindow: {
					content:
						`<div class="bdt-map-tooltip-view">
						<div class="bdt-map-tooltip-view-inner">
							<div class="bdt-map-tooltip-top-image">
							<img class="bdt-map-image" src="${listMarker}" alt="" />
							</div>
							<div class="bdt-map-tooltip-bottom-footer">
							<h4 class="bdt-tooltip-title">${markers[i].title}</h4>
							<h5 class="bdt-tooltip-place">${markers[i].place}</h5>
							<span class="bdt-tooltip-content">${markers[i].content}</span><br>
							<a href="${markers[i].website}">${markers[i].website}</a>
								<a href="tel:${markers[i].phone}">${markers[i].phone}</a>
							</div>
						</div>
						</div>`
				},
			});
		}

		if ($advancedGoogleMap.data('map_geocode')) {
			$(map_form).submit(function (e) {
				e.preventDefault();
				GMaps.geocode({
					address: $(this).find('.bdt-search-input').val().trim(),
					callback: function (results, status) {
						if (status === 'OK') {
							var latlng = results[0].geometry.location;
							avdGoogleMap.setCenter(
								latlng.lat(),
								latlng.lng()
							);
							avdGoogleMap.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng()
							});
						}
					}
				});
			});
		}

		if ($advancedGoogleMap.data('map_style')) {
			avdGoogleMap.addStyle({
				styledMapName: 'Custom Map',
				styles: $advancedGoogleMap.data('map_style'),
				mapTypeId: 'map_style'
			});
			avdGoogleMap.setStyle('map_style');
		}

		$(map_lists).bind("click", function (e) {
			var mapList;
			var dataSettings = $(this).data("settings");
			mapList = new GMaps({
				el: dataSettings.el,
				lat: dataSettings.lat,
				lng: dataSettings.lng,
				title: dataSettings.title,
				zoom: map_settings.zoom,
			});
			if (dataSettings.image !== undefined) {
				var listMarker = dataSettings.image[0];
			} else {
				var listMarker = dataSettings.image;
			}
			mapList.addMarker({
				lat: dataSettings.lat,
				lng: dataSettings.lng,
				title: dataSettings.title,
				icon: dataSettings.icon,
				infoWindow: {
					content:
						`<div class="bdt-map-tooltip-view">
						<div class="bdt-map-tooltip-view-inner">
							<div class="bdt-map-tooltip-top-image">
							<img class="bdt-map-image" src="${listMarker}" alt="" />
							</div>
							<div class="bdt-map-tooltip-bottom-footer">
								<h4 class="bdt-tooltip-title">${dataSettings.title}</h4>
								<h5 class="bdt-tooltip-place">${dataSettings.place}</h5>
								<span class="bdt-tooltip-content">${dataSettings.content}</span><br>
								<a href="${dataSettings.website}">${dataSettings.website}</a>
								<a href="tel:${dataSettings.phone}">${dataSettings.phone}</a>
							</div>
						</div>
						</div>`
				},
			});
		});


		/**
			 * binding event for search form
			 */
		$(map_search_form).submit(function (e) {
			e.preventDefault();
			let searchValue = $(map_search_text_box).val().toLowerCase();
			$(map_lists).filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
			});
		});
		/**
		 * bind search event on key press
		 */
		$(map_search_text_box).keyup(function () {
			let searchValue = $(this).val().toLowerCase();
			$(map_lists).filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
			});
		});


	};
	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-gmap.default', widgetAvdGoogleMap);
	});

}(jQuery, window.elementorFrontend));

/**
 * End advanced gmap widget script
 */


/**
 * Start accordion widget script
 */

(function($, elementor) {
    'use strict';
    var widgetAccordion = function($scope, $) {
        var $accrContainer = $scope.find('.bdt-accordion-container'),
        $accordion = $accrContainer.find('.bdt-accordion');
        if (!$accrContainer.length) {
            return;
        }
        var $settings         = $accordion.data('settings');
        var activeHash        = $settings.activeHash;
        var hashTopOffset     = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;
        var activeScrollspy   = $settings.activeScrollspy;

        if (activeScrollspy === null || typeof activeScrollspy === 'undefined'){
            activeScrollspy = 'no';
        }

        function hashHandler($accordion, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($accordion).find('[data-title="' + window.location.hash.substring(1) + '"]').length) {
                        var hashTarget = $('[data-title="' + window.location.hash.substring(1) + '"]')
                        .closest($accordion)
                        .attr('id');

                        if(activeScrollspy == 'yes'){
                            $('html, body').animate({
                                easing    : 'slow',
                                scrollTop : $('#'+hashTarget).offset().top - hashTopOffset
                            }, hashScrollspyTime, function() {
                                }).promise().then(function() {
                                    bdtUIkit.accordion($accordion).toggle($('[data-title="' + window.location.hash.substring(1) + '"]').data('accordion-index'), false);
                                });
                        } else {
                            bdtUIkit.accordion($accordion).toggle($('[data-title="' + window.location.hash.substring(1) + '"]').data('accordion-index'), true);
                        }

                }
            }
        }
    if (activeHash == 'yes') {
        $(window).on('load', function() {
            if(activeScrollspy == 'yes'){
                hashHandler($accordion, hashScrollspyTime, hashTopOffset);
            }else{
                bdtUIkit.accordion($accordion).toggle($('[data-title="' + window.location.hash.substring(1) + '"]').data('accordion-index'), false);
            }
        });
        $($accordion).find('.bdt-accordion-title').off('click').on('click', function(event) {
            window.location.hash = ($.trim($(this).attr('data-title')));
            hashHandler($accordion, hashScrollspyTime = 1000, hashTopOffset);
        });
        $(window).on('hashchange', function(e) {
            hashHandler($accordion, hashScrollspyTime = 1000, hashTopOffset);
        });
    }

    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-accordion.default', widgetAccordion);
    });

}(jQuery, window.elementorFrontend));

/**
 * End accordion widget script
 */
/**
 * Start animated heading widget script
 */

(function($, elementor) {

  'use strict';

  var widgetAnimatedHeading = function($scope, $) {

    var $heading = $scope.find('.bdt-heading > *'),
    $animatedHeading = $heading.find('.bdt-animated-heading'),
    $settings = $animatedHeading.data('settings');

    if (!$heading.length) {
      return;
    }

    function kill() { 
      var splitTextTimeline = gsap.timeline(), 
      mySplitText = new SplitText($quote, {type:"chars, words, lines"});
      splitTextTimeline.clear().time(0);
      mySplitText.revert();
    }


    if ($settings.layout === 'animated') {
      $($animatedHeading).Morphext($settings);
    } else if ($settings.layout === 'typed') {
      var animateSelector = $($animatedHeading).attr('id');
      var typed = new Typed('#' + animateSelector, $settings);
    }else if($settings.layout === 'split_text'){

      var $quote = $($heading);

      var splitTextTimeline = gsap.timeline(), 
      mySplitText = new SplitText($quote, {type:"chars, words, lines"});


      gsap.set($quote, {
                perspective: $settings.anim_perspective //400
              });

 
      elementorFrontend.waypoint( $heading, function() {
        kill();
        mySplitText.split({
          type: 'chars, words, lines'
        });
        var stringType = '';
        if ( 'lines' == $settings.animation_on ) {
          stringType = mySplitText.lines;
        } else if ( 'chars' == $settings.animation_on ) {
          stringType = mySplitText.chars;
        } else {
          stringType = mySplitText.words;
        }
        splitTextTimeline.staggerFrom(stringType, 0.5, {
                    opacity: 0, //0
                    scale: $settings.anim_scale, //0
                    y: $settings.anim_rotation_y, //80
                    rotationX: $settings.anim_rotation_x, //180
                    transformOrigin: $settings.anim_transform_origin, //0% 50% -50  
                    // ease:Back.easeOut, //back
                  }, $settings.anim_duration); 
      }, {

            // offset: 'bottom-in-view',
            offset: '50%',
            triggerOnce : ($settings.anim_repeat)// == 'false' ? false : true 
          } );

    } 

    $($heading).animate({
      easing: 'slow',
      opacity: 1
    }, 500); 


  };


  jQuery(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/bdt-animated-heading.default', widgetAnimatedHeading);
  });

}(jQuery, window.elementorFrontend));

/**
 * End animated heading widget script
 */


/**
 * Start advanced heading widget script
 */

 (function($, elementor) {
    'use strict'; 
    var widgetAdavancedHeading = function($scope, $) {
        var $advHeading = $scope.find('.bdt-advanced-heading'),
        $advMainHeadeingInner = $advHeading.find('.bdt-main-heading-inner');

        if (!$advHeading.length) {
            return;
        }
        var $settings = $advHeading.data('settings');
        if( typeof $settings.titleMultiColor === "undefined" && $settings.titleMultiColor == 'yes'){
         var word = $($advMainHeadeingInner).text(); 
         var words = word.split(" ");
         
         // console.log(words);
         $($advMainHeadeingInner).html('');
         var i;
         for (i = 0; i < words.length; ++i) {
                 // $('#result').append('<span>'+words[i] +' </span>');
                 $($advMainHeadeingInner).append('<span>' + words[i] + '&nbsp;</span>');
             }

             $($advMainHeadeingInner).find( 'span' ).each(function() {
               var randomColor = Math.floor(Math.random()*16777215).toString(16);
               $(this).css( { 'color' : '#' + randomColor } );
           }); 
         }
         

     };
     jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-heading.default', widgetAdavancedHeading);
    });
 }(jQuery, window.elementorFrontend));

/**
 * End advanced heading widget script
 */


/**
 * Start advanced progress bar widget script
 */

(function($, elementor) {
    'use strict';
    // AdvancedProgressBar
    var widgetAdvancedProgressBar = function($scope, $) {
        var $advancedProgressBar = $scope.find('.bdt-advanced-progress-bar .bdt-progress-item');
        if (!$advancedProgressBar.length) {
            return;
        }
                    
 
        elementorFrontend.waypoint($advancedProgressBar, function() {
            var $this = $(this);
 
            //.bdt-progress-item .bdt-progress-fill
            var bar = $(this).find(" .bdt-progress-fill"),
                barPos,
                windowBtm = $(window).scrollTop() + $(window).height();
            bar.each(function() {
                barPos = $(this).offset().top;

                // if (barPos <= windowBtm) {
                    $(this).css("width", function() {
                         var thisMaxVal = $(this).attr("data-max-value");
                         var thisFillVal = $(this).attr("data-width").slice(0, -1); 
                         var formula = (thisFillVal*100) / thisMaxVal;
                         // console.log(formula);
                        // return $(this).attr("data-width");
                        return formula+'%';
                    });
                    $(this).children(".bdt-progress-parcentage").css({
                        '-webkit-transform': 'scale(1)',
                        '-moz-transform': 'scale(1)',
                        '-ms-transform': 'scale(1)',
                        '-o-transform': 'scale(1)',
                        'transform': 'scale(1)'
                    });
                // }
            });
        }, {
            offset: '90%'
        });
 
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-progress-bar.default', widgetAdvancedProgressBar);
    });
}(jQuery, window.elementorFrontend)); 

/**
 * End advanced progress bar widget script
 */


/**
 * Start advanced counter widget script
 */

(function($, elementor) {
    'use strict';
    // AdvancedCounter
    var widgetAdvancedCounter = function($scope, $) {
        var $AdvancedCounter = $scope.find('.bdt-advanced-counter');
        if (!$AdvancedCounter.length) {
            return;
        }

        elementorFrontend.waypoint($AdvancedCounter, function() {

            var $this = $(this);
            var $settings = $this.data('settings');
            // start null checking
            var countStart = $settings.countStart;
            if (typeof countStart === 'undefined' || countStart == null) {
                countStart = 0;
            }
            
            var countNumber = $settings.countNumber;
            if (typeof countNumber === 'undefined' || countNumber == null) {
                countNumber = 0;
            }
            var decimalPlaces = $settings.decimalPlaces;
            if (typeof decimalPlaces === 'undefined' || decimalPlaces == null) {
                decimalPlaces = 0;
            }
            var duration = $settings.duration;
            if (typeof duration === 'undefined' || duration == null) {
                duration = 0;
            }
            var useEasing = $settings.useEasing;
            useEasing = !(typeof useEasing === 'undefined' || useEasing == null);
            var useGrouping = $settings.useGrouping;

            useGrouping = !(typeof useGrouping === 'undefined' || useGrouping == null);

            var counterSeparator = $settings.counterSeparator;
            if (typeof counterSeparator === 'undefined' || counterSeparator == null) {
                counterSeparator = '';
            }
            var decimalSymbol = $settings.decimalSymbol;
            if (typeof decimalSymbol === 'undefined' || decimalSymbol == null) {
                decimalSymbol = '';
            }
            var counterPrefix = $settings.counterPrefix;
            if (typeof counterPrefix === 'undefined' || counterPrefix == null) {
                counterPrefix = '';
            }
            var counterSuffix = $settings.counterSuffix;
            if (typeof counterSuffix === 'undefined' || counterSuffix == null) {
                counterSuffix = '';
            }

            // end null checking


            var options = {  
                startVal: countStart,
                // numerals: ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯']
                numerals: $settings.language,
                decimalPlaces: decimalPlaces,
                duration: duration,
                useEasing: useEasing,
                useGrouping: useGrouping,
                separator: counterSeparator,
                decimal: decimalSymbol,
                prefix: counterPrefix,
                suffix: counterSuffix,


            };

            var demo = new CountUp($settings.id, countNumber, options);
            if (!demo.error) {
                demo.start();
            } else {
                console.error(demo.error);
            }
            //  start  for count 

        }, {
            offset: 'bottom-in-view'
        });

    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-counter.default', widgetAdvancedCounter);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-total-count.default', widgetAdvancedCounter);
    });
}(jQuery, window.elementorFrontend));

/**
 * End advanced counter widget script
 */


/**
 * Start advanced divider widget script
 */

(function($, elementor) {

    'use strict';

    // Accordion
    var widgetAdvancedDivider = function($scope, $) {

        var $avdDivider = $scope.find('.bdt-advanced-divider'),
            $settings 	= $avdDivider.data('settings');

          
        if (!$avdDivider.length) {
            return;
        }

        if ($settings.animation === true) {
            elementorFrontend.waypoint($avdDivider, function() {
                var $divider = $(this).find('img');
                bdtUIkit.svg( $divider, {
                    strokeAnimation : true,
                });
            }, {
                offset: 'bottom-in-view',
                triggerOnce: (!$settings.loop)
            } );
        } else {
            var $divider = $($avdDivider).find('img');
            bdtUIkit.svg( $divider );
        }


    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-divider.default', widgetAdvancedDivider);
    });

}(jQuery, window.elementorFrontend));

/**
 * End advanced divider widget script
 */


/**
 * Start chart widget script
 */

 ( function( $, elementor ) {

   'use strict';

   var widgetChart = function( $scope, $ ) {

    var $chart        = $scope.find( '.bdt-chart' ),
    $chart_canvas = $chart.find( '> canvas' ),
    settings      = $chart.data('settings'),
    suffixprefix  = $chart.data('suffixprefix');

    if ( ! $chart.length ) {
      return;
    }

    elementorFrontend.waypoint( $chart_canvas, function() {
      var $this   = $( this ),
      ctx     = $this[0].getContext('2d'),
      myChart = new Chart(ctx, settings);

      var thouSeparator = settings.valueSeparator,
      sepratorSymbol = settings.sepratorSymbol,
      xAxesSeparator = settings.xAxesSeparator,
      yAxesSeparator = settings.yAxesSeparator;
      var _k_formatter   = (settings.kFormatter == 'yes') ? true : false; 

      
                // start update
                 // s_p_status = s=suffix, p = prefix 
                 var 
                 s_p_status = (typeof suffixprefix.suffix_prefix_status !== 'undefined') ? suffixprefix.suffix_prefix_status : 'no',

                 x_prefix = (typeof suffixprefix.x_custom_prefix !== 'undefined') ? suffixprefix.x_custom_prefix : '',
                 x_suffix = (typeof suffixprefix.x_custom_suffix !== 'undefined') ? suffixprefix.x_custom_suffix : '',

                 y_suffix = (typeof suffixprefix.y_custom_suffix !== 'undefined') ? suffixprefix.y_custom_suffix : '',
                 y_prefix = (typeof suffixprefix.y_custom_prefix !== 'undefined') ? suffixprefix.y_custom_prefix : '';

                // toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") 

                function addCommas(nStr, sepratorSymbol, _k_formatter) {
                  nStr += '';
                  var x = nStr.split('.');
                  var x1 = x[0];
                  var x2 = x.length > 1 ? '.' + x[1] : '';
                  var rgx = /(\d+)(\d{3})/;
                  while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + sepratorSymbol + '$2');
                  }
                  

                  if( _k_formatter == true ){
                    if (nStr >= 1000000000) {
                      return (nStr / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
                    }
                    if (nStr >= 1000000) {
                      return (nStr / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
                    }
                    if (nStr >= 1000) {
                      return (nStr / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
                    }
                    return nStr;
                  }else{
                    return x1 + x2;
                  }

                }


                function updateChartSetting(chart, thouSeparator = 'no', sepratorSymbol = ',') {
                  chart.options = {
                    scales: { 
                      xAxes: [{
                        ticks: {
                          callback: function(value, index, values) {
                                        // return '$' + value + '%';
                                        // return x_prefix + value + x_suffix;
                                        if(s_p_status == 'yes' && thouSeparator == 'yes' && xAxesSeparator == 'yes'){
                                          return x_prefix + addCommas(value, sepratorSymbol, _k_formatter)  + x_suffix;
                                        }else if(s_p_status == 'no' && thouSeparator == 'yes' && xAxesSeparator == 'yes'){
                                          return addCommas(value, sepratorSymbol, _k_formatter);
                                        }else{
                                          return x_prefix + value + x_suffix;
                                        }
                                      }
                                    }
                                  }],
                                  yAxes: [{
                                    ticks: {
                                      callback: function(value, index, values) {
                                        // return y_prefix + value + y_suffix;
                                        if(s_p_status == 'yes' && thouSeparator == 'yes' && yAxesSeparator == 'yes'){
                                          return y_prefix + addCommas(value, sepratorSymbol, _k_formatter) + y_suffix;
                                        }else if(s_p_status == 'no' && thouSeparator == 'yes' && yAxesSeparator == 'yes'){
                                          return addCommas(value, sepratorSymbol, _k_formatter);
                                        }else{
                                          return y_prefix + value + y_suffix;
                                        }
                                      }
                                    }
                                  }],

                                }

                              };
                              chart.update();
                            }
                            if(s_p_status == 'yes' && thouSeparator == 'no'){
                              updateChartSetting(myChart);
                            }else if(s_p_status == 'yes' && thouSeparator == 'yes'){
                              updateChartSetting(myChart, thouSeparator, sepratorSymbol);
                            }else if(s_p_status == 'no' && thouSeparator == 'yes'){
                              updateChartSetting(myChart, thouSeparator, sepratorSymbol);
                            }else{

                            }
                // end update

              }, {
                offset: 'bottom-in-view'
              } );

};


jQuery(window).on('elementor/frontend/init', function() {
  elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-chart.default', widgetChart );
});

}( jQuery, window.elementorFrontend ) );

/**
 * End chart widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetCarousel = function ($scope, $) {

        var $carousel = $scope.find('.bdt-carousel');

        if (!$carousel.length) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
            $settings = $carousel.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($carouselContainer, $settings);

            if ($settings.pauseOnHover) {
                $($carouselContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

        };

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.default', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-alice', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-vertical', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-ramble', widgetCarousel);
    });

}(jQuery, window.elementorFrontend));
/**
 * Start countdown widget script
 */
 
(function ($, elementor) {
    'use strict';
    var widgetCountdown = function ($scope, $) {
        var $countdown = $scope.find('.bdt-countdown-wrapper');
        if (!$countdown.length) {
            return;
        }
        var $settings = $countdown.data('settings'),
            endTime = $settings.endTime,
            loopHours = $settings.loopHours,
            isLogged = $settings.isLogged;

           
 
        var countDownObj = {
            setCookie: function (name, value, hours) {
                var expires = "";
                if (hours) {
                    var date = new Date();
                    date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            },
            getCookie: function (name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            },
            randomIntFromInterval: function (min, max) { // min and max included 
                return Math.floor(Math.random() * (max - min + 1) + min)
            },
            getTimeSpan: function (date) {
                var total = date - Date.now();

                return {
                    total,
                    seconds: total / 1000 % 60,
                    minutes: total / 1000 / 60 % 60,
                    hours: total / 1000 / 60 / 60 % 24,
                    days: total / 1000 / 60 / 60 / 24
                };
            },
            showPost: function (endTime) {
                jQuery.ajax({
                    url: $settings.adminAjaxUrl,
                    type: 'post',
                    data: {
                        action: 'element_pack_countdown_end',
                        endTime: endTime,
                        couponTrickyId: $settings.couponTrickyId
                    },
                    success: function (data) {
                        if (data == 'ended') {
                            if ($settings.endActionType == 'message') {
                                jQuery($settings.msgId).css({
                                    'display': 'block'
                                });
                                jQuery($settings.id + '-timer').css({
                                    'display': 'none'
                                });
                            }
                            if ($settings.endActionType == 'url') {
                                setInterval(function () {
                                    jQuery(location).attr('href', $settings.redirectUrl);
                                }, $settings.redirectDelay);
                            }
                        } 
                    },
                    error: function () {
                        //error handling
                        console.log("Error");
                    }
                });
            },
            couponCode: function(){
                jQuery.ajax({
                    url: $settings.adminAjaxUrl,
                    type: 'post',
                    data: {
                        action: 'element_pack_countdown_end',
                        endTime: endTime,
                        couponTrickyId: $settings.couponTrickyId
                    },
                    success: function (data) {
                    },
                    error: function () {
                        //error handling
                        //console.log("Error");
                    }
                });
            },
            triggerFire : function(){
                jQuery.ajax({
                    url: $settings.adminAjaxUrl,
                    type: 'post',
                    data: {
                        action: 'element_pack_countdown_end',
                        endTime: endTime,
                        couponTrickyId: $settings.couponTrickyId
                    },
                    success: function (data) {
                         if (data == 'ended') {
                             setTimeout(function () {
                                 document.getElementById($settings.triggerId).click();
                                //  jQuery('#' + $settings.triggerId).trigger('click');
                             }, 1500);
                         }
                    },
                    error: function () {
                        //console.log("Error");
                    }
                });
            },
            clearInterVal: function (myInterVal) {
                clearInterval(myInterVal);
            }

        };


        if (loopHours == false) {
            var countdown = bdtUIkit.countdown($($settings.id + '-timer'), {
                date: $settings.finalTime
            });

            var myInterVal = setInterval(function () {
                var seconds = countDownObj.getTimeSpan(countdown.date).seconds.toFixed(0);
                var finalSeconds = parseInt(seconds);
                if (finalSeconds < 0) {
                    if (!jQuery('body').hasClass('elementor-editor-active')) {
                        jQuery($settings.id + '-msg').css({
                            'display': 'none'
                        });
                        if ($settings.endActionType != 'none') {
                            countDownObj.showPost(endTime)
                        };
                    }
                    countDownObj.clearInterVal(myInterVal);
                }
            }, 1000);
            
            // for coupon code
            if ($settings.endActionType == 'coupon-code') {
                var myInterVal2 = setInterval(function () {
                    var seconds = countDownObj.getTimeSpan(countdown.date).seconds.toFixed(0);
                    var finalSeconds = parseInt(seconds);
                    if (finalSeconds < 0) {
                        if (!jQuery('body').hasClass('elementor-editor-active')) {
                            if ($settings.endActionType == 'coupon-code') {
                                countDownObj.couponCode(endTime)
                            };
                        }
                        countDownObj.clearInterVal(myInterVal2);
                    }
                }, 1000);
            }
            // custom trigger on the end

            if ($settings.triggerId !== false) {
                var myInterVal2 = setInterval(function () {
                    var seconds = countDownObj.getTimeSpan(countdown.date).seconds.toFixed(0);
                    var finalSeconds = parseInt(seconds);
                    if (finalSeconds < 0) {
                        if (!jQuery('body').hasClass('elementor-editor-active')) {
                                countDownObj.triggerFire();
                        }
                        countDownObj.clearInterVal(myInterVal2);
                    }
                }, 1000);
            }
 
        }


        if (loopHours !== false) {
            var now = new Date(),
                randMinute = countDownObj.randomIntFromInterval(6, 14),
                hours = loopHours * 60 * 60 * 1000 - (randMinute * 60 * 1000),
                timer = new Date(now.getTime() + hours),
                loopTime = timer.toISOString(),
                getCookieLoopTime = countDownObj.getCookie('bdtCountdownLoopTime');


            if ((getCookieLoopTime == null || getCookieLoopTime == 'undefined') && isLogged === false) {
                countDownObj.setCookie('bdtCountdownLoopTime', loopTime, loopHours);
            }

            var setLoopTimer;

            if (isLogged === false) {
                setLoopTimer = countDownObj.getCookie('bdtCountdownLoopTime');
            } else {
                setLoopTimer = loopTime;
            }

            $($settings.id + '-timer').attr('data-bdt-countdown', 'date: ' + setLoopTimer);
            var countdown = bdtUIkit.countdown($($settings.id + '-timer'), {
                date: setLoopTimer
            });

            var countdownDate = countdown.date;

            setInterval(function () {
                var seconds = countDownObj.getTimeSpan(countdownDate).seconds.toFixed(0);
                var finalSeconds = parseInt(seconds);
                // console.log(finalSeconds);
                if (finalSeconds > 0) {
                    if ((getCookieLoopTime == null || getCookieLoopTime == 'undefined') && isLogged === false) {
                        countDownObj.setCookie('bdtCountdownLoopTime', loopTime, loopHours);
                        bdtUIkit.countdown($($settings.id + '-timer'), {
                            date: setLoopTimer
                        });
                    }
                }

            }, 1000);


        }


    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-countdown.default', widgetCountdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-countdown.bdt-tiny-countdown', widgetCountdown);
    });
}(jQuery, window.elementorFrontend));

/**
 * End countdown widget script
 */
/**
 * Start custom carousel widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetCustomCarousel = function( $scope, $ ) {

		var $carousel = $scope.find( '.bdt-custom-carousel' );
				
        if ( ! $carousel.length ) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
			$settings 		 = $carousel.data('settings');

		const Swiper = elementorFrontend.utils.swiper;
		initSwiper();
		async function initSwiper() {
			var swiper = await new Swiper($carouselContainer, $settings);

			if ($settings.pauseOnHover) {
				$($carouselContainer).hover(function () {
					(this).swiper.autoplay.stop();
				}, function () {
					(this).swiper.autoplay.start();
				});
			}
		};

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-custom-carousel.default', widgetCustomCarousel );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-custom-carousel.bdt-custom-content', widgetCustomCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End custom carousel widget script
 */


/**
 * Start circle info widget script
 */

// this is the main function, here impvaring all html into js DOM as a
// parameter. 
function circleJs(id, circleMoving, movingTime, mouseEvent) {
    var circles = document.querySelectorAll('#' + id + ' .bdt-info-sub-circle');
    var circleContents = document.querySelectorAll('#' + id + '  .bdt-circle-info-item');
    var parent = document.querySelector('#' + id + ' .bdt-circle-info-inner ');

    var i = 2;
    var prevNowPlaying = null;

    if (movingTime <= 0) {
        movingTime = '100000000000';
    }

    if (circleMoving === false) {
        movingTime = '100000000000';
    }

    function myTimer() {
        //console.log('setInterval');
        var dataTab = $(' #' + id + ' .bdt-info-sub-circle.active').data('circle-index');
        var totalSubCircle = $('#' + id + ' .bdt-info-sub-circle').length; // here

        if (dataTab > totalSubCircle || i > totalSubCircle) {
            dataTab = 1;
            i = 1;
        }

        $('#' + id + '  .bdt-info-sub-circle').removeClass('active');
        $('#' + id + ' .bdt-info-sub-circle.active').removeClass('active', this);
        $('#' + id + '  ' + '[data-circle-index=\'' + i + '\']').addClass('active');
        $('#' + id + '  .bdt-circle-info-item').removeClass('active');
        $('#' + id + '  .icci' + i).addClass('active');
        i++;
        var activeIcon = '#' + id + ' .bdt-info-sub-circle i,' + '#' + id + ' .bdt-info-sub-circle svg';
        $(activeIcon).css({
            'transform': 'rotate(' + (360 - (i - 2) * 36) + 'deg)',
            'transition': '2s'
        });
        $('#' + id + ' .bdt-circle-info-inner').css({
            'transform': 'rotate(' + ((i - 2) * 36) + 'deg) ',
            'transition': '1s'
        });

    }
    if (circleMoving === true) {
        var prevNowPlaying = setInterval(myTimer, movingTime);
    }
    if (circleMoving === false) {
        clearInterval(prevNowPlaying);
    }


    // active class toggle methods
    var removeClasses = function removeClasses(nodes, value) {
        var nodes = nodes;
        var value = value;
        if (nodes) return nodes.forEach(function (node) {
            return node.classList.contains(value) && node.classList.remove(value);
        });
        else return false;
    };
    var addClass = function addClass(nodes, index, value) {
        var nodes = nodes;
        var index = index;
        var value = value;
        return nodes ? nodes[index].classList.add(value) : 0;
    };
    var App = {
        initServicesCircle: function initServicesCircle() {
            // info circle
            if (parent) {
                var spreadCircles = function spreadCircles() {
                    // spread the sub-circles around the circle
                    var parent = document.querySelector('#' + id + ' .bdt-circle-info-inner ').getBoundingClientRect();
                    var centerX = 0;
                    var centerY = 0;
                    Array.from(circles).reverse().forEach(function (circle, index) {
                        var circle = circle;
                        var index = index;
                        var angle = index * (360 / circles.length);
                        var x = centerX + (parent.width / 2) * Math.cos((angle * Math.PI) / 180);
                        var y = centerY + (parent.height / 2) * Math.sin((angle * Math.PI) / 180);
                        circle.style.transform = 'translate3d(' + parseFloat(x).toFixed(5) + 'px,' + parseFloat(y).toFixed(5) + 'px,0)';
                    });
                };

                spreadCircles();

                var resizeTimer = void 0;
                window.addEventListener('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function () {
                        spreadCircles();
                    }, 50);
                });
                circles.forEach(function (circle, index) {
                    var circle = circle;
                    var index = index;
                    var circlesToggleFnc = function circlesToggleFnc() {
                        this.index = circle.dataset.circleIndex;
                        if (!circle.classList.contains('active')) {
                            removeClasses(circles, 'active');
                            removeClasses(circleContents, 'active');
                            addClass(circles, index, 'active');
                            addClass(circleContents, index, 'active');
                        }
                    };
                    if (mouseEvent === 'mouseover') {
                        circle.addEventListener('mouseover', circlesToggleFnc, true);
                    } else if (mouseEvent === 'click') {
                        circle.addEventListener('click', circlesToggleFnc, true);
                    } else {
                        circle.addEventListener('mouseover', circlesToggleFnc, true);
                    }
                });
            }
        }
    };
    App.initServicesCircle();
}

(function ($, elementor) {
    'use strict';
    var widgetCircleInfo = function ($scope, $) {
        var $circleInfo = $scope.find('.bdt-circle-info');

        if (!$circleInfo.length) {
            return;
        }

        elementorFrontend.waypoint($circleInfo, function () {
            var $this = $(this);
            var $settings = $this.data('settings');

            circleJs($settings.id, $settings.circleMoving, $settings.movingTime, $settings.mouseEvent);

        }, {
            // offset: 'bottom-in-view'
            offset: '80%'
        });

    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-circle-info.default', widgetCircleInfo);
    });
}(jQuery, window.elementorFrontend));

/**
 * End circle info widget script
 */
/**
 * Start slider widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetSlider = function( $scope, $ ) {

		var $slider = $scope.find( '.bdt-slider' );
				
        if ( ! $slider.length ) {
            return;
        }

        var $sliderContainer = $slider.find('.swiper-container'),
			$settings 		 = $slider.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($sliderContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($sliderContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-slider.default', widgetSlider );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End slider widget script
 */


/**
 * Start panel slider widget script
 */

(function ($, elementor) {

	'use strict';

	var widgetPanelSlider = function ($scope, $) {

		var $slider = $scope.find('.bdt-panel-slider');

		if (!$slider.length) {
			return;
		}

		var $sliderContainer = $slider.find('.swiper-container'),
			$settings = $slider.data('settings'),
			$widgetSettings = $slider.data('widget-settings');

			const Swiper = elementorFrontend.utils.swiper;
			initSwiper();
			async function initSwiper() {
				var swiper = await new Swiper($sliderContainer, $settings);

				if ($settings.pauseOnHover) {
					$($sliderContainer).hover(function () {
						(this).swiper.autoplay.stop();
					}, function () {
						(this).swiper.autoplay.start();
					});
				}
			};

		if ($widgetSettings.mouseInteractivity == true) {
			var data = $($widgetSettings.id).find('.bdt-panel-slide-item');
			$(data).each((index, element) => {
				var scene = $(element).get(0);
				var parallaxInstance = new Parallax(scene, {
					selector: '.bdt-panel-slide-thumb',
					hoverOnly: true,
					pointerEvents: true
				});
			});
		}

	};


	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-panel-slider.default', widgetPanelSlider);
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-panel-slider.bdt-middle', widgetPanelSlider);
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-panel-slider.always-visible', widgetPanelSlider);
	});

}(jQuery, window.elementorFrontend));

/**
 * End panel slider widget script
 */
/**
 * Start circle menu widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetCircleMenu = function( $scope, $ ) {

		var $circleMenu = $scope.find('.bdt-circle-menu'),
            $settings = $circleMenu.data('settings');

        if ( ! $circleMenu.length ) {
            return;
        }

        $($circleMenu[0]).circleMenu({
            direction           : $settings.direction,
            item_diameter       : $settings.item_diameter,
            circle_radius       : $settings.circle_radius,
            speed               : $settings.speed,
            delay               : $settings.delay,
            step_out            : $settings.step_out,
            step_in             : $settings.step_in,
            trigger             : $settings.trigger,
            transition_function : $settings.transition_function
        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-circle-menu.default', widgetCircleMenu );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End circle menu widget script
 */


/**
 * Start open street map widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetOpenStreetMap = function( $scope, $ ) {

		var $openStreetMap = $scope.find( '.bdt-open-street-map' ),
            settings       = $openStreetMap.data('settings'),
            markers        = $openStreetMap.data('map_markers'),
            tileSource = '';

        if ( ! $openStreetMap.length ) {
            return;
        }

        var avdOSMap = L.map($openStreetMap[0], {
                zoomControl: settings.zoomControl,
                scrollWheelZoom: false
            }).setView([
                    settings.lat,
                    settings.lng
                ], 
                settings.zoom
            );

        if (settings.mapboxToken !== '') {
          tileSource = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + settings.mapboxToken;
            L.tileLayer( tileSource, {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery &copy; <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(avdOSMap);
        } else {
            L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(avdOSMap);
        }


        for (var i in markers) { 
            if( (markers[i]['iconUrl']) != '' && typeof (markers[i]['iconUrl']) !== 'undefined'){ 
                var LeafIcon = L.Icon.extend({
                    options: {
                        iconSize   : [25, 41],
                        iconAnchor : [12, 41],
                        popupAnchor: [2, -41]
                    }
                });
                var greenIcon = new LeafIcon({iconUrl: markers[i]['iconUrl'] });
                L.marker( [markers[i]['lat'], markers[i]['lng']], {icon: greenIcon} ).bindPopup(markers[i]['infoWindow']).addTo(avdOSMap);
            } else {
                if( (markers[i]['lat']) != '' && typeof (markers[i]['lat']) !== 'undefined'){ 
                    L.marker( [markers[i]['lat'], markers[i]['lng']] ).bindPopup(markers[i]['infoWindow']).addTo(avdOSMap);
                }
            }
        }

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-open-street-map.default', widgetOpenStreetMap );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End open street map widget script
 */


/**
 * Start contact form widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetSimpleContactForm = function ($scope, $) {

        var $contactForm = $scope.find('.bdt-contact-form .without-recaptcha');

        if (!$contactForm.length) {
            return;
        }

        $contactForm.submit(function (e) {
            sendContactForm($contactForm);
            return false;
        });

        return false;

    };

    function sendContactForm($contactForm) {
        var langStr = window.ElementPackConfig.contact_form;

        $.ajax({
            url: $contactForm.attr('action'),
            type: 'POST',
            data: $contactForm.serialize(),
            beforeSend: function () {
                bdtUIkit.notification({
                    message: '<div bdt-spinner></div> ' + langStr.sending_msg,
                    timeout: false,
                    status: 'primary'
                });
            },
            success: function (data) {
                var redirectURL = $(data).data('redirect'),
                    isExternal = $(data).data('external'),
                    resetStatus = $(data).data('resetstatus');

                bdtUIkit.notification.closeAll();
                var notification = bdtUIkit.notification({
                    message: data
                });

                if (redirectURL){
                    if (redirectURL != 'no') {
                        bdtUIkit.util.on(document, 'close', function (evt) {
                            if (evt.detail[0] === notification) {
                                window.open(redirectURL, isExternal);
                            }
                        });
                    }
                }
                
                localStorage.setItem("bdtCouponCode", $contactForm.attr('id'));

                if (resetStatus) {
                    if (resetStatus !== 'no') {
                    $contactForm[0].reset();
                }
                }

                // $contactForm[0].reset();
            }
        });
        return false;
    }

    // google invisible captcha
    function elementPackGIC() {

        var langStr = window.ElementPackConfig.contact_form;

        return new Promise(function (resolve, reject) {

            if (grecaptcha === undefined) {
                bdtUIkit.notification({
                    message: '<div bdt-spinner></div> ' + langStr.captcha_nd,
                    timeout: false,
                    status: 'warning'
                });
                reject();
            }

            var response = grecaptcha.getResponse();

            if (!response) {
                bdtUIkit.notification({
                    message: '<div bdt-spinner></div> ' + langStr.captcha_nr,
                    timeout: false,
                    status: 'warning'
                });
                reject();
            }

            var $contactForm = $('textarea.g-recaptcha-response').filter(function () {
                return $(this).val() === response;
            }).closest('form.bdt-contact-form-form');

            var contactFormAction = $contactForm.attr('action');

            if (contactFormAction && contactFormAction !== '') {
                sendContactForm($contactForm);
            } else {
                // console.log($contactForm);
            }

            grecaptcha.reset();

        }); //end promise

    }

    //Contact form recaptcha callback, if needed
    window.elementPackGICCB = elementPackGIC;

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-contact-form.default', widgetSimpleContactForm);
    });


}(jQuery, window.elementorFrontend));

/**
 * End contact form widget script
 */
/**
 * Start cookie consent widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetCookieConsent = function( $scope, $ ) {

		var $cookieConsent = $scope.find('.bdt-cookie-consent'),
            $settings      = $cookieConsent.data('settings'),
            editMode       = Boolean( elementor.isEditMode() );
        
        if ( ! $cookieConsent.length || editMode ) {
            return;
        }

        window.cookieconsent.initialise($settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-cookie-consent.default', widgetCookieConsent );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End cookie consent widget script
 */


/**
 * Start event calendar widget script
 */

(function($, elementor) {

    'use strict';

    var widgetEventCarousel = function($scope, $) {

        var $eventCarousel = $scope.find('.bdt-event-calendar');

        if (!$eventCarousel.length) {
            return;
        }

        var $eventCarouselContainer = $eventCarousel.find('.swiper-container'),
            $settings = $eventCarousel.data('settings');
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($eventCarouselContainer, $settings);

            if ($settings.pauseOnHover) {
                $($eventCarouselContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }
        };

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-event-carousel.default', widgetEventCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-event-carousel.fable', widgetEventCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-event-carousel.altra', widgetEventCarousel);
    });

}(jQuery, window.elementorFrontend));

/**
 * End event calendar widget script
 */


/**
 * Start fancy tabs widget script
 */

(function($, elementor) {

    'use strict';

    var widgetFancyTabs = function($scope, $) {


        var $fancyTabs = $scope.find('.bdt-fancy-tabs'),
            $settings = $fancyTabs.data('settings');

        var iconBx = document.querySelectorAll('#' + $settings.tabs_id + ' .bdt-fancy-tabs-item');
        var contentBx = document.querySelectorAll('#' + $settings.tabs_id + ' .bdt-fancy-tabs-content');

        for (var i = 0; i < iconBx.length; i++) {
            iconBx[i].addEventListener($settings.mouse_event, function() {
                for (var i = 0; i < contentBx.length; i++) {
                    contentBx[i].className = 'bdt-fancy-tabs-content';
                }
                document.getElementById(this.dataset.id).className = 'bdt-fancy-tabs-content active';

                for (var i = 0; i < iconBx.length; i++) {
                    iconBx[i].className = 'bdt-fancy-tabs-item';
                }
                this.className = 'bdt-fancy-tabs-item active';

            });
        }

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-fancy-tabs.default', widgetFancyTabs);
    });

}(jQuery, window.elementorFrontend));

/**
 * End fancy tabs widget script
 */


/**
 * Start interactive tabs widget script
 */

 (function($, elementor) {

    'use strict';

    var widgetInteractiveTabs = function($scope, $) {

        var $slider = $scope.find('.bdt-content-wrap'),
            $tabs   = $scope.find('.bdt-interactive-tabs');

        if (!$slider.length) {
            return;
        }

        var $sliderContainer = $slider.find('.swiper-container'),
            $settings = $slider.data('settings'),
            $swiperId = $($settings.id).find('.swiper-container');

            const Swiper = elementorFrontend.utils.swiper;
            initSwiper();
            async function initSwiper() {
                var swiper = await new Swiper($swiperId, $settings);
                if ($settings.pauseOnHover) {
                    $($sliderContainer).hover(function () {
                        (this).swiper.autoplay.stop();
                    }, function () {
                        (this).swiper.autoplay.start();
                    });
                }
                // start video stop
                var stopVideos = function () {
                    var videos = document.querySelectorAll($settings.id + ' .bdt-i-tabs-iframe');
                    //console.log(videos);
                    Array.prototype.forEach.call(videos, function (video) {
                        var src = video.src;
                        // video.src = src.replace("?autoplay=1", "");
                        // video.src = src.replace("autoplay=1", "");
                        video.src = src;
                    });
                };
                // end video stop

                $tabs.find('.bdt-tabs-item').eq(swiper.realIndex).addClass('bdt-active');
                swiper.on('slideChange', function () {
                    $tabs.find('.bdt-tabs-item').removeClass('bdt-active');
                    $tabs.find('.bdt-tabs-item').eq(swiper.realIndex).addClass('bdt-active');
                    //console.log('changed today'); 


                    stopVideos();



                });

                $tabs.find('.bdt-tabs-wrap .bdt-tabs-item[data-slide]').on('click', function (e) {
                    e.preventDefault();
                    var slideno = $(this).data('slide');
                    swiper.slideTo(slideno + 1);
                });
            };


    };

  


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-interactive-tabs.default', widgetInteractiveTabs);
    });

}(jQuery, window.elementorFrontend));

/**
 * End interactive tabs widget script
 */


/**
 * Start fancy slider widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetFancySlider = function ($scope, $) {

        var $slider = $scope.find('.bdt-fancy-slider');

        if (!$slider.length) {
            return;
        }

        var $sliderContainer = $slider.find('.swiper-container'),
            $settings = $slider.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($sliderContainer, $settings);

            if ($settings.pauseOnHover) {
                $($sliderContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }
        };
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-fancy-slider.default', widgetFancySlider);
    });

}(jQuery, window.elementorFrontend));

/**
 * End fancy slider widget script
 */
/**
 * Start faq widget script
 */

(function($, elementor) { 
    'use strict';
    var widgetPostGallery = function($scope, $) {
        var $faqWrapper = $scope.find('.bdt-faq-wrapper'),
            $faqFilter = $faqWrapper.find('.bdt-ep-grid-filters-wrapper');
        if (!$faqFilter.length) {
            return;
        }
        var $settings = $faqFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler($faqFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($faqFilter).find('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').closest($faqFilter).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function() {
                        //#code
                    }).promise().then(function() {
                        $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function() {
                hashHandler($faqFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($faqFilter).find('.bdt-ep-grid-filter').off('click').on('click', function(event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $faqFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function(e) {
                hashHandler($faqFilter, hashScrollspyTime, hashTopOffset);
            });
        }
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-faq.default', widgetPostGallery);
    });
}(jQuery, window.elementorFrontend));

/**
 * End faq widget script
 */


/**
 * Start helpdesk widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetHelpDesk = function( $scope, $ ) {

		var $helpdesk = $scope.find( '.bdt-helpdesk' ),
            $helpdeskTooltip = $helpdesk.find('.bdt-helpdesk-icons');

        if ( ! $helpdesk.length ) {
            return;
        }
		
		var $tooltip = $helpdeskTooltip.find('> .bdt-tippy-tooltip'),
			widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-helpdesk.default', widgetHelpDesk );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End helpdesk widget script
 */
 
/**
 * Start hover box widget script
 */

(function($, elementor) {

    'use strict';

    var widgetHoverBox = function($scope, $) {


        var $hoverBox = $scope.find('.bdt-hover-box'),
            $settings = $hoverBox.data('settings');

        var iconBx = document.querySelectorAll('#' + $settings.box_id + ' .bdt-hover-box-item');
        var contentBx = document.querySelectorAll('#' + $settings.box_id + ' .bdt-hover-box-content');

        for (var i = 0; i < iconBx.length; i++) {
            iconBx[i].addEventListener($settings.mouse_event, function() {
                for (var i = 0; i < contentBx.length; i++) {
                    contentBx[i].className = 'bdt-hover-box-content'
                }
                document.getElementById(this.dataset.id).className = 'bdt-hover-box-content active';

                for (var i = 0; i < iconBx.length; i++) {
                    iconBx[i].className = 'bdt-hover-box-item';
                }
                this.className = 'bdt-hover-box-item active';

            })
        }

    };

    var widgetHoverBoxFlexure = function($scope, $) {
        var $hoverBoxFlexure = $scope.find('.bdt-hover-box'),
            $settings = $hoverBoxFlexure.data('settings');
            
       var iconBox = $($hoverBoxFlexure).find('.bdt-hover-box-item');

       $(iconBox).on($settings.mouse_event, function(){
        var target = $(this).attr('data-id');
        $('#'+target).siblings().removeClass('active');
        $('[data-id="' + target + '"]').siblings().removeClass('active');
        if($settings.mouse_event == 'click'){
            $('#'+target).toggleClass('active');
            $('[data-id="' + target + '"]').toggleClass('active');
            $('[data-id="' + target + '"]').siblings().addClass('invisiable');
            $($hoverBoxFlexure).find('.bdt-hover-box-item.invisiable').on('click', function(){
                $('[data-id="' + target + '"]').siblings().addClass('invisiable');
                $('[data-id="' + target + '"]').addClass('invisiable');
            });
            $($hoverBoxFlexure).find('.bdt-hover-box-item.active').on('click', function(){
                $('[data-id="' + target + '"]').siblings().removeClass('invisiable');
                $('[data-id="' + target + '"]').removeClass('invisiable');
            });

        }else{
            $('#'+target).addClass('active');
            $('[data-id="' + target + '"]').addClass('active');
            $('[data-id="' + target + '"]').siblings().addClass('invisiable');
        }
       });
       if($settings.mouse_event == 'mouseover'){
        $(iconBox).on('mouseleave', function(){
            var target = $(this).attr('data-id');
            $('#'+target).siblings().removeClass('active');
            $('#'+target).removeClass('active');
            $('[data-id="' + target + '"]').siblings().removeClass('active');
            $('[data-id="' + target + '"]').removeClass('active');
            $('[data-id="' + target + '"]').siblings().removeClass('invisiable');
        });
        }

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-box.default', widgetHoverBox);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-box.bdt-envelope', widgetHoverBox);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-box.bdt-flexure', widgetHoverBoxFlexure);
    });

}(jQuery, window.elementorFrontend));

/**
 * End hover box widget script
 */


/**
 * Start iconnav widget script
 */

( function( $, elementor ) {

	'use strict'; 

	var widgetIconNav = function( $scope, $ ) {

		var $iconnav        = $scope.find( 'div.bdt-icon-nav' ),
            $iconnavTooltip = $iconnav.find( '.bdt-icon-nav' );

        if ( ! $iconnav.length ) {
            return;
        }

		var $tooltip = $iconnavTooltip.find('> .bdt-tippy-tooltip'),
			widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-iconnav.default', widgetIconNav );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End iconnav widget script
 */


/**
 * Start iframe widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetIframe = function ($scope, $) {

        var $iframe = $scope.find('.bdt-iframe > iframe'),
            $autoHeight = $iframe.data('auto_height');

        if (!$iframe.length) {
            return;
        }

        // Auto height only works when cross origin properly set

        $($iframe).recliner({
            throttle: $iframe.data('throttle'),
            threshold: $iframe.data('threshold'),
            live: $iframe.data('live')
        });

        if ($autoHeight) {
            $(document).on('lazyshow', $iframe, function () {
                var height = jQuery($iframe).contents().find('html').height();
                jQuery($iframe).height(height);
            });

        }
    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-iframe.default', widgetIframe);
    });

}(jQuery, window.elementorFrontend));

/**
 * End iframe widget script
 */

/**
 * Start instagram widget script
 */
 
( function( $, elementor ) {

	'use strict';

	var widgetInstagram = function( $scope, $ ) {

		var $instagram = $scope.find( '.bdt-instagram' ),
            $settings  = $instagram.data('settings'),
            $loadMoreBtn = $instagram.find('.bdt-load-more');

        if ( ! $instagram.length ) {
            return;
        }
    
        var $currentPage = $settings.current_page;

        
        
        callInstagram();

        $($loadMoreBtn).on('click', function(event){
            
            if ($loadMoreBtn.length) {
                $loadMoreBtn.addClass('bdt-load-more-loading');
            }

            $currentPage++;
            $settings.current_page = $currentPage;

            callInstagram();
        });


        function callInstagram(){
            var $itemHolder = $instagram.find('.bdt-grid');

            jQuery.ajax({
                url: window.ElementPackConfig.ajaxurl,
                type:'post',
                data: $settings,
                success:function(response){
                    if($currentPage === 1){
                        // $itemHolder.html(response);	 
                        $itemHolder.append(response);	
                    } else {
                        $itemHolder.append(response);
                    }

                    if ($loadMoreBtn.length) {
                        $loadMoreBtn.removeClass('bdt-load-more-loading');
                    }

                }
            });
        }

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-instagram.default', widgetInstagram );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-instagram.bdt-instagram-carousel', widgetInstagram );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-instagram.bdt-classic-grid', widgetInstagram );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End instagram widget script
 */


/**
 * Start image compare widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetImageCompare = function( $scope, $ ) {
        var $image_compare_main = $scope.find('.bdt-image-compare');
        var $image_compare      = $scope.find('.image-compare');
        if ( !$image_compare.length ) {
            return;
        }

        var $settings        = $image_compare.data('settings');
        
        var 
        default_offset_pct   = $settings.default_offset_pct,
        orientation          = $settings.orientation,
        before_label         = $settings.before_label,
        after_label          = $settings.after_label,
        no_overlay           = $settings.no_overlay,
        on_hover             = $settings.on_hover,
        add_circle_blur      = $settings.add_circle_blur,
        add_circle_shadow    = $settings.add_circle_shadow,
        add_circle           = $settings.add_circle,
        smoothing            = $settings.smoothing,
        smoothing_amount     = $settings.smoothing_amount,
        bar_color            = $settings.bar_color,
        move_slider_on_hover = $settings.move_slider_on_hover;
      
        var viewers = document.querySelectorAll('#' + $settings.id);
  
        var options = {

            // UI Theme Defaults
            controlColor : bar_color,
            controlShadow: add_circle_shadow,
            addCircle    : add_circle,
            addCircleBlur: add_circle_blur,
          
            // Label Defaults
            showLabels   : no_overlay,
            labelOptions : {
              before       : before_label,
              after        : after_label,
              onHover      : on_hover
            },
          
            // Smoothing
            smoothing      : smoothing,
            smoothingAmount: smoothing_amount,
          
            // Other options
            hoverStart     : move_slider_on_hover,
            verticalMode   : orientation,
            startingPoint  : default_offset_pct,
            fluidMode      : false
          };

          viewers.forEach(function (element){
            var view = new ImageCompare(element, options).mount();
          });

	};

	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-image-compare.default', widgetImageCompare );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End image compare widget script
 */


/**
 * Start image magnifier widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetImageMagnifier = function( $scope, $ ) {

		var $imageMagnifier = $scope.find( '.bdt-image-magnifier' ),
            settings        = $imageMagnifier.data('settings'),
            magnifier       = $imageMagnifier.find('> .bdt-image-magnifier-image');

        if ( ! $imageMagnifier.length ) {
            return;
        }

        $(magnifier).ImageZoom(settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-image-magnifier.default', widgetImageMagnifier );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End image magnifier widget script
 */


/**
 * Start marker widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetMarker = function( $scope, $ ) {

		var $marker = $scope.find( '.bdt-marker-wrapper' );

        if ( ! $marker.length ) {
            return;
        }

		var $tooltip = $marker.find('> .bdt-tippy-tooltip'),
			widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-marker.default', widgetMarker );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End marker widget script
 */


/**
 * Start mailchimp widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetMailChimp = function( $scope, $ ) {

		var $mailChimp = $scope.find('.bdt-mailchimp');
			
        if ( ! $mailChimp.length ) {
            return;
        }

        var langStr = window.ElementPackConfig.mailchimp;

        $mailChimp.submit(function(){
            
            var mailchimpform = $(this);
            bdtUIkit.notification({message: '<span bdt-spinner></span> ' + langStr.subscribing, timeout: false, status: 'primary'});
            $.ajax({
                url:mailchimpform.attr('action'),
                type:'POST',
                data:mailchimpform.serialize(),
                success:function(data){
                    bdtUIkit.notification.closeAll();
                    bdtUIkit.notification({message: data, status: 'success'});
                    
                    // set local storage for coupon reveal
                    // localStorage.setItem("epCouponReveal", 'submitted');
                }
            });
            return false;

        });

        return false;

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-mailchimp.default', widgetMailChimp );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End mailchimp widget script
 */


/**
 * Start modal widget script
 */
(function ($, elementor) {

    'use strict';

    var widgetModal = function ($scope, $) {

        var $modal = $scope.find('.bdt-modal');

        if (!$modal.length) {
            return;
        }

        $.each($modal, function (index, val) {

            var $this = $(this),
                $settings = $this.data('settings'),
                modalShowed = false,
                modalID = $settings.id,
                displayTimes = $settings.displayTimes,
                scrollDirection = $settings.scrollDirection,
                scrollSelector = $settings.scrollSelector,
                scrollOffset = $settings.scrollOffset,
                splashInactivity = $settings.splashInactivity,
                closeBtnDelayShow = $settings.closeBtnDelayShow,
                delayTime = $settings.delayTime,
                splashDelay = $settings.splashDelay,
                widgetId = $settings.widgetId,
                layout = $settings.layout;
            var editMode = Boolean(elementor.isEditMode()),
                inactiveTime;

            var modal = {
                setLocalize: function () {
                    if (editMode) {
                        this.clearLocalize();
                        return;
                    }
                    // clear cache if user logged in
                    if ($('body').hasClass('logged-in')) {
                        this.clearLocalize();
                        return;
                    }
                    this.clearLocalize();
                    var widgetID = widgetId,
                        localVal = 0,
                        // hours = 4;
                        hours = $settings.displayTimesExpire;

                    var expires = (hours * 60 * 60);
                    var now = Date.now();
                    var schedule = now + expires * 1000;

                    if (localStorage.getItem(widgetID) === null) {
                        localStorage.setItem(widgetID, localVal);
                        localStorage.setItem(widgetID + '_expiresIn', schedule);
                    }
                    if (localStorage.getItem(widgetID) !== null) {
                        var count = parseInt(localStorage.getItem(widgetID));
                        count++;
                        localStorage.setItem(widgetID, count);
                        // this.clearLocalize();
                    }
                },
                clearLocalize: function () {
                    var localizeExpiry = parseInt(localStorage.getItem(widgetId + '_expiresIn'));
                    var now = Date.now(); //millisecs since epoch time, lets deal only with integer
                    var schedule = now;
                    if (schedule >= localizeExpiry) {
                        localStorage.removeItem(widgetId + '_expiresIn');
                        localStorage.removeItem(widgetId);
                    }
                },
                modalFire: function () {
                    if (layout == 'splash' || layout == 'exit' || layout == 'on_scroll') {
                        modal.setLocalize();
                        var firedNotify = parseInt(localStorage.getItem(widgetId));
                        if ((displayTimes !== false) && (firedNotify > displayTimes)) {
                            return;
                        }
                    }
                    bdtUIkit.modal($this).show();
                },
                closeBtnDelayShow: function () {
                    var $modal = $('#' + modalID);
                    $modal.find('#bdt-modal-close-button').hide(0);
                    $modal.on("shown", function () {
                            $('#bdt-modal-close-button').hide(0).fadeIn(delayTime);
                        })
                        .on("hide", function () {
                            $modal.find('#bdt-modal-close-button').hide(0);
                        });
                },
                customTrigger: function () {
                    var init = this;
                    $(modalID).on('click', function (event) {
                        event.preventDefault();
                        init.modalFire();
                    });
                },
                scrollDetect: function (fn) {
                    let last_scroll_position = 0;
                    let ticking = false;
                    window.addEventListener("scroll", function () {
                        let prev_scroll_position = last_scroll_position;
                        last_scroll_position = window.scrollY;
                        if (!ticking) {
                            window.requestAnimationFrame(function () {
                                fn(last_scroll_position, prev_scroll_position);
                                ticking = false;
                            });
                            ticking = true;
                        }
                    });
                },
                modalFireOnSelector: function () {
                    var init = this;
                    if (scrollDirection) {
                        $(window).on('scroll', function () {
                            var hT = $(scrollSelector).offset().top,
                                hH = $(scrollSelector).outerHeight(),
                                wH = $(window).height(),
                                wS = $(this).scrollTop();
                            var firedId = widgetId + '-fired';
                            if (wS > (hT + hH - wH)) {
                                if (!$(scrollSelector).hasClass(firedId)) {
                                    init.modalFire();
                                }
                                $(scrollSelector).addClass(firedId); // tricks added
                            }
                        });
                    }
                },
                onScroll: function () {
                    var init = this;
                    this.scrollDetect((scrollPos, previousScrollPos) => {
                        var wintop = $(window).scrollTop(),
                            docheight = $(document).height(),
                            winheight = $(window).height();
                        var scrolltrigger = scrollOffset / 100;
                        var firedId = widgetId + '-fired';
                        if ((previousScrollPos > scrollPos) && scrollDirection == 'up') {
                            if (!$('body').hasClass(firedId)) {
                                init.modalFire();
                                $('body').addClass(firedId);
                            }
                        } else if ((previousScrollPos < scrollPos) && scrollDirection == 'down' && previousScrollPos !== 0) {
                            if ((wintop / (docheight - winheight)) > scrolltrigger) {
                                if (!$('body').hasClass(firedId)) {
                                    init.modalFire();
                                    $('body').addClass(firedId);
                                }
                            }
                        } else if ((previousScrollPos < scrollPos) && scrollDirection == 'selector' && previousScrollPos !== 0) {
                            init.modalFireOnSelector();
                        }
                    });
                },
                exitPopup: function () {
                    var init = this;
                    document.addEventListener('mouseleave', function (event) {
                        if (
                            event.clientY <= 0 ||
                            event.clientX <= 0 ||
                            (event.clientX >= window.innerWidth || event.clientY >= window.innerHeight)
                        ) {
                            init.modalFire();
                        }
                    });
                },
                resetTimer: function () {
                    clearTimeout(inactiveTime);
                    inactiveTime = setTimeout(this.modalFire, splashInactivity); // time is in milliseconds
                },
                splashInactivity: function () {
                    window.onload = this.resetTimer();
                    window.onmousemove = this.resetTimer();
                    window.onmousedown = this.resetTimer(); // catches touchscreen presses as well      
                    window.ontouchstart = this.resetTimer(); // catches touchscreen swipes as well 
                    window.onclick = this.resetTimer(); // catches touchpad clicks as well
                    window.onkeydown = this.resetTimer();
                    window.addEventListener('scroll', this.resetTimer(), true); // improved; see comments
                },
                splashTiming: function () {
                    var init = this;
                    setTimeout(function () {
                        init.modalFire();
                    }, splashDelay);
                },
                splashInit: function () {
                    if (!splashInactivity) {
                        this.splashTiming();
                        return;
                    }
                    this.splashInactivity();
                },
                default: function () {
                    $(modalID).on('click', function (event) {
                        event.preventDefault();
                        this.modalFire();
                    });
                },
                init: function () {
                    var init = this;

                    if (layout == 'default') {
                        init.default();
                    }
                    if (layout == 'splash') {
                        init.splashInit();
                    }
                    if (layout == 'exit') {
                        init.exitPopup();
                    }
                    if (layout == 'on_scroll') {
                        init.onScroll();
                    }
                    if (layout == 'custom') {
                        init.customTrigger();
                    }
                    if (closeBtnDelayShow) {
                        init.closeBtnDelayShow();
                    }
                }
            };

            // kick off the modal
            modal.init();

            // append section as content

            if ($settings !== undefined && editMode === false && $settings.custom_section != false) {
                $($settings.modal_id).addClass('elementor elementor-' + $settings.pageID)
                var $modalContent = $('.elementor-section' + $settings.custom_section);
                var $modalBody = $($settings.modal_id).find('.bdt-modal-body');
                $($modalContent).appendTo($modalBody);
            }

        });
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-modal.default', widgetModal);
    });

}(jQuery, window.elementorFrontend));

/**
 * End modal widget script
 */

/**
 * Start news ticker widget script
 */

(function($) {
    "use strict";
    $.epNewsTicker = function(element, options) {

        var defaults = {
            effect         : 'fade',
            direction      : 'ltr',
            autoPlay       : false,
            interval       : 4000,
            scrollSpeed    : 2,
            pauseOnHover   : false,
            position       : 'auto',
            zIndex         : 99999
        }

        var ticker = this;
        ticker.settings = {};
        ticker._element = $(element);
        
        ticker._label            = ticker._element.children(".bdt-news-ticker-label"),
        ticker._news             = ticker._element.children(".bdt-news-ticker-content"),
        ticker._ul               = ticker._news.children("ul"),
        ticker._li               = ticker._ul.children("li"),
        ticker._controls         = ticker._element.children(".bdt-news-ticker-controls"),
        ticker._prev             = ticker._controls.find(".bdt-news-ticker-prev").parent(),
        ticker._action           = ticker._controls.find(".bdt-news-ticker-action").parent(),
        ticker._next             = ticker._controls.find(".bdt-news-ticker-next").parent();

        ticker._pause            = false;
        ticker._controlsIsActive = true;
        ticker._totalNews        = ticker._ul.children("li").length;
        ticker._activeNews       = 0;
        ticker._interval         = false;
        ticker._frameId          = null;

        /****************************************************/
        /**PRIVATE METHODS***********************************/
        /****************************************************/

        var setContainerWidth = function(){
            if (ticker._label.length > 0){
                if (ticker.settings.direction == 'rtl')
                    ticker._news.css({"right":ticker._label.outerWidth()});
                else
                    ticker._news.css({"left":ticker._label.outerWidth()});
            }

            if (ticker._controls.length > 0){
                var controlsWidth = ticker._controls.outerWidth();
                if (ticker.settings.direction == 'rtl')
                    ticker._news.css({"left":controlsWidth});
                else
                    ticker._news.css({"right":controlsWidth});
            }    

            if (ticker.settings.effect === 'scroll')
            {
                var totalW = 0;
                ticker._li.each(function(){
                    totalW += $(this).outerWidth();
                });
                totalW += 50;
                ticker._ul.css({'width':totalW});
            }
        }

        
        var startScrollAnimationLTR = function(){
            var _ulPosition = parseFloat(ticker._ul.css('marginLeft'));
            _ulPosition -= ticker.settings.scrollSpeed/2;
            ticker._ul.css({'marginLeft': _ulPosition });

            if (_ulPosition <= -ticker._ul.find('li:first-child').outerWidth())
            {
                ticker._ul.find('li:first-child').insertAfter(ticker._ul.find('li:last-child'));
                ticker._ul.css({'marginLeft': 0 });
            }
            if (ticker._pause === false){
                ticker._frameId = requestAnimationFrame(startScrollAnimationLTR);
                (window.requestAnimationFrame && ticker._frameId) || setTimeout(startScrollAnimationLTR, 16);
            }
        }

        var startScrollAnimationRTL = function(){
            var _ulPosition = parseFloat(ticker._ul.css('marginRight'));
            _ulPosition -= ticker.settings.scrollSpeed/2;
            ticker._ul.css({'marginRight': _ulPosition });

            if (_ulPosition <= -ticker._ul.find('li:first-child').outerWidth())
            {
                ticker._ul.find('li:first-child').insertAfter(ticker._ul.find('li:last-child'));
                ticker._ul.css({'marginRight': 0 });
            }
            if (ticker._pause === false)
                ticker._frameId = requestAnimationFrame(startScrollAnimationRTL);
                (window.requestAnimationFrame && ticker._frameId) || setTimeout(startScrollAnimationRTL, 16);
        }

        var scrollPlaying = function(){
            if (ticker.settings.direction === 'rtl')
            {
                if (ticker._ul.width() > ticker._news.width())
                    startScrollAnimationRTL();
                else
                	ticker._ul.css({'marginRight': 0 });
            }
            else
                if (ticker._ul.width() > ticker._news.width())
                    startScrollAnimationLTR();
                else
                	ticker._ul.css({'marginLeft': 0 });
        }
        
        var scrollGoNextLTR = function(){            
            ticker._ul.stop().animate({
                marginLeft : - ticker._ul.find('li:first-child').outerWidth()
            },300, function(){
                ticker._ul.find('li:first-child').insertAfter(ticker._ul.find('li:last-child'));
                ticker._ul.css({'marginLeft': 0 });
                ticker._controlsIsActive = true;
            });
        }

        var scrollGoNextRTL = function(){
            ticker._ul.stop().animate({
                marginRight : - ticker._ul.find('li:first-child').outerWidth()
            },300, function(){
                ticker._ul.find('li:first-child').insertAfter(ticker._ul.find('li:last-child'));
                ticker._ul.css({'marginRight': 0 });
                ticker._controlsIsActive = true;
            });
        }

        var scrollGoPrevLTR = function(){
            var _ulPosition = parseInt(ticker._ul.css('marginLeft'),10);
            if (_ulPosition >= 0)
            {
                ticker._ul.css({'margin-left' : -ticker._ul.find('li:last-child').outerWidth()});
                ticker._ul.find('li:last-child').insertBefore(ticker._ul.find('li:first-child'));                
            }

            ticker._ul.stop().animate({
                marginLeft : 0
            },300, function(){
                ticker._controlsIsActive = true;
            });
        }

        var scrollGoPrevRTL = function(){
            var _ulPosition = parseInt(ticker._ul.css('marginRight'),10);
            if (_ulPosition >= 0)
            {
                ticker._ul.css({'margin-right' : -ticker._ul.find('li:last-child').outerWidth()});
                ticker._ul.find('li:last-child').insertBefore(ticker._ul.find('li:first-child'));
            }

            ticker._ul.stop().animate({
                marginRight : 0
            },300, function(){
                ticker._controlsIsActive = true;
            });
        }

        var scrollNext = function(){
            if (ticker.settings.direction === 'rtl')
                scrollGoNextRTL();
            else
                scrollGoNextLTR();
        }

        var scrollPrev = function(){
            if (ticker.settings.direction === 'rtl')
                scrollGoPrevRTL();
            else
                scrollGoPrevLTR();
        }

        var effectTypography = function(){
            ticker._ul.find('li').hide();
            ticker._ul.find('li').eq(ticker._activeNews).width(30).show();
            ticker._ul.find('li').eq(ticker._activeNews).animate({
                width: '100%',
                opacity : 1
            },1500);
        }

        var effectFade = function(){
            ticker._ul.find('li').hide();
            ticker._ul.find('li').eq(ticker._activeNews).fadeIn();
        }

        var effectSlideDown = function(){
            if (ticker._totalNews <= 1)
            {
                 ticker._ul.find('li').animate({
                    'top':30,
                    'opacity':0
                },300, function(){
                    $(this).css({
                        'top': -30,
                        'opacity' : 0,
                        'display': 'block'
                    })
                    $(this).animate({
                        'top': 0,
                        'opacity' : 1
                    },300);
                });
            }   
            else
            {   
                ticker._ul.find('li:visible').animate({
                    'top':30,
                    'opacity':0
                },300, function(){
                    $(this).hide();
                });

                ticker._ul.find('li').eq(ticker._activeNews).css({
                    'top': -30,
                    'opacity' : 0
                }).show();

                ticker._ul.find('li').eq(ticker._activeNews).animate({
                    'top': 0,
                    'opacity' : 1
                },300);
            }
        }

        var effectSlideUp = function(){
            if (ticker._totalNews <= 1)
            {
                 ticker._ul.find('li').animate({
                    'top':-30,
                    'opacity':0
                },300, function(){
                    $(this).css({
                        'top': 30,
                        'opacity' : 0,
                        'display': 'block'
                    })
                    $(this).animate({
                        'top': 0,
                        'opacity' : 1
                    },300);
                });
            }   
            else
            {   
                ticker._ul.find('li:visible').animate({
                    'top':-30,
                    'opacity':0
                },300, function(){
                    $(this).hide();
                });

                ticker._ul.find('li').eq(ticker._activeNews).css({
                    'top': 30,
                    'opacity' : 0
                }).show();

                ticker._ul.find('li').eq(ticker._activeNews).animate({
                    'top': 0,
                    'opacity' : 1
                },300);
            }
        }

        var effectSlideRight = function(){  
            if (ticker._totalNews <= 1)
            {
                 ticker._ul.find('li').animate({
                    'left':'50%',
                    'opacity':0
                },300, function(){
                    $(this).css({
                        'left': -50,
                        'opacity' : 0,
                        'display': 'block'
                    })
                    $(this).animate({
                        'left': 0,
                        'opacity' : 1
                    },300);
                });
            }   
            else
            {       
                ticker._ul.find('li:visible').animate({
                    'left':'50%',
                    'opacity':0
                },300, function(){
                    $(this).hide();
                });

                ticker._ul.find('li').eq(ticker._activeNews).css({
                    'left': -50,
                    'opacity' : 0
                }).show();

                ticker._ul.find('li').eq(ticker._activeNews).animate({
                    'left': 0,
                    'opacity' : 1
                },300);
            }
        }

        var effectSlideLeft = function(){
            if (ticker._totalNews <= 1)
            {
                 ticker._ul.find('li').animate({
                    'left':'-50%',
                    'opacity':0
                },300, function(){
                    $(this).css({
                        'left': '50%',
                        'opacity' : 0,
                        'display': 'block'
                    })
                    $(this).animate({
                        'left': 0,
                        'opacity' : 1
                    },300);
                });
            }   
            else
            {   
                ticker._ul.find('li:visible').animate({
                    'left':'-50%',
                    'opacity':0
                },300, function(){
                    $(this).hide();
                });

                ticker._ul.find('li').eq(ticker._activeNews).css({
                    'left': '50%',
                    'opacity' : 0
                }).show();

                ticker._ul.find('li').eq(ticker._activeNews).animate({
                    'left': 0,
                    'opacity' : 1
                },300);
            }
        }


        var showThis = function(){            
            ticker._controlsIsActive = true;

            switch (ticker.settings.effect){
                case 'typography':
                    effectTypography();
                    break;
                case 'fade':
                    effectFade();
                    break;
                case 'slide-down':
                    effectSlideDown();
                    break;
                case 'slide-up':
                    effectSlideUp();
                    break;
                case 'slide-right':
                    effectSlideRight();
                    break;
                case 'slide-left':
                    effectSlideLeft();
                    break;
                default:
                    ticker._ul.find('li').hide();
                    ticker._ul.find('li').eq(ticker._activeNews).show();
            }
            
        }

        var nextHandler = function(){
            switch (ticker.settings.effect){
                case 'scroll':
                    scrollNext();
                    break;
                default:
                    ticker._activeNews++;
                    if (ticker._activeNews >= ticker._totalNews)
                        ticker._activeNews = 0;

                    showThis();
                    
            }
        }

        var prevHandler = function(){
            switch (ticker.settings.effect){
                case 'scroll':
                    scrollPrev();
                    break;
                default:
                    ticker._activeNews--;
                    if (ticker._activeNews < 0)
                        ticker._activeNews = ticker._totalNews-1;
                    
                    showThis();
            }
        }

        var playHandler = function(){
            ticker._pause = false;
            if (ticker.settings.autoPlay)
            {
                switch (ticker.settings.effect){
                    case 'scroll':
                        scrollPlaying();
                        break;
                    default:
                        ticker.pause();
                        ticker._interval = setInterval(function(){
                            ticker.next();
                        },ticker.settings.interval);
                }
            }
        }

        var resizeEvent = function(){
            if (ticker._element.width() < 480){
                ticker._label.hide();
                if (ticker.settings.direction == 'rtl')
                    ticker._news.css({"right":0});
                else
                    ticker._news.css({"left":0});
            }
            else{
                ticker._label.show();
                if (ticker.settings.direction == 'rtl')
                    ticker._news.css({"right":ticker._label.outerWidth()});
                else
                    ticker._news.css({"left":ticker._label.outerWidth()});
            }
        }

        /****************************************************/
        /**PUBLIC METHODS************************************/
        /****************************************************/
        ticker.init = function() {
            ticker.settings = $.extend({}, defaults, options);

            //ticker._element.append('<div class="bdt-breaking-loading"></div>');
            //window.onload = function(){

            	//ticker._element.find('.bdt-breaking-loading').hide();

	            //adding effect type class
	            ticker._element.addClass('bdt-effect-'+ticker.settings.effect+' bdt-direction-'+ticker.settings.direction);
	            
	            setContainerWidth();

                if (ticker.settings.effect != 'scroll')
                    showThis();

                playHandler();

	            //set playing status class
	            if (!ticker.settings.autoPlay)
	                ticker._action.find('span').removeClass('bdt-news-ticker-pause').addClass('bdt-news-ticker-play');
	            else
	                ticker._action.find('span').removeClass('bdt-news-ticker-play').addClass('bdt-news-ticker-pause');


	            ticker._element.on('mouseleave', function(e){                
	                var activePosition = $(document.elementFromPoint(e.clientX, e.clientY)).parents('.bdt-breaking-news')[0];
	                if ($(this)[0] === activePosition) {
	                    return;
	                }
	                

	                if (ticker.settings.pauseOnHover === true)
	                {
	                    if (ticker.settings.autoPlay === true)
	                        ticker.play();
	                }
	                else
	                {
	                    if (ticker.settings.autoPlay === true && ticker._pause === true)
	                        ticker.play();
	                }                

	            });

	            ticker._element.on('mouseenter', function(){
	                if (ticker.settings.pauseOnHover === true)
	                    ticker.pause();
	            });

	            ticker._next.on('click', function(){
	                if (ticker._controlsIsActive){
	                    ticker._controlsIsActive = false;
	                    ticker.pause();
	                    ticker.next();
	                }                
	            });

	            ticker._prev.on('click', function(){
	                if (ticker._controlsIsActive){
	                    ticker._controlsIsActive = false;
	                    ticker.pause();
	                    ticker.prev();
	                } 
	            });

	            ticker._action.on('click', function(){
	                if (ticker._controlsIsActive){
	                    if (ticker._action.find('span').hasClass('bdt-news-ticker-pause'))
	                    {
	                        ticker._action.find('span').removeClass('bdt-news-ticker-pause').addClass('bdt-news-ticker-play');
	                        ticker.stop();
	                    }
	                    else
	                    {
	                        ticker.settings.autoPlay = true;
	                        ticker._action.find('span').removeClass('bdt-news-ticker-play').addClass('bdt-news-ticker-pause');
	                        //ticker._pause = false;
	                    }
	                } 
	            });

	            resizeEvent();
	        //}

            $(window).on('resize', function(){
                resizeEvent();
                ticker.pause();
                ticker.play();
            });

        }

        ticker.pause = function() {
            ticker._pause = true;
            clearInterval(ticker._interval);
            cancelAnimationFrame(ticker._frameId);
        }

        ticker.stop = function() {
            ticker._pause = true;
            ticker.settings.autoPlay = false;
        }

        ticker.play = function() {
            playHandler();
        }

        ticker.next = function() {
            nextHandler();
        }

        ticker.prev = function() {
            prevHandler();
        }
        /****************************************************/
        /****************************************************/
        /****************************************************/
        ticker.init();

    }

    $.fn.epNewsTicker = function(options) {

        return this.each(function() {
            if (undefined == $(this).data('epNewsTicker')) {
                var ticker = new $.epNewsTicker(this, options);
                $(this).data('epNewsTicker', ticker);
            }
        });

    }

})(jQuery);



( function( $, elementor ) {

	'use strict';

	var widgetNewsTicker = function( $scope, $ ) {

		var $newsTicker = $scope.find('.bdt-news-ticker'),
            $settings = $newsTicker.data('settings');

        if ( ! $newsTicker.length ) {
            return;
        }

        $($newsTicker).epNewsTicker($settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-news-ticker.default', widgetNewsTicker );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End news ticker widget script
 */


/**
 * Start offcanvas widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetOffcanvas = function( $scope, $ ) {

		var $offcanvas = $scope.find( '.bdt-offcanvas' );
			
        if ( ! $offcanvas.length ) {
            return;
        }


        $.each($offcanvas, function(index, val) {
            
            var $this   	= $(this),
                $settings   = $this.data('settings'),
                offcanvasID = $settings.id;
            
            if ( $(offcanvasID).length ) {
                // global custom link for a tag
                $(offcanvasID).on('click', function(event){
                    event.preventDefault();       
                    bdtUIkit.offcanvas( $this ).show();
                });
            }

        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-offcanvas.default', widgetOffcanvas );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End offcanvas widget script
 */


/**
 * Start scrollnav widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetScrollNav = function( $scope, $ ) {

		var $scrollnav = $scope.find( '.bdt-dotnav > li' );

        if ( ! $scrollnav.length ) {
            return;
        }

		var $tooltip = $scrollnav.find('> .bdt-tippy-tooltip'),
			widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-scrollnav.default', widgetScrollNav );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End scrollnav widget script
 */


/**
 * Start post gallery widget script
 */

(function ($, elementor) {
    'use strict';
    // PostGallery
    var widgetPostGallery = function ($scope, $) {
        var $postGalleryWrapper = $scope.find('.bdt-post-gallery-wrapper'),
            $bdtPostGallery     = $scope.find('.bdt-post-gallery'),
            $settings           = $bdtPostGallery.data('settings'),
            $postFilter         = $postGalleryWrapper.find('.bdt-ep-grid-filters-wrapper');

        if (!$postGalleryWrapper.length) {
            return;
        }

        if ($settings.tiltShow == true) {
            var elements = document.querySelectorAll($settings.id + " [data-tilt]");
            VanillaTilt.init(elements);
        }


        if (!$postFilter.length) {
            return;
        }
        var $settings = $postFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler($postFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($postFilter).find('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').closest($postFilter).attr('id');

                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function () {
                        //#code
                    }).promise().then(function () {
                        $('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function () {
                hashHandler($postFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($postFilter).find('.bdt-ep-grid-filter').off('click').on('click', function (event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $postFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function (e) {
                hashHandler($postFilter, hashScrollspyTime, hashTopOffset);
            });
        }
    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.default', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-abetis', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-fedara', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-trosia', widgetPostGallery);
    });
}(jQuery, window.elementorFrontend));

/**
 * End post gallery widget script
 */
/**
 * Start portfolio gallery widget script
 */

(function ($, elementor) {
    'use strict';
    // PortfolioGallery
    var widgetPortfolioGallery = function ($scope, $) {
        var $portfolioGalleryWrapper = $scope.find('.bdt-portfolio-gallery-wrapper'),
            $settings = $portfolioGalleryWrapper.data('settings'),
            $portfolioFilter = $portfolioGalleryWrapper.find('.bdt-ep-grid-filters-wrapper');

        if (!$portfolioGalleryWrapper.length) {
            return;
        }

        if ($settings.tiltShow == true) {
            var elements = document.querySelectorAll($settings.id + " [data-tilt]");
            VanillaTilt.init(elements);
        }

        if (!$portfolioFilter.length) {
            return;
        }
        var $settings = $portfolioFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler($portfolioFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($portfolioFilter).find('[bdt-filter-control="[data-filter*=\'bdtp-' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'bdtp-' + window.location.hash.substring(1) + '\']"]').closest($portfolioFilter).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function () {
                        //#code
                    }).promise().then(function () {
                        $('[bdt-filter-control="[data-filter*=\'bdtp-' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function () {
                hashHandler($portfolioFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($portfolioFilter).find('.bdt-ep-grid-filter').off('click').on('click', function (event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $portfolioFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function (e) {
                hashHandler($portfolioFilter, hashScrollspyTime, hashTopOffset);
            });
        }


        //filter item count
        var categories = {},
            category;

        var arr = [];
        var totalItem = 0;
        $($portfolioGalleryWrapper).find(".bdt-portfolio-gallery div[data-filter]").each(function (i, el) {
            category = $(el).data("filter");
            let list = category.split(/\s+/);
            $(list).each(function (i, el) {
                arr.push(el);
            });
            totalItem = totalItem + 1;
        });

        var counts = {};
        arr.forEach(function (x) {
            counts[x] = (counts[x] || 0) + 1;
        });
        //print total item result
        $($portfolioGalleryWrapper).find('.bdt-all-count').text(totalItem);
        // print results
        for (var key in counts) {
            $($portfolioGalleryWrapper).find('[data-bdt-target=' + key + '] .bdt-count').text(counts[key]);
        }


    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-gallery.default', widgetPortfolioGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-gallery.bdt-abetis', widgetPortfolioGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-gallery.bdt-fedara', widgetPortfolioGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-gallery.bdt-trosia', widgetPortfolioGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-gallery.bdt-janes', widgetPortfolioGallery);
    });
}(jQuery, window.elementorFrontend));

/**
 * End portfolio gallery widget script
 */
/**
 * Start post grid tab widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetPostGridTab = function( $scope, $ ) {

		var $postGridTab = $scope.find( '.bdt-post-grid-tab' ),
			gridTab      = $postGridTab.find('.gridtab');

		if ( ! $postGridTab.length ) {
			return;
		}

		$(gridTab).gridtab($postGridTab.data('settings'));

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-post-grid-tab.default', widgetPostGridTab );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End post grid tab widget script
 */

 
/**
 * Start price table widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetPriceTable = function( $scope, $ ) {

		var $priceTable = $scope.find( '.bdt-price-table' ),
            $featuresList = $priceTable.find( '.bdt-price-table-feature-inner' );

        if ( ! $priceTable.length ) {
            return;
        }

        var $tooltip = $featuresList.find('> .bdt-tippy-tooltip'),
        	widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

    };
    

	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-price-table.default', widgetPriceTable );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-price-table.bdt-partait', widgetPriceTable );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End price table widget script
 */


/**
 * Start progress pie widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetProgressPie = function( $scope, $ ) {

		var $progressPie = $scope.find( '.bdt-progress-pie' );

        if ( ! $progressPie.length ) {
            return;
        }

        elementorFrontend.waypoint( $progressPie, function() {
            var $this = $( this );
            
                $this.asPieProgress({
                    namespace: 'pieProgress',
                    classes: {
                        svg     : 'bdt-progress-pie-svg',
                        number  : 'bdt-progress-pie-number',
                        content : 'bdt-progress-pie-content'
                    }
                });
                
                $this.asPieProgress('start');

        }, {
            offset: 'bottom-in-view'
        } );

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-progress-pie.default', widgetProgressPie );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End progress pie widget script
 */


/**
 * Start comment widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetComment = function( $scope, $ ) {

		var $comment = $scope.find( '.bdt-comment-container' ),
            $settings = $comment.data('settings');
            
        if ( ! $comment.length ) {
            return;
        }

        if ($settings.layout === 'disqus') {

            var disqus_config = function () {
            this.page.url = $settings.permalink;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = $comment; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            
            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//' + $settings.username + '.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();

        } else if ($settings.layout === 'facebook') {
            
            //var $fb_script = document.getElementById("facebook-jssdk");

            //console.log($fb_script);

            // if($fb_script){
            // 	$($fb_script).remove();
            // } else {
            // }

            // jQuery.ajax({
            // 	url: 'https://connect.facebook.net/en_US/sdk.js',
            // 	dataType: 'script',
            // 	cache: true,
            // 	success: function() {
            // 		FB.init( {
            // 			appId: config.app_id,
            // 			version: 'v2.10',
            // 			xfbml: false
            // 		} );
            // 		config.isLoaded = true;
            // 		config.isLoading = false;
            // 		jQuery( document ).trigger( 'fb:sdk:loaded' );
            // 	}
            // });
            // 
            // 
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
                

            window.fbAsyncInit = function() {
                FB.init({
                    appId            : $settings.app_id,
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v3.2'
                });
            };

        }

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-comment.default', widgetComment );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End comment widget script
 */


/**
 * Start qrcode widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetQRCode = function( $scope, $ ) {

		var $qrcode = $scope.find( '.bdt-qrcode' ),
            image   = $scope.find( '.bdt-qrcode-image' );

        if ( ! $qrcode.length ) {
            return;
        }
        var settings = $qrcode.data('settings');
            settings.image = image[0];

        $($qrcode).qrcode(settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-qrcode.default', widgetQRCode );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End qrcode widget script
 */


$window.on('elementor/frontend/init', function () {

    var ModuleHandler = elementorModules.frontend.handlers.Base, BarCode;


    BarCode = ModuleHandler.extend({
        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                format: 'code128',
            };
        },

        onElementChange: debounce(function (prop) {
            if (prop.indexOf('ep_barcode') !== -1) {
                this.run();
            }
        }, 400),

        settings: function (key) {
            return this.getElementSettings('ep_barcode_' + key);
        },

        run: function () {

            var options = this.getDefaultSettings();
            var element = this.findElement('.elementor-widget-container').get(0);
            if (jQuery(this.$element).hasClass('elementor-section')) {
                element = this.$element.get(0);
            }
            var $container = this.$element.find(".bdt-barcode");
            if (!$container.length) {
                return;
            }

            var content = this.settings('content');
            options.displayValue = (this.settings('show_label') === 'yes');
            options.format = this.settings('format');
            options.text = (this.settings('label_text')) ? this.settings('label_text') : '';
            options.width = (this.settings('width.size')) ? this.settings('width.size') : 2;
            options.height = (this.settings('height.size')) ? this.settings('height.size') : 40;
            options.fontOptions = (this.settings('font_width')) ? this.settings('font_width') : 'normal';
            options.textAlign = (this.settings('label_alignment')) ? this.settings('label_alignment') : 'center';
            options.textPosition = (this.settings('label_position')) ? this.settings('label_position') : 'bottom';
            options.textMargin = (this.settings('label_spacing.size')) ? this.settings('label_spacing.size') : 2;
            options.margin = 0;

            JsBarcode('#bdt-barcode-' + this.$element.data('id'), content, options);

        }
    });


    elementorFrontend.hooks.addAction(
        'frontend/element_ready/bdt-barcode.default',
        function ($scope) {
            elementorFrontend.elementsHandler.addHandler(BarCode, {
                $element: $scope,
            });
        }
    );
});
/**
 * Start table widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTable = function( $scope, $ ) {

		var $tableContainer = $scope.find( '.bdt-data-table' ),
            $settings       = $tableContainer.data('settings'),
            $table          = $tableContainer.find('> table');

        if ( ! $tableContainer.length ) {
            return;
        }

        $settings.language = window.ElementPackConfig.data_table.language;

        $($table).DataTable($settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-table.default', widgetTable );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End table widget script
 */


/**
 * Start table of content widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTableOfContent = function( $scope, $ ) {

		var $tableOfContent = $scope.find( '.bdt-table-of-content' );
				
        if ( ! $tableOfContent.length ) {
            return;
        }			

        $($tableOfContent).tocify($tableOfContent.data('settings'));

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-table-of-content.default', widgetTableOfContent );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End table of content widget script
 */


/**
 * Start tabs widget script
 */

(function ($, elementor) {
    'use strict';
    var widgetTabs = function ($scope, $) {
        var $tabsArea = $scope.find('.bdt-tabs-area'),
            $tabs = $tabsArea.find('.bdt-tabs'),
            $tab = $tabs.find('.bdt-tab');
        if (!$tabsArea.length) {
            return;
        }
        var $settings = $tabs.data('settings');
        var animTime = $settings.hashScrollspyTime;
        var customOffset = $settings.hashTopOffset;
        var navStickyOffset = $settings.navStickyOffset;
        if (navStickyOffset == 'undefined') {
            navStickyOffset = 10;
        }


        function hashHandler($tabs, $tab, animTime, customOffset) {
            // debugger;
            if (window.location.hash) {
                if ($($tabs).find('[data-title="' + window.location.hash.substring(1) + '"]').length) {
                    var hashTarget = $('[data-title="' + window.location.hash.substring(1) + '"]').closest($tabs).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - customOffset
                    }, animTime, function () {
                        //#code
                    }).promise().then(function () {
                        bdtUIkit.tab($tab).show($('[data-title="' + window.location.hash.substring(1) + '"]').data('tab-index'));
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes' && $settings.status != 'bdt-sticky-custom') {
            $(window).on('load', function () {
                hashHandler($tabs, $tab, animTime, customOffset);
            });
            $($tabs).find('.bdt-tabs-item-title').off('click').on('click', function (event) {
                window.location.hash = ($.trim($(this).attr('data-title')));
            });
            $(window).on('hashchange', function (e) {
                hashHandler($tabs, $tab, animTime, customOffset);
            });
        }
        //# code for sticky and also for sticky with hash
        function stickyHachChange($tabs, $tab, navStickyOffset) {
            if ($($tabs).find('[data-title="' + window.location.hash.substring(1) + '"]').length) {
                var hashTarget = $('[data-title="' + window.location.hash.substring(1) + '"]').closest($tabs).attr('id');
                $('html, body').animate({
                    easing: 'slow',
                    scrollTop: $('#' + hashTarget).offset().top - navStickyOffset
                }, 1000, function () {
                    //#code
                }).promise().then(function () {
                    bdtUIkit.tab($tab).show($($tab).find('[data-title="' + window.location.hash.substring(1) + '"]').data('tab-index'));
                });
            }
        }
        if ($settings.status == 'bdt-sticky-custom') {
            $($tabs).find('.bdt-tabs-item-title').bind().click('click', function (event) {
                if ($settings.activeHash == 'yes') {
                    window.location.hash = ($.trim($(this).attr('data-title')));
                } else {
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $($tabs).offset().top - navStickyOffset
                    }, 500, function () {
                        //#code
                    });
                }
            });
            // # actived Hash#
            if ($settings.activeHash == 'yes' && $settings.status == 'bdt-sticky-custom') {
                $(window).on('load', function () {
                    if (window.location.hash) {
                        stickyHachChange($tabs, $tab, navStickyOffset);
                    }
                });
                $(window).on('hashchange', function (e) {
                    stickyHachChange($tabs, $tab, navStickyOffset);
                });
            }
        }

        // start linkWidget
        var editMode = Boolean(elementor.isEditMode());
        var $linkWidget = $settings['linkWidgetSettings'],
            $activeItem = ($settings['activeItem']) - 1;
        if ($linkWidget !== undefined && editMode === false) {

            $linkWidget.forEach(function (entry, index) {
 
                if (index == 0) {
                    $('#bdt-tab-content-'+$settings['linkWidgetId']).parent().remove();
                    $(entry).parent().wrapInner('<div class="bdt-switcher-wrapper" />');
                    $(entry).parent().wrapInner('<div id="bdt-tab-content-'+$settings['linkWidgetId']+'" class="bdt-switcher bdt-switcher-item-content" />');
                    
                    if($settings['activeItem'] == undefined){
                        $(entry).addClass('bdt-active');
                    } 
                } 
                 
                if($settings['activeItem'] !== undefined && index == $activeItem){
                    $(entry).addClass('bdt-active');
                }

                $(entry).attr('data-content-id', "tab-" + (index + 1));

            });

        }
        // end linkWidget


    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tabs.default', widgetTabs);
    });
}(jQuery, window.elementorFrontend));

/**
 * End tabs widget script
 */



/**
 * Start timeline widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTimeline = function( $scope, $ ) {

		var $timeline = $scope.find( '.bdt-timeline-skin-olivier' );
				
        if ( ! $timeline.length ) {
            return;
        }

        $($timeline).timeline({
            visibleItems : $timeline.data('visible_items'),
        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-timeline.bdt-olivier', widgetTimeline );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End timeline widget script
 */


/**
 * Start testimonial carousel widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTCarousel = function( $scope, $ ) {

		var $tCarousel = $scope.find( '.bdt-testimonial-carousel' );
            
        if ( ! $tCarousel.length ) {
            return;
        }

		var $tCarouselContainer = $tCarousel.find('.swiper-container'),
			$settings 		 = $tCarousel.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($tCarouselContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($tCarouselContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-carousel.default', widgetTCarousel );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-carousel.bdt-twyla', widgetTCarousel );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-carousel.bdt-vyxo', widgetTCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End testimonial carousel widget script
 */


/**
 * Start testimonial slider widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetCustomCarousel = function( $scope, $ ) {

		var $carousel = $scope.find( '.bdt-testimonial-slider' );
				
        if ( ! $carousel.length ) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
			$settings 		 = $carousel.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($carouselContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($carouselContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-slider.default', widgetCustomCarousel );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-slider.bdt-single', widgetCustomCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End testimonial slider widget script
 */


/**
 * Start toggle widget script
 */

(function ($, elementor) {
    'use strict';
    var widgetToggle = function ($scope, $) {
        var $toggleContainer = $scope.find('.bdt-show-hide-container');
        var $toggle          = $toggleContainer.find('.bdt-show-hide');

        if ( !$toggleContainer.length ) {
            return;
        } 
        var $settings            = $toggle.data('settings');
        var toggleId             = $settings.id;
        var animTime             = $settings.scrollspy_time;
        var scrollspy_top_offset = $settings.scrollspy_top_offset;

        var by_widget_selector_status = $settings.by_widget_selector_status;
        var toggle_initially_open     = $settings.toggle_initially_open;
        var source_selector           = $settings.source_selector;
        var widget_visibility         = $settings.widget_visibility;
        var widget_visibility_tablet  = $settings.widget_visibility_tablet;
        var widget_visibility_mobile  = $settings.widget_visibility_mobile;
        var viewport_lg               = $settings.viewport_lg;
        var viewport_md               = $settings.viewport_md;

        var widget_visibility_filtered = widget_visibility;

        if ( $settings.widget_visibility == 'undefined' || $settings.widget_visibility == null ) {
            widget_visibility_filtered = widget_visibility = 0;
        }

        if ( $settings.widget_visibility_tablet == 'undefined' || $settings.widget_visibility_tablet == null ) {
            widget_visibility_tablet = widget_visibility;
        }

        if ( $settings.widget_visibility_mobile == 'undefined' || $settings.widget_visibility_mobile == null ) {
            widget_visibility_mobile = widget_visibility;
        }

        function widgetVsibleFiltered() {
            if ( (window.outerWidth) > (viewport_lg) ) {
                widget_visibility_filtered = widget_visibility;
            } else if ( (window.outerWidth) > (viewport_md) ) {
                widget_visibility_filtered = widget_visibility_tablet;
            } else {
                widget_visibility_filtered = widget_visibility_mobile;
            }
        }

        $(window).resize(function () {
            widgetVsibleFiltered();
        });


        function scrollspyHandler($toggle, toggleId, toggleBtn, animTime, scrollspy_top_offset) {
            if ( $settings.status_scrollspy === 'yes' && by_widget_selector_status !== 'yes' ) {
                if ( $($toggle).find('.bdt-show-hide-item') ) {
                    if ( $settings.hash_location === 'yes' ) {
                        window.location.hash = ($.trim(toggleId));
                    }
                    var scrollspyWrapper = $('#bdt-show-hide-' + toggleId).find('.bdt-show-hide-item');
                    $('html, body').animate({
                        easing   : 'slow',
                        scrollTop: $(scrollspyWrapper).offset().top - scrollspy_top_offset
                    }, animTime, function () {
                        //#code
                    }).promise().then(function () {
                        $(toggleBtn).siblings('.bdt-show-hide-content').slideToggle('slow', function () {
                            $(toggleBtn).parent().toggleClass('bdt-open');
                        });
                    });
                }
            } else {
                if ( by_widget_selector_status === 'yes' ) {
                    $(toggleBtn).parent().toggleClass('bdt-open');
                    $(toggleBtn).siblings('.bdt-show-hide-content').slideToggle('slow', function () {
                    });
                }else{
                    $(toggleBtn).siblings('.bdt-show-hide-content').slideToggle('slow', function () {
                        $(toggleBtn).parent().toggleClass('bdt-open');
                    });
                }
                
            }
        }

        $($toggle).find('.bdt-show-hide-title').off('click').on('click', function (event) {
            var toggleBtn = $(this);
            scrollspyHandler($toggle, toggleId, toggleBtn, animTime, scrollspy_top_offset);
        });

        function hashHandler() {
            toggleId             = window.location.hash.substring(1);
            var toggleBtn        = $('#bdt-show-hide-' + toggleId).find('.bdt-show-hide-title');
            var scrollspyWrapper = $('#bdt-show-hide-' + toggleId).find('.bdt-show-hide-item');
            $('html, body').animate({
                easing   : 'slow',
                scrollTop: $(scrollspyWrapper).offset().top - scrollspy_top_offset
            }, animTime, function () {
                //#code
            }).promise().then(function () {
                $(toggleBtn).siblings('.bdt-show-hide-content').slideToggle('slow', function () {
                    $(toggleBtn).parent().toggleClass('bdt-open');
                });
            });
        }

        $(window).on('load', function () {
            if ( $($toggleContainer).find('#bdt-show-hide-' + window.location.hash.substring(1)).length != 0 ) {
                if ( $settings.hash_location === 'yes' ) {
                    hashHandler();
                }
            }
        });

        /* Function to animate height: auto */
        function autoHeightAnimate(element, time){
    var curHeight = element.height(), // Get Default Height
        autoHeight = element.css('height', 'auto').height(); // Get Auto Height
          element.height(curHeight); // Reset to Default Height
          element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
      }
      function byWidgetHandler() {
        if ( $settings.status_scrollspy === 'yes' ) {
            $('html, body').animate({
                easing   : 'slow',
                scrollTop: $(source_selector).offset().top - scrollspy_top_offset
            }, animTime, function () {
                    //#code
                }).promise().then(function () {
                    if ( $(source_selector).hasClass('bdt-fold-close') ) {
                        // $(source_selector).css({
                        //     'max-height': '100%'
                        // }).removeClass('bdt-fold-close toggle_initially_open').addClass('bdt-fold-open');
                        $(source_selector).removeClass('bdt-fold-close toggle_initially_open').addClass('bdt-fold-open');
                        autoHeightAnimate($(source_selector), 500);
                    } else {
                        $(source_selector).css({
                            'height': widget_visibility_filtered + 'px'
                        }).addClass('bdt-fold-close').removeClass('bdt-fold-open');
                    }
                });
            } else {
                if ( $(source_selector).hasClass('bdt-fold-close') ) {
                    // $(source_selector).css({
                    //     'max-height': '100%'
                    // }).removeClass('bdt-fold-close toggle_initially_open').addClass('bdt-fold-open');
                    $(source_selector).removeClass('bdt-fold-close toggle_initially_open').addClass('bdt-fold-open');
                    autoHeightAnimate($(source_selector), 500);

                } else {
                    $(source_selector).css({
                        'height': widget_visibility_filtered + 'px',
                        'transition' : 'all 1s ease-in-out 0s'
                    }).addClass('bdt-fold-close').removeClass('bdt-fold-open');    
                } 
            }

        }


        if ( by_widget_selector_status === 'yes' ) {
            $($toggle).find('.bdt-show-hide-title').on('click', function () {
                byWidgetHandler();
            });

            if ( toggle_initially_open === 'yes' ) {
                $(source_selector).addClass('bdt-fold-toggle bdt-fold-open toggle_initially_open');
            } else {
                $(source_selector).addClass('bdt-fold-toggle bdt-fold-close toggle_initially_open');
            }

            $(window).resize(function () {
                visibilityCalled();
            });
            visibilityCalled();
        }

        function visibilityCalled() {
            if ( $(source_selector).hasClass('bdt-fold-close') ) {
                $(source_selector).css({
                    'height': widget_visibility_filtered + 'px'
                });
            } else {
                // $(source_selector).css({
                //     'max-height': '100%'
                // });
                autoHeightAnimate($(source_selector), 500);
            }
        }


    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-toggle.default', widgetToggle);
    });
}(jQuery, window.elementorFrontend));

/**
 * End toggle widget script
 */


/**
 * Start twitter carousel widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTwitterCarousel = function( $scope, $ ) {

		var $twitterCarousel = $scope.find( '.bdt-twitter-carousel' );
				
        if ( ! $twitterCarousel.length ) {
            return;
        }

        //console.log($twitterCarousel);

		var $twitterCarouselContainer = $twitterCarousel.find('.swiper-container'),
			$settings 		 = $twitterCarousel.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($twitterCarouselContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($twitterCarouselContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};
	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-twitter-carousel.default', widgetTwitterCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End twitter carousel widget script
 */


/**
 * Start tutor lms widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTutorCarousel = function( $scope, $ ) {

		var $tutorCarousel = $scope.find( '.bdt-tutor-lms-course-carousel' );
            
        if ( ! $tutorCarousel.length ) {
            return;
        }

		var $tutorCarouselContainer = $tutorCarousel.find('.swiper-container'),
			$settings 		 = $tutorCarousel.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($tutorCarouselContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($tutorCarouselContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};
	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-tutor-lms-course-carousel.default', widgetTutorCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End tutor lms widget script
 */

/**
 * Start tutor lms grid widget script
 */

(function ($, elementor) {

	'use strict';

	var widgetTutorLMSGrid = function ($scope, $) {

		var $tutorLMS = $scope.find('.bdt-tutor-lms-course-grid'),
			$settings = $tutorLMS.data('settings');

		if (!$tutorLMS.length) {
			return;
		}

		if ($settings.tiltShow == true) {
			var elements = document.querySelectorAll($settings.id + " .bdt-tutor-course-item");
			VanillaTilt.init(elements);
		}

	};

	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tutor-lms-course-grid.default', widgetTutorLMSGrid);
	});

}(jQuery, window.elementorFrontend));

/**
 * End tutor lms grid widget script
 */

/**
 * Start twitter slider widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTwitterSlider = function( $scope, $ ) {

		var $twitterSlider = $scope.find( '.bdt-twitter-slider' );
				
        if ( ! $twitterSlider.length ) {
            return;
        }

		var $twitterSliderContainer = $twitterSlider.find('.swiper-container'),
			$settings 		 = $twitterSlider.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($twitterSliderContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($twitterSliderContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};
	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-twitter-slider.default', widgetTwitterSlider );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End twitter slider widget script
 */


/**
 * Start threesixty product viewer widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetTSProductViewer = function( $scope, $ ) {

		var $TSPV      	   = $scope.find( '.bdt-threesixty-product-viewer' ),
            $settings      = $TSPV.data('settings'),
            $container     = $TSPV.find('> .bdt-tspv-container'), 
            $fullScreenBtn = $TSPV.find('> .bdt-tspv-fb');  

        if ( ! $TSPV.length ) {
            return;
        }
        

        if ($settings.source_type === 'remote') {
            $settings.source = SpriteSpin.sourceArray( $settings.source, { frame: $settings.frame_limit, digits: $settings.image_digits} );
        }

        elementorFrontend.waypoint( $container, function() {
            var $this = $( this );
            $this.spritespin($settings);

        }, {
            offset: 'bottom-in-view'
        } );

        

        //if ( ! $fullScreenBtn.length ) {
            $($fullScreenBtn).click(function(e) {
                e.preventDefault();
                $($container).spritespin('api').requestFullscreen();
            });
        //}

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-threesixty-product-viewer.default', widgetTSProductViewer );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End threesixty product viewer widget script
 */


/**
 * Start time zone widget script
 */
 
(function ($, elementor) {
    'use strict';
    var widgetTimeZone = function ($scope, $) {
        var $TimeZone = $scope.find('.bdt-time-zone');
        var $TimeZoneTimer = $scope.find('.bdt-time-zone-timer');
        if (!$TimeZone.length) {
            return;
        }
        elementorFrontend.waypoint($TimeZoneTimer, function () {
            var $this = $(this);
            var $settings = $this.data('settings');
            var timeFormat;
            if ($settings.timeHour == '12h') {
                timeFormat = '%I:%M:%S %p';
            } else {
                timeFormat = '%H:%M:%S';
            }
            // dateFormat
            var dateFormat = $settings.dateFormat;
            if (dateFormat != 'emptyDate') {
                dateFormat = '<div class=\"bdt-time-zone-date\"> ' + $settings.dateFormat + ' </div>'
            } else {
                dateFormat = '';
            }
            var country;
            if ($settings.country != 'emptyCountry') {
                country = '<div  class=\"bdt-time-zone-country\">' + $settings.country + '</div>';
            } else {
                country = ' ';
            }
            var timeZoneFormat;
            timeZoneFormat = '<div class=\"bdt-time-zone-dt\"> ' + country + ' ' + dateFormat + ' <div class=\"bdt-time-zone-time\">' + timeFormat + ' </div> </div>';
            var offset = $settings.gmt;
            if (offset == '') return;
            var options = {
                format: timeZoneFormat,
                timeNotation: $settings.timeHour, //'24h',
                am_pm: true,
                utc: (offset == 'local') ? false : true,
                utcOffset: (offset == 'local') ? null : offset,
            }
            $('#' + $settings.id).jclock(options);
        }, {
            offset: 'bottom-in-view'
        });
    };
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-time-zone.default', widgetTimeZone);
    });
}(jQuery, window.elementorFrontend));

/**
 * End time zone widget script
 */


/**
 * Start video gallery widget script
 */
 
( function( $, elementor ) {

	'use strict';

	var widgetVideoGallery = function( $scope, $ ) {

		var $video_gallery = $scope.find( '.rvs-container' );
				
        if ( ! $video_gallery.length ) {
            return;
        }

        $($video_gallery).rvslider();

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-video-gallery.default', widgetVideoGallery );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End video gallery widget script
 */


/**
 * Start vertical menu widget script
 */

(function ($, elementor) {
    'use strict';
    // Horizontal Menu
    var widgetVerticalMenu = function ($scope, $) {
        var $vrMenu = $scope.find('.bdt-vertical-menu');
        var $settings = $vrMenu.data('settings');
        if (!$vrMenu.length) {
            return;
        }
        $('#' + $settings.id).metisMenu();

        $($vrMenu).find('.has-arrow').on('click', function(){
            return false;
        })
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-vertical-menu.default', widgetVerticalMenu);
    });

}(jQuery, window.elementorFrontend));

/**
 * End vertical menu widget script
 */


/**
 * Start woocommerce widget script
 */

(function($, elementor) { 
    'use strict';
    var widgetWCCarousel = function($scope, $) {
        var $wcCarousel = $scope.find('.bdt-wc-carousel');
        if (!$wcCarousel.length) {
            return;
        }
        
        var $wcCarouselContainer = $wcCarousel.find('.swiper-container'),
        $settings = $wcCarousel.data('settings');

        // Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($wcCarouselContainer, $settings);
            if ($settings.pauseOnHover) {
                $($wcCarouselContainer).hover(function() {
                    (this).swiper.autoplay.stop();
                }, function() {
                    (this).swiper.autoplay.start();
                });
            }
        };
    };

    var widgetWCProductTable = function($scope, $) { 

        var $productTable = $scope.find('.bdt-wc-products-skin-table'),
        $settings = $productTable.data('settings'),
        $table = $productTable.find('> table'),
        $quantity = $productTable.find('.bdt-wc-quantity .quantity input');

        if (!$productTable.length) {
            return;
        }

        $settings.language = window.ElementPackConfig.data_table.language;

        if( $settings.hideHeader == 'yes'){

           $($table).DataTable({
            cache          : false,
            order          : [],
            paging         : $settings.paging,
            info           : $settings.info,
            bLengthChange  : $settings.bLengthChange,
            searching      : $settings.searching,
            ordering       : $settings.ordering,
            pageLength     : $settings.pageLength,
            drawCallback   : function( settings ) {
                $( $table).find("thead").remove(); } , 
            });
           return;
        }

        if( $settings.orderColumn != 'default' && $('.bdt-wc-product').find('.bdt-'+$settings.orderColumn).length > 0 && $settings.hideHeader != 'yes') {

        var orderColumn = $('.bdt-wc-product .bdt-'+$settings.orderColumn);
        orderColumn = $(orderColumn).index(this);

        $($table).DataTable({
            cache          : false,
            paging         : $settings.paging,
            info           : $settings.info,
            bLengthChange  : $settings.bLengthChange,
            searching      : $settings.searching,
            ordering       : $settings.ordering,
            pageLength     : $settings.pageLength,
            order          : [[ orderColumn, $settings.orderColumnQry ]],
        });

        } else {
            $($table).DataTable({
                cache         : false,
                order         : [],
                paging        : $settings.paging,
                info          : $settings.info,
                bLengthChange : $settings.bLengthChange,
                searching     : $settings.searching,
                ordering      : $settings.ordering,
                pageLength    : $settings.pageLength,
                
            });
        }

        jQuery($quantity).on('change',function(){
            var qtyNum = jQuery(this).val();
            jQuery(this).closest('tr').find('.bdt-wc-add-to-cart a').attr('data-quantity', qtyNum);
        });

    };

    // Quickviews
    var widgetProductQuickView = {
        loadQuickViewHtml: function(_this, $scope) {
            var product_id = $(_this).data('id');
            bdtUIkit.notification({
                message: '<div bdt-spinner></div>' + $scope.find('.bdt_modal_spinner_message').val(),
                timeout: false
            });
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: element_pack_ajax_login_config.ajaxurl,
                data: {
                    'action': 'element_pack_wc_product_quick_view_content',
                    'product_id': product_id,
                    'security': $scope.find('#bdt-wc-product-modal-sc').val()
                },
                success: function(response) {
                    bdtUIkit.modal(response.data).show();
                    bdtUIkit.notification.closeAll();

                    var form_variation = jQuery('.bdt-product-quick-view').find('.variations_form');
                    form_variation.each(function () {
                        jQuery(this).wc_variation_form();
                    });
                }
            });
        }
    };

    var widgetWCQuickViewTrigger = function($scope, $) {
        $scope.on('click', '.bdt-quick-view a', function(e) {
            e.preventDefault();
            widgetProductQuickView.loadQuickViewHtml(this, $scope);
        });
    };
    var widgetWCHashFilter = function($scope, $) {
        var $productWrapper = $scope.find('.bdt-wc-products'),
        $productFilter = $productWrapper.find('.bdt-ep-grid-filters-wrapper');
        if (!$productFilter.length) {
            return;
        }
        var $settings = $productFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler($productFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($productFilter).find('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').closest($productFilter).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function() {
                        //#code
                    }).promise().then(function() {
                        $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function() {
                hashHandler($productFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($productFilter).find('.bdt-ep-grid-filter').off('click').on('click', function(event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $productFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function(e) {
                hashHandler($productFilter, hashScrollspyTime, hashTopOffset);
            });
        }
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.default', widgetWCCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.wc-carousel-hidie', widgetWCCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.bdt-table', widgetWCProductTable);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.default', widgetWCQuickViewTrigger);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.default', widgetWCHashFilter);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.default', widgetWCQuickViewTrigger);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.bdt-table', widgetWCQuickViewTrigger);
    });
}(jQuery, window.elementorFrontend));

/**
 * End woocommerce widget script
 */


/**
 * Start products widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetWCProductTable = function( $scope, $ ) {

		var $productTable = $scope.find( '.bdt-wc-products-skin-table' ),
            $settings 	  = $productTable.data('settings'),
            $table        = $productTable.find('> table');
            
        if ( ! $productTable.length ) {
            return;
        }

        $settings.language = window.ElementPackConfig.data_table.language;

        $($table).DataTable($settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-wc-products.bdt-table', widgetWCProductTable );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End products widget script
 */


/**
 * Start audio player widget script
 */

( function( $, elementor ) {

	'use strict';

	//Audio Player
	var widgetAudioPlayer = function( $scope, $ ) {

		var $audioPlayer         = $scope.find( '.bdt-audio-player > .jp-jplayer' ),
			$container 			 = $audioPlayer.next('.jp-audio').attr('id'),
			$settings 		 	 = $audioPlayer.data('settings');
			

		if ( ! $audioPlayer.length ) {
			return;
		}

		$($audioPlayer).jPlayer({
			ready: function (event) {
				$(this).jPlayer('setMedia', {
					title : $settings.audio_title,
					mp3   : $settings.audio_source
				});
				if($settings.autoplay) {
					$(this).jPlayer('play', 1);
				}
			},
			play: function() {
				$(this).next('.jp-audio').removeClass('bdt-player-played');
				$(this).jPlayer('pauseOthers');
			},
			ended: function() {
		    	$(this).next('.jp-audio').addClass('bdt-player-played');
		  	},

			timeupdate: function(event) {
				if($settings.time_restrict) {
					if ( event.jPlayer.status.currentTime > $settings.restrict_duration ) {
						$(this).jPlayer('stop');
					}
				}
			},

			cssSelectorAncestor : '#' + $container,
			useStateClassSkin   : true,
			autoBlur            : $settings.smooth_show,
			smoothPlayBar       : true,
			keyEnabled          : $settings.keyboard_enable,
			remainingDuration   : true,
			toggleDuration      : true,
			volume              : $settings.volume_level,
			loop                : $settings.loop
			
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-audio-player.default', widgetAudioPlayer );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-audio-player.bdt-poster', widgetAudioPlayer );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * Start audio player widget script
 */


/**
 * Start scroll button widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetScrollButton = function( $scope, $ ) {
	    
			var $scrollButton = $scope.find('.bdt-scroll-button'),
			$selector         = $scrollButton.data('selector'),
			$settings         =  $scrollButton.data('settings');

	    if ( ! $scrollButton.length ) {
	    	return;
	    }

	    //$($scrollButton).find('.bdt-scroll-button').unbind();
	    
	    if ($settings.HideOnBeforeScrolling == true) {

			$(window).scroll(function() {
			  if ($(window).scrollTop() > 300) {
			    $scrollButton.css("opacity", "1");
			  } else {
			    $scrollButton.css("opacity", "0");
			  }
			});
	    }

	    $($scrollButton).on('click', function(event){
	    	event.preventDefault();
	    	bdtUIkit.scroll($scrollButton, $settings ).scrollTo($($selector));

	    });

	};

	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-scroll-button.default', widgetScrollButton );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End scroll button widget script
 */


/**
 * Start search widget script
 */

(function ($, elementor) {
  'use strict';
  var serachTimer;
  var widgetAjaxSearch = function ($scope, $) {
    var $searchWidget = $scope.find('.bdt-ajax-search');
    let $search;
    if (!$searchWidget.length) {
      return;
    }
    var $resultHolder = $($searchWidget).find('.bdt-search-result'),
      $settings = $($searchWidget).data('settings'),
      $target = $($searchWidget).attr('anchor-target');
      // alert($post_type.per_page);

    if ('yes' === $target) {
      $target = '_blank';
    } else {
      $target = '_self';
    }

    clearTimeout(serachTimer);


    $($searchWidget).on('keyup keypress', function (e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) {
        e.preventDefault();
        return false;
      }
    });

    $searchWidget.find('.bdt-search-input').keyup(function () {
      $search = $(this).val();
      serachTimer = setTimeout(function () {
        $($searchWidget).addClass('bdt-search-loading');
        jQuery.ajax({
          url: window.ElementPackConfig.ajaxurl,
          type: 'post',
          data: {
            action: 'element_pack_search',
            s: $search,
            settings: $settings,
          },
          success: function (response) {
            response = $.parseJSON(response);
            if (response.results.length > 0) {
              if ($search.length >= 3) {
                var output = `<div class="bdt-search-result-inner">
                          <h3 class="bdt-search-result-header">SEARCH RESULT<i class="eicon-editor-close bdt-search-result-close-btn"></i></h3>
                          <ul class="bdt-list bdt-list-divider">`;
                for (let i = 0; i < response.results.length; i++) {
                  const element = response.results[i];
                  output += `<li class="bdt-search-item" data-url="${element.url}">
                            <a href="${element.url}" target="${$target}">
                            <div class="bdt-search-title">${element.title}</div>
                            <div class="bdt-search-text">${element.text}</div>
                            </a>
                          </li>`;
                }
                output += `</ul><a class="bdt-search-more">More Results</a></div>`;

                $resultHolder.html(output);
                $resultHolder.show();
                $(".bdt-search-result-close-btn").on("click", function (e) {
                  $(".bdt-search-result").hide();
                  $(".bdt-search-input").val("");
                });

                $($searchWidget).removeClass("bdt-search-loading");
                $(".bdt-search-more").on("click", function (event) {
                  event.preventDefault();
                  $($searchWidget).submit();
                });
              } else {
                $resultHolder.hide();
              }
            } else {
              if ($search.length >= 3) {
                var not_found = `<div class="bdt-search-result-inner">
                                  <h3 class="bdt-search-result-header">SEARCH RESULT<i class="eicon-editor-close bdt-search-result-close-btn"></i></h3>
                                  <div class="bdt-search-text">${$search} not found</div>
                                </div>`;
                $resultHolder.html(not_found);
                $resultHolder.show();
                $(".bdt-search-result-close-btn").on("click", function (e) {
                  $(".bdt-search-result").hide();
                  $(".bdt-search-input").val("");
                });
                $($searchWidget).removeClass("bdt-search-loading");
              } else {
                $resultHolder.hide();
              }
            }
          }
        });
      }, 450);
    });

  };

  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/bdt-search.default', widgetAjaxSearch);
  });

  //window.elementPackAjaxSearch = widgetAjaxSearch;

})(jQuery, window.elementorFrontend);

/**
 * End search widget script
 */

/**
 * Start switcher widget script
 */

(function ($, elementor) {

	'use strict';

	var sectionSwitcher = function ($scope, $) {
		var $switcher = $scope.find('.bdt-switchers'),
			$settings = $switcher.data('settings'),
			$activatorSettings = $switcher.data('activator'),
			$settingsLinkWidget = $switcher.data('bdt-link-widget'),
			editMode = Boolean(elementor.isEditMode());


		if ($activatorSettings !== undefined) {
			// for A
			bdtUIkit.util.on($activatorSettings.switchA, "click", function () {
				bdtUIkit.switcher('#bdt-switcher-activator-' + $activatorSettings.id).show(0);
				bdtUIkit.switcher('#bdt-switcher-' + $activatorSettings.id).show(0);
			});
			// for B
			bdtUIkit.util.on($activatorSettings.switchB, "click", function () {
				bdtUIkit.switcher('#bdt-switcher-activator-' + $activatorSettings.id).show(1);
				bdtUIkit.switcher('#bdt-switcher-' + $activatorSettings.id).show(1);
			});

		}


		// if ( $settings === undefined || editMode ) {
		// 	return;
		// }

		if ($settings !== undefined && editMode === false) {
			var $switchAContainer = $switcher.find('.bdt-switcher > div > div > .bdt-switcher-item-a'),
				$switchBContainer = $switcher.find('.bdt-switcher > div > div > .bdt-switcher-item-b'),
				$switcherContentA = $('.elementor').find('.elementor-section' + '#' + $settings['switch-a-content']),
				$switcherContentB = $('.elementor').find('.elementor-section' + '#' + $settings['switch-b-content']);

			if ($settings.positionUnchanged !== true) {
				if ($switchAContainer.length && $switcherContentA.length) {
					$($switcherContentA).appendTo($switchAContainer);
				}

				if ($switchBContainer.length && $switcherContentB.length) {
					$($switcherContentB).appendTo($switchBContainer);
				}
			}

			if ($settings.positionUnchanged == true) {
				$('#bdt-tabs-' + $settings.id).find('.bdt-switcher').remove();

				var $switcherContentAAA = $('#' + $settings['switch-a-content']);
				var $switcherContentBBB = $('#' + $settings['switch-b-content']);

				$('#' + $settings['switch-a-content']).parent().append(`<div id="bdt-switcher-${$settings.id}" class="bdt-switcher bdt-switcher-item-content" style="width:100%;"></div>`);

				$($switcherContentAAA).appendTo($('#bdt-switcher-' + $settings.id));
				$($switcherContentBBB).appendTo($('#bdt-switcher-' + $settings.id));
				
				var $activeA, $activeB = '';
				if ($settings.defaultActive == 'a'){
						$activeA, $activeA = 'bdt-active';
				}else{
					$activeB = 'bdt-active';
				}

				$('#' + $settings['switch-a-content']).wrapAll('<div class="bdt-switcher-item-content-inner ' + $activeA + '"></div>');
				$('#' + $settings['switch-b-content']).wrapAll('<div class="bdt-switcher-item-content-inner ' + $activeB + '"></div>');
			}
		}
 

		if ($settingsLinkWidget !== undefined && editMode === false) {
			var $targetA = $($settingsLinkWidget.linkWidgetTargetA),
				$targetB = $($settingsLinkWidget.linkWidgetTargetB),
				$switcher = '#bdt-switcher-' + $settingsLinkWidget.id;

			$targetA.css({
				'opacity': 1,
				'grid-row-start': 1,
				'grid-column-start': 1
			});

			$targetA.parent().css({
				'display': 'grid'
			});

			$targetB.css({
				'opacity': 0,
				'grid-row-start': 1,
				'grid-column-start': 1
			});

			bdtUIkit.util.on($switcher, 'shown', function (e) {
				var index = bdtUIkit.util.index(e.target)
				if (index == 0) {
					$targetA.css({
						'opacity': 1
					});
					$targetB.css({
						'opacity': 0
					});
				} else {
					$targetB.css({
						'opacity': 1
					});
					$targetA.css({
						'opacity': 0
					});
				}

			})
		}


	};

	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bdt-switcher.default', sectionSwitcher);
	});

}(jQuery, window.elementorFrontend));

/**
 * End switcher widget script
 */
/**
 * Start source code widget script
 */

( function( $, elementor ) {

    'use strict';

    var sourceCodeWidget = function( $scope, $ ) {
        var $sourceCode = $scope.find('.bdt-source-code'),
            $preCode = $sourceCode.find('pre > code');

        if ( ! $sourceCode.length ) {
            return;
        }

        // create clipboard for every copy element
        var clipboard = new ClipboardJS('.bdt-copy-button', {
            target: function target(trigger) {
                return trigger.nextElementSibling;
            }
        });

        // do stuff when copy is clicked
        clipboard.on('success', function (event) {
            event.trigger.textContent = 'copied!';
            setTimeout(function () {
                event.clearSelection();
                event.trigger.textContent = 'copy';
            }, 2000);
        });

        //if ($lng_type !== undefined && $code !== undefined) {
            Prism.highlightElement($preCode.get(0));
       // }

    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-source-code.default', sourceCodeWidget );
    });

}( jQuery, window.elementorFrontend ) );

/**
 * End source code widget script
 */


/**
 * Start reading progress widget script
 */

 (function($, elementor) {

    'use strict';

    var readingProgressWidget = function($scope, $) {

        var $readingProgress = $scope.find('.bdt-reading-progress');

        if (!$readingProgress.length) {
            return;
        }
        var $settings = $readingProgress.data('settings');

        jQuery(document).ready(function(){
            // jQuery($readingProgress).progressScroll([$settings.progress_bg, $settings.scroll_bg]); 
            var settings = {
                borderSize: 10,
                mainBgColor: '#E6F4F7',
                lightBorderColor: '#A2ECFB',
                darkBorderColor: '#39B4CC'
            };

            var colorBg = $settings.progress_bg;  //'red'
            var progressColor = $settings.scroll_bg; //'green';
            var innerHeight, offsetHeight, netHeight,
            self = this,
            container = $($readingProgress),
            borderContainer = 'bdt-reading-progress-border',
            circleContainer = 'bdt-reading-progress-circle',
            textContainer = 'bdt-reading-progress-text';

            var getHeight = function () {
                innerHeight = window.innerHeight;
                offsetHeight = document.body.offsetHeight;
                netHeight = offsetHeight - innerHeight;
            };

            var addEvent = function () {
                var e = document.createEvent('Event');
                e.initEvent('scroll', false, false);
                window.dispatchEvent(e);
            };
            var updateProgress = function (percnt) {
                var per = Math.round(100 * percnt);
                var deg = per * 360 / 100;
                if (deg <= 180) {
                    $('.' + borderContainer, container).css('background-image', 'linear-gradient(' + (90 + deg) + 'deg, transparent 50%, ' + colorBg + ' 50%),linear-gradient(90deg, ' + colorBg + ' 50%, transparent 50%)');
                } else {
                    $('.' + borderContainer, container).css('background-image', 'linear-gradient(' + (deg - 90) + 'deg, transparent 50%, ' + progressColor + ' 50%),linear-gradient(90deg, ' + colorBg + ' 50%, transparent 50%)');
                }
                $('.' + textContainer, container).text(per + '%');
            };
            var prepare = function () {
                    //$(container).addClass("bdt-reading-progress");
                    $(container).html("<div class='" + borderContainer + "'><div class='" + circleContainer + "'><span class='" + textContainer + "'></span></div></div>");

                    $('.' + borderContainer, container).css({
                        'background-color': progressColor,
                        'background-image': 'linear-gradient(91deg, transparent 50%,' + settings.lightBorderColor + '50%), linear-gradient(90deg,' + settings.lightBorderColor + '50%, transparent 50%'
                    });
                    $('.' + circleContainer, container).css({
                        'width': settings.width - settings.borderSize,
                        'height': settings.height - settings.borderSize
                    });

                };
            var init = function () {
                    prepare();
                    $(window).on('scroll', function () {
                        var getOffset = window.pageYOffset || document.documentElement.scrollTop,
                        per = Math.max(0, Math.min(1, getOffset / netHeight));
                        updateProgress(per);
                    });
                    $(window).on('resize', function () {
                        getHeight();
                        addEvent();
                    });
                    $(window).on('load', function () {
                        getHeight();
                        addEvent();
                    });
                };
                 init();
            });

    };
    //	start progress with cursor
    var readingProgressCursorSkin = function($scope, $) {

        var $readingProgress = $scope.find('.bdt-progress-with-cursor');

        if (!$readingProgress.length) {
            return;
        }

        document.getElementsByTagName('body')[0].addEventListener('mousemove', function(n) {
            t.style.left = n.clientX + 'px';
            t.style.top = n.clientY + 'px';
            e.style.left = n.clientX + 'px';
            e.style.top = n.clientY + 'px';
            i.style.left = n.clientX + 'px';
            i.style.top = n.clientY + 'px';
        });
        var t = document.querySelector('.bdt-cursor'),
        e = document.querySelector('.bdt-cursor2'),
        i = document.querySelector('.bdt-cursor3');

        function n(t) {
            e.classList.add('hover'), i.classList.add('hover');
        }

        function s(t) {
            e.classList.remove('hover'), i.classList.remove('hover');
        }
        s();
        for (var r = document.querySelectorAll('.hover-target'), a = r.length - 1; a >= 0; a--) {
            o(r[a]);
        }

        function o(t) {
            t.addEventListener('mouseover', n);
            t.addEventListener('mouseout', s);
        }

        $(document).ready(function() {


            //Scroll indicator
            var progressPath = document.querySelector('.bdt-progress-wrap path');
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            var updateProgress = function() {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            };
            updateProgress();
            jQuery(window).on('scroll', updateProgress);


        });

    };
    //	end  progress with cursor

    // start progress horizontal 


    var readingProgressHorizontalSkin = function($scope, $) {

        var $readingProgress = $scope.find('.bdt-horizontal-progress');

        if (!$readingProgress.length) {
            return;
        }

        $('#bdt-progress').progress({ size: '3px', wapperBg: '#eee', innerBg: '#DA4453' });

    };

    // end progress horizontal 

    // start  progress back to top 


    var readingProgressBackToTopSkin = function($scope, $) {

        var $readingProgress = $scope.find('.bdt-progress-with-top');

        if (!$readingProgress.length) {
            return;
        }

        var progressPath = document.querySelector('.bdt-progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function() {
            var scroll = jQuery(window).scrollTop();
            var height = jQuery(document).height() - jQuery(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        };
        updateProgress();
        jQuery(window).on('scroll', updateProgress);
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.bdt-progress-wrap').addClass('active-progress');
            } else {
                jQuery('.bdt-progress-wrap').removeClass('active-progress');
            }
        });
        jQuery('.bdt-progress-wrap').on('click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, duration);
            return false;
        });


    };

    // end progress back to top

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-reading-progress.default', readingProgressWidget);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-reading-progress.bdt-progress-with-cursor', readingProgressCursorSkin);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-reading-progress.bdt-horizontal-progress', readingProgressHorizontalSkin);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-reading-progress.bdt-back-to-top-with-progress', readingProgressBackToTopSkin);
    });

}(jQuery, window.elementorFrontend));

/**
 * End reading progress widget script
 */


/**
 * Start section sticky widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetSectionSticky = function( $scope, $ ) {

        var $section   = $scope;

        //sticky fixes for inner section.
        jQuery($section).each(function( index ) {
            var $sticky      = jQuery(this),
                $stickyFound = $sticky.find('.elementor-inner-section.bdt-sticky');
                
            if ($stickyFound.length) {
                jQuery($stickyFound).wrap('<div class="bdt-sticky-wrapper"></div>');
            }
        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
        elementor.hooks.addAction( 'frontend/element_ready/section', widgetSectionSticky );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End section sticky widget script
 */


/**
 * Start lottie image widget script
 */

(function($, elementor) {

    'use strict';

    // lottie-image 
    var widgetLottieImage = function($scope, $) {

        var $lottie = $scope.find('.bdt-lottie-container'),
        $settings = $lottie.data('settings');

        if (!$lottie.length) {
            return;
        }

        var lottieContainer = document.getElementById($($lottie).attr('id'));

        function lottieRun(lottieContainer) {
            var json_path_url = "";

            if ($settings.is_json_url == 1) {
                if ($settings.json_path) {
                    json_path_url = $settings.json_path;
                }
            } else {
                if ($settings.json_code) {
                    var json_path_data = $settings.json_code;
                    var blob = new Blob([json_path_data], {
                        type: 'application/javascript'
                    });
                    json_path_url = URL.createObjectURL(blob);
                }
            }

            var animation = lottie.loadAnimation({
                container: lottieContainer, // Required
                path: json_path_url, // Required
                renderer: $settings.lottie_renderer, // Required
                autoplay: ('autoplay' === $settings.play_action), // Optional
                loop: $settings.loop, // Optional
            });
            URL.revokeObjectURL(json_path_url);

            animation.addEventListener('DOMLoaded', function(e) {
                var firstFrame = animation.firstFrame;
                var totalFrame = animation.totalFrames;

                function getFrameNumberByPercent(percent) {
                    percent = Math.min(100, Math.max(0, percent));
                    return firstFrame + (totalFrame - firstFrame) * percent / 100;
                }

                var startPoint = getFrameNumberByPercent($settings.start_point),
                endPoint = getFrameNumberByPercent($settings.end_point);

                animation.playSegments([startPoint, endPoint], true);

            });

            //if (1 == $settings.speed) {
                animation.setSpeed($settings.speed);
            //}

            if ($settings.play_action) {


                if ('column' === $settings.play_action) {
                    lottieContainer = $scope.closest('.elementor-widget-wrap')[0];
                }

                if ('section' === $settings.play_action) {
                    lottieContainer = $scope.closest('.elementor-section')[0];
                }


                if ('click' === $settings.play_action) {
                    lottieContainer.addEventListener('click', function() {
                        animation.goToAndPlay(0);
                    });

                } else if ('autoplay' !== $settings.play_action) {

                    lottieContainer.addEventListener('mouseenter', function() {
                        animation.goToAndPlay(0);
                    });
                    // lottieContainer.addEventListener('mouseleave', function () {
                    //     animation.stop();
                    // });

                }

            }

        }


        if ('scroll' === $settings.view_type) {
            elementorFrontend.waypoint($lottie, function() {
                lottieRun(lottieContainer);
            });
        } else {
            lottieRun(lottieContainer);
        }
    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-lottie-image.default', widgetLottieImage);
    });

}(jQuery, window.elementorFrontend));

/**
 * End lottie image widget script
 */


/**
 * Start lottie icon box widget script
 */

(function($, elementor) {

    'use strict';

    // lottie-icon-box  
    var widgetLottieImage = function($scope, $) {

        var $lottie = $scope.find('.bdt-lottie-container'),
        $settings = $lottie.data('settings');

        if (!$lottie.length) {
            return;
        }

        var lottieContainer = document.getElementById($($lottie).attr('id'));

        function lottieRun(lottieContainer) {

            var json_path_url = "";

            if ($settings.is_json_url == 1) {
                if ($settings.json_path) {
                    json_path_url = $settings.json_path;
                }
            } else {
                if ($settings.json_code) {
                    var json_path_data = $settings.json_code;
                    var blob = new Blob([json_path_data], { type: 'application/javascript' });
                    json_path_url = URL.createObjectURL(blob);
                }
            }

            var animation = lottie.loadAnimation({
                container: lottieContainer, // Required
                path: json_path_url, // Required
                renderer: $settings.lottie_renderer, // Required
                autoplay: ('autoplay' === $settings.play_action), // Optional
                loop: $settings.loop, // Optional
            });
            URL.revokeObjectURL(json_path_url);

            animation.addEventListener('DOMLoaded', function(e) {
                var firstFrame = animation.firstFrame;
                var totalFrame = animation.totalFrames;

                function getFrameNumberByPercent(percent) {
                    percent = Math.min(100, Math.max(0, percent));
                    return firstFrame + (totalFrame - firstFrame) * percent / 100;
                }

                var startPoint = getFrameNumberByPercent($settings.start_point),
                endPoint = getFrameNumberByPercent($settings.end_point);

                animation.playSegments([startPoint, endPoint], true);

            });

            // if (1 >= $settings.speed) {
                animation.setSpeed($settings.speed);
            // }

            if ($settings.play_action) {


                if ('column' === $settings.play_action) {
                    lottieContainer = $scope.closest('.elementor-widget-wrap')[0];
                }

                if ('section' === $settings.play_action) {
                    lottieContainer = $scope.closest('.elementor-section')[0];
                }


                if ('click' === $settings.play_action) {
                    lottieContainer = $scope.closest('.elementor-widget-wrap')[0];
                    lottieContainer.addEventListener('click', function() {
                        animation.goToAndPlay(0);
                    });

                } else if ('autoplay' !== $settings.play_action) {
                    lottieContainer.addEventListener('mouseenter', function() {
                        animation.goToAndPlay(0);
                    });
                    // lottieContainer.addEventListener('mouseleave', function () {
                    //     animation.stop();
                    // });


                }

            }

        }


        if ('scroll' === $settings.view_type) {
            elementorFrontend.waypoint($lottie, function() {
                lottieRun(lottieContainer);
            });
        } else {
            lottieRun(lottieContainer);
        }
 
};


jQuery(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/bdt-lottie-icon-box.default', widgetLottieImage);
});

}(jQuery, window.elementorFrontend));

/**
 * End lottie icon box widget script
 */


/**
 * Start logo grid widget script
 */

(function($, elementor) {

    'use strict'; 

    var widgetLogoGrid = function($scope, $) {

        var $logogrid = $scope.find('.bdt-logo-grid-wrapper');

        if (!$logogrid.length) {
            return;
        }

        var $tooltip = $logogrid.find('> .bdt-tippy-tooltip'),
            widgetID = $scope.data('id');

        $tooltip.each(function(index) {
            tippy(this, {
                //appendTo: $scope[0]
                //arrow: false,
                allowHTML: true,
                theme: 'bdt-tippy-' + widgetID
            });
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-logo-grid.default', widgetLogoGrid);
    });

}(jQuery, window.elementorFrontend));

/**
 * Start logo carousel widget script
 */

(function($, elementor) {

    'use strict';

    var widgetLogoCarousel = function($scope, $) {

        var $logocarousel = $scope.find('.bdt-logo-carousel-wrapper');

        if (!$logocarousel.length) {
            return;
        }

        var $tooltip = $logocarousel.find('> .bdt-tippy-tooltip'),
            widgetID = $scope.data('id'); 

        $tooltip.each(function(index) {
            tippy(this, {
                allowHTML: true,
                theme: 'bdt-tippy-' + widgetID
            });
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-logo-carousel.default', widgetLogoCarousel);
    });

}(jQuery, window.elementorFrontend));

/**
 * End logo carousel widget script
 */


/**
 * Start portfolio carousel widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetPortfolioCarousel = function ($scope, $) {

        var $carousel = $scope.find('.bdt-portfolio-carousel');

        if (!$carousel.length) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
            $settings = $carousel.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($carouselContainer, $settings);

            if ($settings.pauseOnHover) {
                $($carouselContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

        };
    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.default', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-abetis', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-fedara', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-trosia', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-janes', widgetPortfolioCarousel);
    });

}(jQuery, window.elementorFrontend));

/**
 * End portfolio carousel widget script
 */
/**
 * Start user login widget script
 */

( function ($, elementor) {

        'use strict';

        window.is_fb_loggedin = false;
        window.is_google_loggedin = false;

        var widgetUserLoginForm = {
            loginFormSubmission: function (login_form) {
                var redirect_url = login_form.find('.redirect_after_login').val();

                $.ajax({
                    type     : 'POST',
                    dataType : 'json',
                    url      : element_pack_ajax_login_config.ajaxurl,
                    data     : login_form.serialize(),
                    beforeSend: function (xhr) {
                        bdtUIkit.notification({
                            message: '<div bdt-spinner></div> ' + element_pack_ajax_login_config.loadingmessage,
                            timeout: false
                        });
                    },
                    success: function (data) {
                        var recaptcha_field = login_form.find('.element-pack-google-recaptcha');
                        if (recaptcha_field.length > 0) {
                            var recaptcha_id = recaptcha_field.attr('data-widgetid');
                            grecaptcha.reset(recaptcha_id);
                            grecaptcha.execute(recaptcha_id);
                        }

                        if (data.loggedin == true) {
                            bdtUIkit.notification.closeAll();
                            bdtUIkit.notification({
                                message : '<span bdt-icon=\'icon: check\'></span> ' + data.message,
                                status  : 'primary'
                            });
                            document.location.href = redirect_url;
                        } else {
                            bdtUIkit.notification.closeAll();
                            bdtUIkit.notification({
                                message : '<div class="bdt-flex"><span bdt-icon=\'icon: warning\'></span><span>' + data.message + '</span></div>',
                                status  : 'warning'
                            });
                        }
                    },
                    error: function (data) {
                        bdtUIkit.notification.closeAll();
                        bdtUIkit.notification({
                            message : '<span bdt-icon=\'icon: warning\'></span>' + element_pack_ajax_login_config.unknownerror,
                            status  : 'warning'
                        });
                    }
                });
            },
            get_facebook_user_data: function (widget_wrapper) {
                var redirect_url = widget_wrapper.find('.redirect_after_login').val();

                FB.api('/me', {fields: 'id, name, first_name, last_name, email, link, gender, locale, picture'},
                    function (response) {

                        var userID = FB.getAuthResponse()['userID'];
                        var access_token = FB.getAuthResponse()['accessToken'];

                        window.is_fb_loggedin = true;

                        var fb_data = {
                            'id'         : response.id,
                            'name'       : response.name,
                            'first_name' : response.first_name,
                            'last_name'  : response.last_name,
                            'email'      : response.email,
                            'link'       : response.link,
                        };

                        $.ajax({
                            url: window.ElementPackConfig.ajaxurl,
                            method: 'post',
                            data: {
                                action          : 'element_pack_social_facebook_login',
                                data            : fb_data,
                                method          : 'post',
                                dataType        : 'json',
                                userID          : userID,
                                security_string : access_token,
                                'lang': element_pack_ajax_login_config.language
                            },
                            dataType: 'json',
                            beforeSend: function (xhr) {
                                bdtUIkit.notification({
                                    message: '<div bdt-spinner></div> ' + element_pack_ajax_login_config.loadingmessage,
                                    timeout: false
                                });
                            },
                            success: function (data) {
                                if (data.success === true) {
                                    if (undefined === redirect_url) {
                                        location.reload();
                                    } else {
                                        window.location = redirect_url;
                                    }
                                } else {
                                    location.reload();
                                }
                            },
                            complete: function (xhr, status) {

                                bdtUIkit.notification.closeAll();
                            }

                        });

                    });
            },

            load_recaptcha: function () {
                var reCaptchaFields = $('.element-pack-google-recaptcha'), widgetID;

                if (reCaptchaFields.length > 0) {
                    reCaptchaFields.each(function () {
                        var self = $(this),
                            attrWidget = self.attr('data-widgetid');
                        // alert(self.data('sitekey'))
                        // Avoid re-rendering as it's throwing API error
                        if (( typeof attrWidget !== typeof undefined && attrWidget !== false )) {
                            return;
                        } else {
                            widgetID = grecaptcha.render($(this).attr('id'), {
                                sitekey: self.data('sitekey'),
                                callback: function (response) {
                                    if (response !== '') {
                                        self.append(jQuery('<input>', {
                                            type  : 'hidden',
                                            value : response,
                                            class : 'g-recaptcha-response'
                                        }));
                                    }
                                }
                            });
                            self.attr('data-widgetid', widgetID);
                        }
                    });
                }
            }

        };

        window.onLoadElementPackLoginCaptcha = widgetUserLoginForm.load_recaptcha;

        var widgetUserLoginFormHandler = function ($scope, $) {
            var widget_wrapper  = $scope.find('.bdt-user-login');
            var login_form      = $scope.find('form.bdt-user-login-form');
            var recaptcha_field = $scope.find('.element-pack-google-recaptcha');
            var fb_button       = widget_wrapper.find('.fb_btn_link');
            var google_button   = widget_wrapper.find('#google_btn_link');
            var redirect_url    = widget_wrapper.find('.redirect_after_login').val();

            if (login_form.length > 0) {
                login_form.on('submit', function (e) {
                    e.preventDefault();
                    widgetUserLoginForm.loginFormSubmission(login_form);
                });
            }

            if (elementorFrontend.isEditMode() && undefined === recaptcha_field.attr('data-widgetid')) {
                onLoadElementPackLoginCaptcha();
            }

            if (recaptcha_field.length > 0) {
                grecaptcha.ready(function () {
                    var recaptcha_id = recaptcha_field.attr('data-widgetid');
                    grecaptcha.execute(recaptcha_id);
                });
            }

            if (fb_button.length > 0) {
                /**
                 * Login with Facebook.
                 *
                 */
                // Fetch the user profile data from facebook.

                fb_button.on('click', function () {
                    if (!is_fb_loggedin) {
                        FB.login(function (response) {
                            if (response.authResponse) {
                                // Get and display the user profile data.
                                widgetUserLoginForm.get_facebook_user_data(widget_wrapper);
                            } else {
                                // $scope.find( '.status' ).addClass( 'error' ).text( 'User cancelled login or did not fully authorize.' );
                            }
                        }, {scope: 'email'});
                    }

                });
            }


            /** google */
            if (google_button.length > 0) {

                var client_id = google_button.data('clientid');

                /**
                 * Login with Google.
                 */
                gapi.load('auth2', function () {
                    // Retrieve the singleton for the GoogleAuth library and set up the client.
                    var auth2 = gapi.auth2.init({
                        client_id: client_id,
                        cookiepolicy: 'single_host_origin',
                    });

                    auth2.attachClickHandler('google_btn_link', {},
                        function (googleUser) {

                            var profile = googleUser.getBasicProfile();
                            var name    = profile.getName();
                            var email   = profile.getEmail();

                            if (window.is_google_loggedin) {

                                var id_token = googleUser.getAuthResponse().id_token;

                                $.ajax({
                                    url: window.ElementPackConfig.ajaxurl,
                                    method: 'post',
                                    data: {
                                        action: 'element_pack_social_google_login',
                                        id_token: id_token
                                    },
                                    dataType: 'json',
                                    beforeSend: function (xhr) {
                                        bdtUIkit.notification({
                                            message: '<div bdt-spinner></div> ' + element_pack_ajax_login_config.loadingmessage,
                                            timeout: false
                                        });
                                    },
                                    success: function (data) {
                                        if (data.success === true) {
                                            if (undefined === redirect_url) {
                                                location.reload();
                                            } else {
                                                window.location = redirect_url;
                                            }
                                        }
                                    },
                                    complete: function (xhr, status) {
                                        bdtUIkit.notification.closeAll();
                                    }

                                });
                            }

                        }, function (error) {
                            // error here
                        }
                    );

                });

                google_button.on('click', function () {
                    window.is_google_loggedin = true;
                });
            }
        };


        jQuery(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-login.default', widgetUserLoginFormHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-login.bdt-dropdown', widgetUserLoginFormHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-login.bdt-modal', widgetUserLoginFormHandler);
        });

    }(jQuery, window.elementorFrontend));

/**
 * End user login widget script
 */


/**
 * Start user register widget script
 */

( function ($, elementor) {

    'use strict';

    var widgetUserRegistrationForm = {

        registraitonFormSubmit: function (_this, $scope) {

            bdtUIkit.notification({
                message: '<div bdt-spinner></div>' + $(_this).find('.bdt_spinner_message').val(),
                timeout: false
            });
            $(_this).find('button.bdt-button').attr("disabled", true);
            var redirect_url = $(_this).find('.redirect_after_register').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: element_pack_ajax_login_config.ajaxurl,
                data: {
                    'action': 'element_pack_ajax_register', //calls wp_ajax_nopriv_element_pack_ajax_register
                    'first_name': $(_this).find('.first_name').val(),
                    'last_name': $(_this).find('.last_name').val(),
                    'email': $(_this).find('.user_email').val(),
                    'password': $(_this).find('.user_password').val(),
                    'is_password_required': $(_this).find('.is_password_required').val(),
                    'g-recaptcha-response': $(_this).find('#g-recaptcha-response').val(),
                    'widget_id': $scope.data('id'),
                    'page_id': $(_this).find('.page_id').val(),
                    'security': $(_this).find('#bdt-user-register-sc').val(),
                    'lang': element_pack_ajax_login_config.language
                },
                success: function (data) {

                    var recaptcha_field = _this.find('.element-pack-google-recaptcha');
                    if (recaptcha_field.length > 0) {
                        var recaptcha_id = recaptcha_field.attr('data-widgetid');
                        grecaptcha.reset(recaptcha_id);
                        grecaptcha.execute(recaptcha_id);
                    }

                    if (data.registered === true) {
                        bdtUIkit.notification.closeAll();
                        bdtUIkit.notification({
                            message: '<div class="bdt-flex"><span bdt-icon=\'icon: info\'></span><span>' + data.message + '</span></div>',
                            status: 'primary'
                        });
                        if (redirect_url) {
                            document.location.href = redirect_url;
                        }
                    } else {
                        bdtUIkit.notification.closeAll();
                        bdtUIkit.notification({
                            message: '<div class="bdt-flex"><span bdt-icon=\'icon: warning\'></span><span>' + data.message + '</span></div>',
                            status: 'warning'
                        });
                    }
                    $(_this).find('button.bdt-button').attr("disabled", false);

                },
            });
        },
        load_recaptcha: function () {
            var reCaptchaFields = $('.element-pack-google-recaptcha'), widgetID;

            if (reCaptchaFields.length > 0) {
                reCaptchaFields.each(function () {
                    var self = $(this),
                        attrWidget = self.attr('data-widgetid');
                    // alert(self.data('sitekey'))
                    // Avoid re-rendering as it's throwing API error
                    if (( typeof attrWidget !== typeof undefined && attrWidget !== false )) {
                        return;
                    } else {
                        widgetID = grecaptcha.render($(this).attr('id'), {
                            sitekey: self.data('sitekey'),
                            callback: function (response) {
                                if (response !== '') {
                                    self.append(jQuery('<input>', {
                                        type: 'hidden',
                                        value: response,
                                        class: 'g-recaptcha-response'
                                    }));
                                }
                            }
                        });
                        self.attr('data-widgetid', widgetID);
                    }
                });
            }
        }

    }


    window.onLoadElementPackRegisterCaptcha = widgetUserRegistrationForm.load_recaptcha;

    var widgetUserRegisterForm = function ($scope, $) {
        var register_form = $scope.find('.bdt-user-register-widget');
        var recaptcha_field = $scope.find('.element-pack-google-recaptcha');

        // Perform AJAX register on form submit
        register_form.on('submit', function (e) {
            e.preventDefault();
            widgetUserRegistrationForm.registraitonFormSubmit(register_form, $scope)
        });

        if (elementorFrontend.isEditMode() && undefined === recaptcha_field.attr('data-widgetid')) {
            onLoadElementPackRegisterCaptcha();
        }

        if (recaptcha_field.length > 0) {
            grecaptcha.ready(function () {
                var recaptcha_id = recaptcha_field.attr('data-widgetid');
                grecaptcha.execute(recaptcha_id);
            });
        }
    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-register.default', widgetUserRegisterForm);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-register.bdt-dropdown', widgetUserRegisterForm);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-user-register.bdt-modal', widgetUserRegisterForm);
    });

}(jQuery, window.elementorFrontend) );

/**
 * End user register widget script
 */


/**
 * Start honeycombs widget script
 */

(function($, elementor) {
    'use strict';
    var widgetHoneycombs = function($scope, $) {
        var $honeycombsArea = $scope.find('.bdt-honeycombs-area'),
        $honeycombs = $honeycombsArea.find('.bdt-honeycombs');
        if (!$honeycombsArea.length) {
            return;
        }
        var $settings = $honeycombs.data('settings');

        $($honeycombs).honeycombs({
            combWidth: $settings.width,
            margin: $settings.margin,
            threshold: 3,
            widthTablet: $settings.width_tablet,
            widthMobile : $settings.width_mobile,
            viewportLg : $settings.viewport_lg,
            viewportMd : $settings.viewport_md
        });

        //loaded class for better showing
        $($honeycombs).addClass('honeycombs-loaded');



    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-honeycombs.default', widgetHoneycombs);
    });
}(jQuery, window.elementorFrontend));

/**
 * End honeycombs widget script
 */


/**
 * Start step flow widget script
 */

(function($, elementor) {

    'use strict';

    // Accordion
    var widgetStepFlow = function($scope, $) {

        var $avdDivider = $scope.find('.bdt-step-flow'),
            divider = $($avdDivider).find('.bdt-title-separator-wrapper > img');

        if (!$avdDivider.length) {
            return;
        }

        elementorFrontend.waypoint(divider, function() {
            bdtUIkit.svg(this, {
                strokeAnimation: true
            });
        }, {
            offset: 'bottom-in-view'
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-step-flow.default', widgetStepFlow);
    });

}(jQuery, window.elementorFrontend));

/**
 * End step flow widget script
 */


/**
 * Start advanced divider widget script
 */

(function($, elementor) {
    'use strict'; 
    var widgetBusinessHours = function($scope, $) {
        var $businessHoursContainer = $scope.find('.bdt-business-hours'),
        $businessHours = $businessHoursContainer.find('.bdt-business-hours-current-time');
        if (!$businessHoursContainer.length) {
            return;
        }
        var $settings = $businessHoursContainer.data('settings');
        var dynamic_timezone = $settings.dynamic_timezone;
        var timeNotation = $settings.timeNotation;
        var business_hour_style = $settings.business_hour_style;

        if (business_hour_style != 'dynamic') return;

        $(document).ready(function() {
            var offset_val;
            var timeFormat = '%H:%M:%S', timeZoneFormat; 
            var dynamic_timezone = $settings.dynamic_timezone;
            
            if(business_hour_style == 'static'){
                offset_val = $settings.dynamic_timezone_default;
            }else{
                offset_val = dynamic_timezone;
            }

            // console.log(offset_val);
            if(timeNotation == '12h'){
                timeFormat = '%I:%M:%S %p';
            } 
            if (offset_val == '') return;
            var options = {
                // format:'<span class=\"dt\">%A, %d %B %I:%M:%S %P</span>',
                //    format:'<span class=\"dt\">  %I:%M:%S </span>',
                format: timeFormat,
                timeNotation: timeNotation, //'24h',
                am_pm: true,
                utc: true,
                utc_offset: offset_val
            }
            $($businessHoursContainer).find('.bdt-business-hours-current-time').jclock(options);

        });

    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-business-hours.default', widgetBusinessHours);
    });
}(jQuery, window.elementorFrontend));

/**
 * End business hours widget script
 */


/**
 * Start interactive card widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetInteractiveCard = function ($scope, $) {
        var $i_card_main = $scope.find('.bdt-interactive-card');

        if ( !$i_card_main.length ) {
            return;
        }
        var $settings = $i_card_main.data('settings');

        if ( $($settings).length ) {
            var myWave = wavify(document.querySelector('#' + $settings.id), {
                height   : 60,
                bones    : $settings.wave_bones, //3
                amplitude: $settings.wave_amplitude, //40
                speed    : $settings.wave_speed //.25
            });

            setTimeout(function(){
                $($i_card_main).addClass('bdt-wavify-active');
            }, 1000);
        }
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-interactive-card.default', widgetInteractiveCard);
    });

}(jQuery, window.elementorFrontend));

/**
 * End interactive card widget script
 */


/**
 * Start image expand widget script
 */ 

(function ($, elementor) {

    'use strict'; 

    var widgetImageExpand = function ($scope, $) {

        var $imageExpand = $scope.find('.bdt-image-expand'),
        $settings    = $imageExpand.data('settings');

        var wideitem = document.querySelectorAll('#' + $settings.wide_id + ' .bdt-image-expand-item');

        $(wideitem).click(function () {
            $(this).toggleClass('active');
            $('body').addClass('bdt-image-expanded');
        });

        $(document).on('click', 'body.bdt-image-expanded', function (e) {
            if ( e.target.$imageExpand == 'bdt-image-expand' || $(e.target).closest('.bdt-image-expand').length ) {
            } else {
                $('.bdt-image-expand-item').removeClass('active');
                
                $($imageExpand).find('.bdt-image-expand-item .bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);
                $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-animation-slide-bottom');
            }
        });

        if ( $settings.animation_status == 'yes' ) {

            $($imageExpand).find('.bdt-image-expand-item').each(function (i, e) {

                var self              = $(this),
                $quote            = self.find($settings.animation_of),
                mySplitText       = new SplitText($quote, {
                    type: 'chars, words, lines'
                }),
                splitTextTimeline = gsap.timeline();

                gsap.set($quote, {
                    perspective: 400 
                });

                function kill() {
                    splitTextTimeline.clear().time(0);
                    mySplitText.revert();
                }

                $(this).on('click', function () {
                    $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-animation-slide-bottom');
                    $($imageExpand).find('.bdt-image-expand-button').addClass('bdt-invisible');
                    setTimeout(function () {

                        kill();
                        mySplitText.split({
                            type: 'chars, words, lines'
                        });
                        var stringType = '';


                        if ( 'lines' == $settings.animation_on ) {
                            stringType = mySplitText.lines;
                        } else if ( 'chars' == $settings.animation_on ) {
                            stringType = mySplitText.chars;
                        } else {
                            stringType = mySplitText.words;
                        }

                        splitTextTimeline.staggerFrom(stringType, 0.5,{
                            opacity        : 0,
                            scale          : $settings.anim_scale, //0
                            y              : $settings.anim_rotation_y, //80
                            rotationX      : $settings.anim_rotation_x, //180
                            transformOrigin: $settings.anim_transform_origin, //0% 50% -50  
                        }, 0.1).then(function(){
                            $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-invisible');
                            $($imageExpand).find('.bdt-image-expand-item.active .bdt-image-expand-button').addClass('bdt-animation-slide-bottom');
                        });

                        splitTextTimeline.play();
                    }, 1000);


                });

            });

        }else{
            $($imageExpand).on('click', '.bdt-image-expand-item', function (e) {
            // $($imageExpand).find('.bdt-image-expand-item').on('click', function (e) {
                var thisInstance = $(this).attr('id'); 
                $('#'+thisInstance).siblings('.bdt-image-expand-item').find('.bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);
                $('#'+thisInstance).find('.bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);       
                setTimeout(function () {
                   $('#'+thisInstance+'.active').find('.bdt-image-expand-content *').addClass('bdt-animation-'+$settings.default_animation_type);
               }, 1000);
            });
        }


    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-image-expand.default', widgetImageExpand);
    });

}(jQuery, window.elementorFrontend));

/**
 * End image expand widget script
 */


/**
 * Start hover video widget script
 */

 (function ($, elementor) {
    'use strict';

    // check video buffer 

    function videoBufferChecker(videoId) {
        var checkInterval = 50.0; // check every 50 ms (do not use lower values)
        var lastPlayPos = 0;
        var currentPlayPos = 0;
        var bufferingDetected = false;
        var player = document.getElementById(videoId);

        setInterval(checkBuffering, checkInterval)

        function checkBuffering() {
            currentPlayPos = player.currentTime;

            // checking offset should be at most the check interval
            // but allow for some margin
            var offset = (checkInterval - 20) / 2000;

            // if no buffering is currently detected,
            // and the position does not seem to increase
            // and the player isn't manually paused...
            if (!bufferingDetected &&
                currentPlayPos < (lastPlayPos + offset) &&
                !player.paused
                ) {
                // console.log("buffering = " + videoId);
            $('#' + videoId).closest('.bdt-hover-video').find('.hover-video-loader').addClass('active');

            bufferingDetected = true;
        }

            // if we were buffering but the player has advanced,
            // then there is no buffering
            if (
                bufferingDetected &&
                currentPlayPos > (lastPlayPos + offset) &&
                !player.paused
                ) {
                // console.log("not buffering anymore = " + videoId);
            $('#' + videoId).closest('.bdt-hover-video').find('.hover-video-loader').removeClass('active');
            bufferingDetected = false
        }
        lastPlayPos = currentPlayPos


    }
}


var widgetDefaultSkin = function ($scope, $) {
    var $instaVideo = $scope.find('.bdt-hover-video'),
    $settings = $instaVideo.data('settings');
    
    if (!$instaVideo.length) {
        return;
    }

    var video = $($instaVideo).find('.bdt-hover-wrapper-list  video');
    var videoProgress;
    setInterval(function () {
        videoProgress = $('.bdt-hover-progress.active');
    }, 100);

    $(video).on('mouseenter click', function (e) {

        if($settings.videoReplay == 'yes'){
            $(this)[0].currentTime = 0; 
        }

        $(this).trigger('play');

        videoBufferChecker($(this).attr('id'));

        var video = $($instaVideo).find('.bdt-hover-video  .bdt-hover-wrapper-list  video');

        var thisId = $(this).attr('id');

        $('#' + thisId).on('ended', function () {
            setTimeout(function (a) {
                $('#' + thisId).trigger('play');

                videoBufferChecker(thisId);

            }, 1500);
        });
    });


    $(video).on('mouseout', function (e) {
        // $(this).trigger('pause');

        if ($settings.posterAgain == 'yes') {
           $(this)[0].currentTime = 0;
           $(this).trigger('load');
        }else{
            $(this).trigger('pause');
        }
    });

    $(video).on('timeupdate', function () {
        var videoBarList = $(video).parent().find('video.active').attr('id');
        var ct = document.getElementById(videoBarList).currentTime;
        var dur = document.getElementById(videoBarList).duration;

        var videoProgressPos = ct / dur;
        $($instaVideo).find('.bdt-hover-bar-list').find("[data-id=" + videoBarList + "]").width(videoProgressPos * 100 + "%");
        $($instaVideo).find('.bdt-hover-btn-wrapper').find(".bdt-hover-progress[data-id=" + videoBarList + "]").width(videoProgressPos * 100 + "%");

            // if (video.ended) {
            // }


        });

    if ($($instaVideo).find('.autoplay').length > 0) {
        $($instaVideo).find(".bdt-hover-wrapper-list  video:first-child").trigger('play');

    }

    if ($($instaVideo).find('.autoplay').length > 0) {
        var playingVideo = $(video).parent().find('video.active');

        $(video).on('timeupdate', function () {
            playingVideo = $(video).parent().find('video.active');
        });

        setInterval(function () {
            $(playingVideo).on('ended', function () {

                var nextVideoId = $(playingVideo).next().attr('id');

                $('#' + nextVideoId).siblings().css("display", 'none').removeClass('active');
                $('#' + nextVideoId).css("display", 'block').addClass('active');

                $('#' + nextVideoId).trigger('play');


                if ($(playingVideo).next('video').length > 0) {
                    var firstVideo = $(playingVideo).siblings().first().attr('id');
                    $($instaVideo).find("[data-id=" + firstVideo + "]").closest('.bdt-hover-bar-list').find('.bdt-hover-progress').width(0 + '%');

                    $($instaVideo).find('.bdt-hover-btn-wrapper').find("[data-id=" + nextVideoId + "]").siblings().removeClass('active');
                    $($instaVideo).find('.bdt-hover-btn-wrapper').find("[data-id=" + nextVideoId + "]").addClass('active');

                    $($instaVideo).find('.bdt-hover-btn-wrapper').find(".bdt-hover-progress").width("0%");

                } else {
                    var firstVideo = $(playingVideo).siblings().first().attr('id');
                        // console.log("Dont exists"+firstVideo);
                        $('#' + firstVideo).siblings().css("display", 'none').removeClass('active');
                        $('#' + firstVideo).css("display", 'block').addClass('active');
                        $($instaVideo).find("[data-id=" + firstVideo + "]").closest('.bdt-hover-bar-list').find('.bdt-hover-progress').width(0 + '%');


                        $($instaVideo).find('.bdt-hover-btn-wrapper').find("[data-id=" + firstVideo + "]").siblings().removeClass('active');
                        $($instaVideo).find('.bdt-hover-btn-wrapper').find("[data-id=" + firstVideo + "]").addClass('active');

                        $($instaVideo).find('.bdt-hover-btn-wrapper').find(".bdt-hover-progress").width("0%");

                        $('#' + firstVideo).trigger('play');

                    }

                });
        }, 1000);

    }



    $('#'+$settings.id).find('.bdt-hover-btn').on('mouseenter click', function () {
        var videoId = $(this).attr('data-id');

        if($settings.videoReplay == 'yes'){
            $('#'+videoId)[0].currentTime = 0;
        }


        $('#' + videoId).trigger('play');

        videoBufferChecker(videoId);

        $('#' + videoId).siblings().css("display", 'none').removeClass('active');
        $('#' + videoId).css("display", 'block').addClass('active');
        $('.bdt-hover-bar-list .bdt-hover-progress').removeClass('active');
        $('.bdt-hover-bar-list').find("[data-id=" + videoId + "]").addClass('active');

        $('.bdt-hover-btn-wrapper').find("[data-id=" + videoId + "]")
        .siblings().removeClass('active');
        $('.bdt-hover-btn-wrapper').find("[data-id=" + videoId + "]")
        .addClass('active');


    });




};

var widgetVideoAccordion = function ($scope, $) {
    var $videoAccordion = $scope.find('.bdt-hover-video'),
    $settings = $videoAccordion.data('settings');

    if (!$videoAccordion.length) {
        return;
    }

    var video = $($videoAccordion).find('.bdt-hover-wrapper-list  video');

    var videoProgress;
    setInterval(function () {
        videoProgress = $('.bdt-hover-progress.active');
    }, 100);

    $(video).on('timeupdate', function () {
        var videoBarList = $(video).parent().find('video.active').attr('id');
        var ct = document.getElementById(videoBarList).currentTime;
        var dur = document.getElementById(videoBarList).duration;
        var videoProgressPos = ct / dur;
        $('.bdt-hover-bar-list').find("[data-id=" + videoBarList + "]").width(videoProgressPos * 100 + "%");
            // if (video.ended) {
            // }
        });

        // start autoplay 
        if ($($videoAccordion).find('.autoplay').length > 0) {
            $($videoAccordion).find(".hover-video-list  video:first-child").trigger('play');
        }

        if ($($videoAccordion).find('.autoplay').length > 0) {
            var playingVideo = $(video).parent().find('video.active');

            $(video).on('timeupdate', function () {
                playingVideo = $(video).parent().find('video.active');
            });

            setInterval(function () {
                $(playingVideo).on('ended', function () {

                    var nextVideoId = $(playingVideo).next().attr('id');

                    $('#' + nextVideoId).siblings().css("display", 'none').removeClass('active');
                    $('#' + nextVideoId).css("display", 'block').addClass('active');

                    // console.log('playingVideo = '+ $(playingVideo).attr('id'));

                    $('#' + nextVideoId).trigger('play');

                    if ($(playingVideo).next('video').length > 0) {
                        // console.log("Exists");
                        var firstVideo = $(playingVideo).siblings().first().attr('id');
                        $($videoAccordion).find("[data-id=" + firstVideo + "]").closest('.bdt-hover-bar-list').find('.bdt-hover-progress').width(0 + '%');

                    } else {
                        var firstVideo = $(playingVideo).siblings().first().attr('id');
                        // console.log("Dont exists"+firstVideo);
                        $('#' + firstVideo).siblings().css("display", 'none').removeClass('active');
                        $('#' + firstVideo).css("display", 'block').addClass('active');
                        $($videoAccordion).find("[data-id=" + firstVideo + "]").closest('.bdt-hover-bar-list').find('.bdt-hover-progress').width(0 + '%');



                        $('#' + firstVideo).trigger('play');
                    }

                });
            }, 1000);

        }
        // end autoplay 
        
        $('#'+$settings.id).find('.bdt-hover-mask-list .bdt-hover-mask').on('mouseenter click', function () {
            var videoId = $(this).attr('data-id');
            $('#' + videoId).siblings().css("display", 'none').removeClass('active');
            $('#' + videoId).css("display", 'block').addClass('active');
            $('#' + videoId).siblings().trigger('pause'); // play item on active
            
            if($settings.videoReplay == 'yes'){
                $('#'+videoId)[0].currentTime = 0;
                
            }
            
            $('#' + videoId).trigger('play'); // play item on active

            videoBufferChecker(videoId);

            $('.bdt-hover-bar-list .bdt-hover-progress').removeClass('active');
            $('.bdt-hover-bar-list').find("[data-id=" + videoId + "]").addClass('active');

            $('.bdt-hover-mask-list').find("[data-id=" + videoId + "]")
            .siblings().removeClass('active');
            $('.bdt-hover-mask-list').find("[data-id=" + videoId + "]")
            .addClass('active');


            $('#' + videoId).on('ended', function () {
                setTimeout(function (a) {
                    $('#' + videoId).trigger('play');

                    videoBufferChecker(videoId);

                }, 1500);
            });


        });
        $('.bdt-hover-mask-list').on('mouseout', function (e) {
            // $(this).siblings('.bdt-hover-wrapper-list .hover-video-list').find('video').trigger('pause');
            if ($settings.posterAgain == 'yes') {
                     $(this).siblings('.bdt-hover-wrapper-list .hover-video-list').find('video')[0].currentTime = 0;
                     $(this).siblings('.bdt-hover-wrapper-list .hover-video-list').find('video').trigger('load');
            } else {
                $(this).siblings('.bdt-hover-wrapper-list .hover-video-list').find('video').trigger('pause');
            }
        });


    };  
    
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-video.default', widgetDefaultSkin);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-video.accordion', widgetVideoAccordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-hover-video.vertical', widgetVideoAccordion);
    });
}(jQuery, window.elementorFrontend));

/**
 * End hover video widget script
 */
/**
 * Start image accordion widget script
 */

(function($, elementor) {

    'use strict';

    var widgetImageAccordion = function($scope, $) {

        var $imageAccordion = $scope.find('.bdt-image-accordion'),
            $settings = $imageAccordion.data('settings');

        var accordionItem = $imageAccordion.find('.bdt-image-accordion-item');
        var totalItems = $imageAccordion.children().length;

        if (($settings.activeItem == true) && ($settings.activeItemNumber <= totalItems)) {
            $imageAccordion.find('.bdt-image-accordion-item').removeClass('active');
            $imageAccordion.children().eq($settings.activeItemNumber - 1).addClass('active');
        }


        $(accordionItem).on($settings.mouse_event, function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        if ($settings.activeItem != true) {
            $("body").on($settings.mouse_event, function(e) {
                if (e.target.$imageAccordion == "bdt-image-accordion" || $(e.target).closest(".bdt-image-accordion").length) {} else {
                    $imageAccordion.find('.bdt-image-accordion-item').removeClass('active');
                }
            });
        }
    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-image-accordion.default', widgetImageAccordion);
    });

}(jQuery, window.elementorFrontend));

/**
 * End image accordion widget script
 */
/**
 * Start notification widget script
 */

(function ($, elementor) {

    'use strict';

    // Notification
    var widgetNotification = function ($scope, $) {

        var $avdNotification = $scope.find('.bdt-notification-wrapper');

        if (!$avdNotification.length) {
            return;
        }

        var $settings = $avdNotification.data('settings'),
            id = '#' + $settings.id,
            timeOut = $settings.notifyTimeout,
            notifyType = $settings.notifyType,
            notifyFixPos = $settings.notifyFixPosition,
            editMode = Boolean(elementor.isEditMode());

        if (typeof $settings.notifyTimeout === "undefined") {
            timeOut = null;
        }

        bdtUIkit.util.on(document, 'beforehide', '[bdt-alert]', function (event) {
            if (notifyFixPos === 'top') {
                $('html').attr('style', 'margin-top: unset !important');
            }
        });

        var notification = {
            htmlMarginRemove: function () {
                $('html').css({
                    'margin-top': 'unset  !important'
                });
            },
            appendBody: function () {
                $('body > ' + id).slice(1).remove();
                $(id).prependTo($("body"));
            },
            showNotify: function () {
                $(id).removeClass('bdt-hidden');
            },
            notifyFixed: function () {
                this.htmlMarginRemove();
                setTimeout(function () {
                    if (notifyFixPos == 'top') {
                        var notifyHeight = $('.bdt-notify-wrapper').outerHeight();
                        if ($('.admin-bar').length) {
                            notifyHeight = notifyHeight + 32;
                            $(id).attr('style', 'margin-top: 32px !important');
                        }
                        $('html').attr('style', 'margin-top: ' + notifyHeight + 'px !important');
                        $('html').css({
                            'transition': 'margin-top .8s ease'
                        });
                        $(window).on('resize', function () {
                            notifyHeight = $('.bdt-notify-wrapper').outerHeight();
                            if ($('.admin-bar').length) {
                                notifyHeight = notifyHeight + 32;
                            }
                            $('html').attr('style', 'margin-top: ' + notifyHeight + 'px !important');
                        });
                    }
                }, 1000);
            },
            notifyRelative: function () {
                $('body > ' + id).remove();
            },
            notifyPopup: function () {
                bdtUIkit.notification({
                    message: $settings.msg,
                    status: $settings.notifyStatus,
                    pos: $settings.notifyPosition,
                    timeout: timeOut
                });
            },
            notifyFire: function () {
                if (notifyType === 'fixed') {
                    if (notifyFixPos !== 'relative') {
                        this.appendBody();
                        this.notifyFixed();
                    } else {
                        this.htmlMarginRemove();
                        this.notifyRelative();
                    }
                } else {
                    this.notifyPopup();
                }
            },
            setLocalize: function () {
                if (editMode) {
                    this.clearLocalize();
                    return;
                }
                var widgetID = $settings.id,
                    localVal = 0,
                    hours = $settings.displayTimesExpire;

                var expires = (hours * 60 * 60);
                var now = Date.now();
                var schedule = now + expires * 1000;

                if (localStorage.getItem(widgetID) === null) {
                    localStorage.setItem(widgetID, localVal);
                    localStorage.setItem(widgetID + '_expiresIn', schedule);
                }
                if (localStorage.getItem(widgetID) !== null) {
                    var count = parseInt(localStorage.getItem(widgetID));
                    count++;
                    localStorage.setItem(widgetID, count);
                    // this.clearLocalize();
                }
            },
            clearLocalize: function () {
                var localizeExpiry = parseInt(localStorage.getItem($settings.id + '_expiresIn'));
                var now = Date.now(); //millisecs since epoch time, lets deal only with integer
                var schedule = now;
                if (schedule >= localizeExpiry) {
                    localStorage.removeItem($settings.id + '_expiresIn');
                    localStorage.removeItem($settings.id);
                }
            },
            notificationInit: function () {
                var init = this;

                this.setLocalize();
                var displayTimes = $settings.displayTimes,
                    firedNotify = parseInt(localStorage.getItem($settings.id));

                if ((displayTimes !== false) && (firedNotify > displayTimes)) {
                    return;
                }

                this.showNotify();

                if ($settings.notifyEvent == 'onload' || $settings.notifyEvent == 'inDelay') {
                    $(document).ready(function () {
                        setTimeout(function () {
                            init.notifyFire();
                        }, $settings.notifyInDelay);
                    });
                }
                if ($settings.notifyEvent == 'click' || $settings.notifyEvent == 'mouseover') {
                    $($settings.notifySelector).on($settings.notifyEvent, function () {
                        init.notifyFire();
                    });
                }
            },
        };

        // kick off the notification widget
        notification.notificationInit();

        $('.bdt-notify-wrapper.bdt-position-fixed').on('click', function (e) {
            $('html').attr('style', 'margin-top: unset !important');
            if ($('.admin-bar').length) {
                $('html').attr('style', 'margin-top: 32px !important');
            }
        });
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-notification.default', widgetNotification);
    });

}(jQuery, window.elementorFrontend));

/**
 * End notification widget script
 */
/**
 * Start tags cloud widget script
 */

(function($, elementor) {

    'use strict';

    var widgetTagsCloud = function($scope, $) {
        var $tags_cloud = $scope.find('.bdt-tags-cloud');
            
            if (!$tags_cloud.length) {
                return;
            }
            var $settings = $tags_cloud.data('settings');
            var $tags_color = $settings.basic_tags_bg_type;
            var tags_color_solid = $settings.basic_tags_solid_bg;
 

            jQuery.fn.prettyTag = function (options) {

                var setting = jQuery.extend({
                        randomColor: true, //false to off random color
                        tagicon: true, //false to turn off tags icon
                        tags_color: options.tags_color
                    }, options);


                return this.each(function () {
                    var target = this;
                        //add font awesome icon
                        if (setting.tagicon == true) {
                            var eachTag = $(target).find("a");
                            var ti = document.createElement("i");
                            $($tags_cloud).find(ti).addClass("fas fa-tags").prependTo(eachTag);
                        }

                        if( setting.tags_color == 'random' ){
                            coloredTags();
                        }else{
                            if (typeof(tags_color_solid) != "undefined"){
                                $($tags_cloud).find('.bdt-tags-list li a').css('background-color', tags_color_solid); 
                            }else{
                               $($tags_cloud).find('.bdt-tags-list li a').css('background-color', '#3FB8FD'); 
                           }
                       }

                        //function to make tags colorful
                        function coloredTags() {

                        var totalTags = $($tags_cloud).find("li").length; //to find total cloud tags
                        // console.log(totalTags);
                        var mct = $($tags_cloud).find("a"); //select all tags links to make them colorful
                        /*Array of Colors */
                        var tagColor = ["#ff0084", "#ff66ff", "#43cea2", "#D38312", "#73C8A9", "#9D50BB",
                        "#780206", "#FF4E50", "#ADD100",
                        "#0F2027", "#00c6ff", "#81D8D0", "#5CB3FF", "#95B9C7", "#C11B17", "#3B9C9C", "#FF7F50", "#FFD801", "#79BAEC", "#F660AB", "#3D3C3A", "#3EA055"
                        ];

                        var tag = 0;
                        var color = 0; //assign colors to tags with loop, unlimited number of tags can be added
                        do {
                            if (color > 21) {
                                color = 0;
                        } //Start again array index if it reaches at last

                        if (setting.randomColor == true) {
                            var $rc = Math.floor(Math.random() * 22);
                            $(mct).eq(tag).css({
                            //tags random color
                            'background': tagColor[$rc]
                        });
                        } else {
                            $(mct).eq(tag).css({
                        //tags color in a sequence
                        'background': tagColor[color]
                    });
                        }
                        tag++;
                        color++;
                    } while (tag <= totalTags)

                }
            });
            };


            /*   End */

            $($tags_cloud).find(".bdt-tags-list").prettyTag({'tags_color': $tags_color});

        };


        var widgetSkinAnimated = function($scope, $) {
            var $tags_globe = $scope.find('.bdt-tags-cloud');
            if (!$tags_globe.length) {
                return;
            }
            var $settings = $tags_globe.data('settings');
 
                try {
                    TagCanvas.Start($settings.idmyCanvas, $settings.idTags, { 
                        textColour         :  $settings.textColour,
                        outlineColour      :  $settings.outlineColour,
                        reverse            :  true,
                        depth              :  $settings.depth, 
                        maxSpeed           :  $settings.maxSpeed, 
                        activeCursor       :  $settings.activeCursor,
                        bgColour           :  $settings.bgColour, 
                        bgOutlineThickness :  $settings.bgOutlineThickness, 
                        bgRadius           :  $settings.bgRadius, 
                        dragControl        :  $settings.dragControl, 
                        fadeIn             :  $settings.fadeIn, 
                        freezeActive       :  $settings.freezeActive,
                        outlineDash        :  $settings.outlineDash,
                        outlineDashSpace   :  $settings.globe_outline_dash_space,
                        outlineDashSpeed   :  $settings.globe_outline_dash_speed,
                        outlineIncrease    :  $settings.outlineIncrease,
                        outlineMethod      :  $settings.outlineMethod, 
                        outlineRadius      :  $settings.outlineRadius,
                        outlineThickness   :  $settings.outlineThickness,
                        shadow             :  $settings.shadow,
                        shadowBlur         :  $settings.shadowBlur,
                        wheelZoom          :  $settings.wheelZoom

                    });
                } catch (e) {
                    document.getElementById($settings.idCanvas).style.display = 'none';
                }
           
        };


        var widgetSkinCloud = function($scope, $) {
            var $tags_cloud = $scope.find('.bdt-tags-cloud');

            if (!$tags_cloud.length) {
                return;
            }
            var $settings = $tags_cloud.data('settings');

            jQuery(document).ready(function($) {
                function resizeAwesomeCloud() {
                    jQuery("#"+$settings.idCloud).awesomeCloud({
                        "size": {
                            "grid": 9,
                            "factor": 1
                        },
                        "color" : {
                        "background" : "rgba(156,145,255,0)", // background color, transparent by default
                        // "background" : "rgba(156,145,255,0)", // background color, transparent by default
                        "start" : "#20f", // color of the smallest font, if options.color = "gradient""
                        "end" : "rgb(200,0,0)" // color of the largest font, if options.color = "gradient"
                    },
                    "options": {
                        "background" :"rgba(165,184,255,0)",
                        "color": $settings.cloudColor,  
                            "sort": "highest" // highest, lowest or random
                        },
                        "font": "'Times New Roman', Times, serif",
                        "shape": $settings.cloudStyle // default 
                    });
                }
                resizeAwesomeCloud();
                jQuery(window).on("resize", function($) { 
                    jQuery($tags_cloud).find('#awesomeCloud'+$settings.idCloud).remove();
                    resizeAwesomeCloud();
                });
            });

        };


        jQuery(window).on('elementor/frontend/init', function() {
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tags-cloud.default', widgetTagsCloud);
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tags-cloud.bdt-animated', widgetSkinAnimated); 
            elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tags-cloud.bdt-cloud', widgetSkinCloud); 
        });

    }(jQuery, window.elementorFrontend));

/**
 * End tags cloud widget script
 */

 
/**
* Start Dark Mode widget script
*/

$window.on('elementor/frontend/init', function () {
    var ModuleHandler = elementorModules.frontend.handlers.Base,
        widgetDarkMode;

    widgetDarkMode = ModuleHandler.extend({

        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                left: 'unset',
                time: '.5s',
                mixColor: '#fff',
                backgroundColor: '#fff',
                saveInCookies: false,
                label: '🌓',
                autoMatchOsTheme: false
            };
        },



        onElementChange: debounce(function (prop) {
            // if (prop.indexOf('time.size') !== -1) {
            this.run();
            // } 
        }, 400),

        settings: function (key) {
            return this.getElementSettings(key);
        },

        setCookie: function (name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        },
        getCookie: function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },

        eraseCookie: function (name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        },



        run: function () {
            var options = this.getDefaultSettings(),
                element = this.findElement('.elementor-widget-container').get(0);

            var autoMatchOsTheme = (this.settings('autoMatchOsTheme') == 'yes'
                && this.settings('autoMatchOsTheme') !== 'undefined') ? true : false;

            var saveInCookies = (this.settings('saveInCookies') == 'yes'
                && this.settings('saveInCookies') !== 'undefined') ? true : false;

            options.left = 'unset';
            options.time = this.settings('time.size') / 1000 + 's';
            options.mixColor = this.settings('mix_color');
            options.backgroundColor = this.settings('default_background');
            options.saveInCookies = saveInCookies;
            options.label = '🌓';
            options.autoMatchOsTheme = autoMatchOsTheme;

            $('body').removeClass(function (index, css) {
                return (css.match(/\bbdt-dark-mode-\S+/g) || []).join(' '); // removes anything that starts with "page-"
            });
            $('body').addClass('bdt-dark-mode-position-' + this.settings('toggle_position'));

            $(this.settings('ignore_element')).addClass('ignore-element');

            if (options.mixColor) {

                $('.darkmode-toggle, .darkmode-layer, .darkmode-background').remove();

                var darkmode = new Darkmode(options);
                darkmode.showWidget();

                if (this.settings('default_mode') == 'dark') {
                    darkmode.toggle();
                    $('body').addClass('darkmode--activated');
                    $('.darkmode-layer').addClass('darkmode-layer--simple darkmode-layer--expanded');
                    // console.log(darkmode.isActivated()) // will return true
                } else {
                    $('body').removeClass('darkmode--activated');
                    $('.darkmode-layer').removeClass('darkmode-layer--simple darkmode-layer--expanded');
                    // console.log(darkmode.isActivated()) // will return true
                }

                var global_this = this,
                    editMode = $('body').hasClass('elementor-editor-active');

                if (editMode === false && saveInCookies === true) {
                    $('.darkmode-toggle').on('click', function () {
                        if (darkmode.isActivated() == true) {
                            global_this.eraseCookie('bdtDarkModeUserAction');
                            global_this.setCookie('bdtDarkModeUserAction', 'dark', 10);
                        } else if (darkmode.isActivated() == false) {
                            global_this.eraseCookie('bdtDarkModeUserAction');
                            global_this.setCookie('bdtDarkModeUserAction', 'light', 10);
                        } else {

                        }
                    });

                    var userCookie = this.getCookie('bdtDarkModeUserAction')

                    if (userCookie !== null && userCookie !== 'undefined') {
                        if (userCookie == 'dark') {
                            darkmode.toggle();
                            $('body').addClass('darkmode--activated');
                            $('.darkmode-layer').addClass('darkmode-layer--simple darkmode-layer--expanded');
                        } else {
                            $('body').removeClass('darkmode--activated');
                            $('.darkmode-layer').removeClass('darkmode-layer--simple darkmode-layer--expanded');
                        }
                        
                    }
                }

            }


        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/bdt-dark-mode.default', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(widgetDarkMode, { $element: $scope });

    });
});


/**
 * End Dark Mode widget script
 */
/**
 * Start coupon reveal widget script
 */ 
(function ($, elementor) {
    'use strict';
    var widgetCoupon = function ($scope, $) {
        var $widgetContainer = $scope.find('.bdt-coupon-code'),
            editMode = Boolean(elementor.isEditMode()),
            $couponExecuted = false;
        if (!$widgetContainer.length) {
            return;
        }
        var $settings = $widgetContainer.data('settings'),
            triggerURL = $settings.triggerURL;

        if ($settings.triggerByAction != true) {
            var clipboard = new ClipboardJS($settings.couponMsgId, {
                target: function (trigger) {
                    // $trigger.nextElementSibling.addClass('bdt-coupon-showing');
                    return trigger.nextElementSibling;
                }
            });

            clipboard.on('success', function (event) {
                $(event.trigger).addClass('active');

                event.clearSelection();
                setTimeout(function () {
                    $(event.trigger).removeClass('active');
                    // $($settings.couponId).removeClass('bdt-coupon-showing');
                }, 3000);
            });
        }

        if (($settings.couponLayout == 'style-2') && ($settings.triggerByAction == true)) {
            var clipboard = new ClipboardJS($settings.couponId, {
                target: function (trigger) {
                    return trigger;
                }
            });

            clipboard.on('success', function (event) {
                $widgetContainer.find($settings.couponId).addClass('active');
                event.clearSelection();
                setTimeout(function () {
                    $widgetContainer.find($settings.couponId).removeClass('active');
                }, 2000);
            });

            //   attention
            $widgetContainer.on('click', function () {
                if (!$widgetContainer.hasClass('active') && ($settings.triggerAttention != false)) {
                    var $triggerSelector = $settings.triggerInputId;
                    $('[name="' + $triggerSelector.substring(1) + '"]').closest('form').addClass('ep-shake-animation-cc');
                    setTimeout(function () {
                        $('[name="' + $triggerSelector.substring(1) + '"]').closest('form').removeClass('ep-shake-animation-cc');
                    }, 5000);
                }
                
            });
        }

        var couponObj = {
            decodeCoupon: function (data) {
                jQuery.ajax({
                    url: $settings.adminAjaxURL,
                    type: 'post',
                    data: {
                        action: 'element_pack_coupon_code',
                        coupon_code: data
                    },
                    success: function (couponCode) {
                        $($settings.couponId).find('.bdt-coupon-code-text').html(couponCode);
                    },
                    error: function () {
                        $($settings.couponId).html('Something wrong, please contact support team.');
                    }
                });
            },
            displayCoupon: function ($widgetContainer) {
                $widgetContainer.addClass('active');

            },
            triggerURL: function (triggerURL) {
                var redirectWindow = window.open(triggerURL, '_blank');
                if (triggerURL) {
                    redirectWindow.location;
                }
                return false;
            },
            formSubmitted: function () {
                this.displayCoupon($widgetContainer);
                if (triggerURL !== false) {
                    this.triggerURL(triggerURL);
                }
                this.decodeCoupon($settings.couponCode);
                $couponExecuted = true;
            }
        };


        $widgetContainer.on('click', function () {
            if (!$widgetContainer.hasClass('active') && ($settings.triggerByAction !== true)) {
                couponObj.displayCoupon($widgetContainer);
                if (triggerURL !== false) {
                    setTimeout(function () {
                        couponObj.triggerURL(triggerURL);
                    }, 2000);
                }
            }
        });

        if (!editMode) {
            var triggerInput = $settings.triggerInputId;
            $(document).ajaxComplete(function (event, jqxhr, settings) {
                if (!$couponExecuted) {
                    if ((triggerInput !== false) && ($settings.triggerByAction === true)) {
                        var str = settings.data;
                        // console.log(str);
                        if (str.toLowerCase().indexOf(triggerInput.substring(1)) >= 0) {
                            couponObj.formSubmitted();
                        }
                    } else {
                        if ($settings.triggerByAction === true) {
                            couponObj.formSubmitted();
                        }
                    }
                }

            });

        }

    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-coupon-code.default', widgetCoupon);
    });

}(jQuery, window.elementorFrontend));

/**
 * End coupon reveal widget script
 */
/**
 * Start bdt advanced image gallery widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetAdvancedImageGallery = function ($scope, $) {

        var $advancedImageGallery = $scope.find('.bdt-advanced-image-gallery'),
            $settings = $advancedImageGallery.data('settings');

        if (!$advancedImageGallery.length) {
            return;
        }

        if ($settings.tiltShow == true) {
            var elements = document.querySelectorAll($settings.id + " [data-tilt]");
            VanillaTilt.init(elements);
        }

    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-image-gallery.default', widgetAdvancedImageGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-image-gallery.bdt-carousel', widgetAdvancedImageGallery);
    });

}(jQuery, window.elementorFrontend));

/**
 * End bdt advanced image gallery widget script
 */ 
/**
 * Start bdt custom gallery widget script
 */

(function($, elementor) {

    'use strict';

    var widgetCustomGallery = function($scope, $) {

        var $customGallery = $scope.find('.bdt-custom-gallery'),
            $settings 	= $customGallery.data('settings');
          
        if (!$customGallery.length) {
            return;
        }

        if ($settings.tiltShow == true) {
            var elements = document.querySelectorAll($settings.id + " [data-tilt]");
            VanillaTilt.init(elements);
        }

    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-custom-gallery.default', widgetCustomGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-custom-gallery.bdt-abetis', widgetCustomGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-custom-gallery.bdt-fedara', widgetCustomGallery);
    });

}(jQuery, window.elementorFrontend));

/**
 * End bdt custom gallery widget script
 */


/**
 * Start weather widget script
 */
 
(function($, elementor) {
    'use strict';
    var widgetWeather = function($scope, $) {
        var $weatherContainer = $scope.find('.bdt-weather');
        if (!$weatherContainer.length) {
            return;
        }
        var $settings = $weatherContainer.data('settings');
        var $weather = $($settings.id).closest('.elementor-widget-container');

        if ($settings.dynamicBG !== false){
            $($weather).css('background-image', 'url(' + $settings.url + ')');
            $($weather).css({
                'background-size': 'cover',
                'background-position': 'center center',
                'background-repeat': 'no-repeat'
            });
            
        }
        

    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-weather.default', widgetWeather);
    });

}(jQuery, window.elementorFrontend));

/**
 * End weather widget script
 */
/**
 * Start custom calculator widget script
 */

(function ($, elementor) {
    'use strict';
    var widgetCCalculator = function ($scope, $) {
        var $customCalculator = $scope.find('.bdt-advanced-calculator'),
            $settings = $customCalculator.data('settings');

        if (!$customCalculator.length) {
            return;
        }

        // start main js
        function getVarableDataArray() {
            let data = [],
                variableIndex,
                onlyValueArray = [],
                formulaString = "",
                getIsRealValue,
                radioNameArrayStack = []; // radioNameArrayStack is for escaping duplicating value of radio button
            $.each(
                $($settings.id).find(
                    ".bdt-ep-field-wrap input[type=text], .bdt-ep-field-wrap input[type=hidden], .bdt-ep-field-wrap input[type=checkbox], .bdt-ep-field-wrap input[type=radio], .bdt-ep-field-wrap input[type=number], .bdt-ep-field-wrap select"
                ),
                function (index, item) {
                    variableIndex = parseInt(index) + 1;
                    let itemValue = parseInt($(item).val());
                    if ($(item).prop("type") === "radio") {
                        let currentRadioButtonName = $(item).attr('name');
                        if ($("input[name='" + currentRadioButtonName + "']").is(":checked") === true && radioNameArrayStack.indexOf(currentRadioButtonName) < 0) {
                            radioNameArrayStack.push(currentRadioButtonName);
                            getIsRealValue = getValueIfInteger($('input[name="' + currentRadioButtonName + '"]:checked').val());
                            if (Number.isInteger(getIsRealValue)) {
                                onlyValueArray.push({
                                    variable: "f" + variableIndex,
                                    value: getIsRealValue,
                                });
                            }
                            data.push({
                                type: $(item).prop("type"),
                                index: index,
                                value: $(item).val(),
                                variable: "f" + variableIndex,
                                //real_value: getValueIfInteger($(item).val())
                                real_value: getIsRealValue,
                            });
                            formulaString +=
                                Number.isInteger(itemValue) && itemValue < 0 ?
                                "-f" + variableIndex + ", " :
                                "f" + variableIndex + ", ";
                            variableIndex++;
                        }
                    } else if ($(item).prop("type") === "checkbox") {
                        // first check if this item is checkbox or radio
                        if ($(item).is(":checked") === true) {
                            getIsRealValue = getValueIfInteger($(item).val());
                            if (Number.isInteger(getIsRealValue)) {
                                onlyValueArray.push({
                                    variable: "f" + variableIndex,
                                    value: getIsRealValue,
                                });
                            }
                            data.push({
                                type: $(item).prop("type"),
                                index: index,
                                value: $(item).val(),
                                variable: "f" + variableIndex,
                                //real_value: getValueIfInteger($(item).val())
                                real_value: getIsRealValue,
                            });
                            formulaString +=
                                Number.isInteger(itemValue) && itemValue < 0 ?
                                "-f" + variableIndex + ", " :
                                "f" + variableIndex + ", ";
                            variableIndex++;
                        }
                    } else if ($(item).prop("type") === "number") {
                        getIsRealValue = getValueIfInteger($(item).val());
                        if (Number.isInteger(getIsRealValue)) {
                            onlyValueArray.push({
                                variable: "f" + variableIndex,
                                value: getIsRealValue,
                            });
                        }
                        data.push({
                            type: $(item).prop("type"),
                            index: index,
                            value: $(item).val(),
                            variable: "f" + variableIndex,
                            //real_value: getValueIfInteger($(item).val())
                            real_value: getIsRealValue,
                        });
                        formulaString +=
                            Number.isInteger(itemValue) && itemValue < 0 ?
                            "-f" + variableIndex + ", " :
                            "f" + variableIndex + ", ";
                        variableIndex++;
                    } else {
                        getIsRealValue = getValueIfInteger($(item).val());
                        if (Number.isInteger(getIsRealValue)) {
                            onlyValueArray.push({
                                variable: "f" + variableIndex,
                                value: getIsRealValue,
                            });
                        }
                        data.push({
                            type: $(item).prop("type"),
                            index: index,
                            value: $(item).val(),
                            variable: "f" + variableIndex,
                            //real_value: getValueIfInteger($(item).val())
                            real_value: getIsRealValue,
                        });
                        formulaString +=
                            Number.isInteger(itemValue) && itemValue < 0 ?
                            "-f" + variableIndex + ", " :
                            "f" + variableIndex + ", ";
                        variableIndex++;
                    }
                }
            );
            return [data, onlyValueArray];
        }
        /**
         * casting value
         */
        function getValueIfInteger(value) {
            if (value === undefined) return null;
            // first convert this value to integer
            let valueConvert = parseInt(value);
            // and then check if this item is integer or not. if integer then return that value otherwise return false
            return Number.isInteger(valueConvert) === true ? valueConvert : value;
            //return Number.isInteger(valueConvert) === true ? valueConvert : null;
        }
        /**
         * get the data settings from targetted element
         */
        function getFormulaStringFromDataSettings() {
            let str = $settings.formula,
                extract = str ? str.match(/'(.*)'/).pop() : false;
            return extract ? extract : false;
        }
        /**
         * processing calculation
         */
        function procesingFormDataWithFormulaJs() {
            let getDataArray = getVarableDataArray(),
                regexp = new RegExp("[f][1-9][0-9]{0,2}|1000$", "g"),
                str = getFormulaStringFromDataSettings(),
                match,
                value;
            let variableArray = getDataArray[1]; // here variableArray is just contain all variable information
            if (variableArray.length > 0) {
                while ((match = regexp.exec(str)) !== null) {
                    let isElementExistsCounter = 0;
                    for (let i = 0; i < variableArray.length; i++) {
                        if (variableArray[i]["variable"] === match[0]) {
                            str = str.replace(match[0], variableArray[i]["value"]);
                            isElementExistsCounter++;
                        }
                    }
                    if (isElementExistsCounter === 0) {
                        str = str.replace(match[0], null);
                    }
                }
                try {
                    value = eval("formulajs." + str);
                    $($settings.id).find(".bdt-advanced-calculator-result span").text(value);
                    //alert(value);
                } catch (error) {
                    // alert("error occured, invalid data format. please fix the data format and send again. thanks!");
                    $($settings.id).find('.bdt-advanced-calculator-error').removeClass('bdt-hidden');
                    setTimeout(function () {
                        $($settings.id).find('.bdt-advanced-calculator-error').addClass('bdt-hidden');
                    }, 5000);
                }
            }
        }

        if ($settings.resultShow == 'submit') {
            $($settings.id).find(".bdt-advanced-calculator-form").submit(function (e) {
                e.preventDefault();
                procesingFormDataWithFormulaJs();
            });
        }
        if ($settings.resultShow == 'change') {
            $($settings.id).find(".bdt-advanced-calculator-form input").change(function () {
                procesingFormDataWithFormulaJs();
            });
        }


        // end main js

    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-calculator.default', widgetCCalculator);
    });

}(jQuery, window.elementorFrontend));

/**
 * End custom calculator widget script
 */
/**
 * Start twitter carousel widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetStaticCarousel = function( $scope, $ ) {

		var $StaticCarousel = $scope.find( '.bdt-static-carousel' );
				
        if ( ! $StaticCarousel.length ) {
            return;
        }

		var $StaticCarouselContainer = $StaticCarousel.find('.swiper-container'),
			$settings 		 = $StaticCarousel.data('settings');

		// Access swiper class
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        
        async function initSwiper() {

			var swiper = await new Swiper($StaticCarouselContainer, $settings);

			if ($settings.pauseOnHover) {
				 $($StaticCarouselContainer).hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
			}
		};

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-static-carousel.default', widgetStaticCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End twitter carousel widget script
 */


/**
 * Start price table widget script
 */

 ( function( $, elementor ) {

	'use strict';

	var widgetImageStack = function( $scope, $ ) {

		var $imageStack = $scope.find( '.bdt-image-stack' );

        if ( ! $imageStack.length ) {
            return;
        }

        var $tooltip = $imageStack.find('.bdt-tippy-tooltip'),
        	widgetID = $scope.data('id');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				allowHTML: true,
				theme: 'bdt-tippy-' + widgetID
			});				
		});

    };
    
	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-image-stack.default', widgetImageStack );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End price table widget script
 */
$window.on('elementor/frontend/init', function() {
    var ModuleHandler = elementorModules.frontend.handlers.Base,
        ScrollingEffect;

    ScrollingEffect = ModuleHandler.extend({

        bindEvents: function() {
            this.run();
        },
 
        getDefaultSettings: function() {
            return {
                media: false,
                easing: 1,
                viewport: 1,
            };
        },

        onElementChange: debounce(function(prop) {
            if (prop.indexOf('ep_parallax_effects') !== -1) {
                this.run();
            }
        }, 400),

        settings: function(key) {
            return this.getElementSettings('ep_parallax_effects_' + key);
        },

        run: function() {
            var options = this.getDefaultSettings(),
                element = this.findElement('.elementor-widget-container').get(0),
                sectionID = this.$element.data('id');

            if (jQuery(this.$element).hasClass("elementor-section")) {
                element = this.$element.get(0);
            }
            //console.log($(this.$element).hasClass("elementor-section"));

            if (this.settings('y')) {
                if (this.settings('y_start.size') || this.settings('y_end.size')) {
                    options.y = [this.settings('y_start.size') || 0, this.settings('y_end.size') || 0];

                }
            }

            if (this.settings('x')) {
                if (this.settings('x_start.size') || this.settings('x_end.size')) {
                    options.x = [this.settings('x_start.size'), this.settings('x_end.size')];
                }
            }

            if ('htov' === this.settings('opacity')) {
                options.opacity = [0, 1];
            } else if ('vtoh' === this.settings('opacity')) {
                options.opacity = [1, 0];
            }

            if (this.settings('blur')) {
                if (this.settings('blur_start.size') || this.settings('blur_end.size')) {
                    options.blur = [this.settings('blur_start.size') || 0, this.settings('blur_end.size') || 0];
                }
            }

            if (this.settings('rotate')) {
                if (this.settings('rotate_start.size') || this.settings('rotate_end.size')) {
                    options.rotate = [this.settings('rotate_start.size') || 0, this.settings('rotate_end.size') || 0];
                }
            }

            if (this.settings('scale')) {
                if (this.settings('scale_start.size') || this.settings('scale_end.size')) {
                    options.scale = [this.settings('scale_start.size') || 1, this.settings('scale_end.size') || 1];
                }
            }

            if (this.settings('hue')) {
                if (this.settings('hue_value.size')) {
                    options.hue = this.settings('hue_value.size');
                }
            }

            if (this.settings('sepia')) {
                if (this.settings('sepia_value.size')) {
                    options.sepia = this.settings('sepia_value.size');
                }
            }

            if (this.settings('viewport')) {
                if (this.settings('viewport_value.size')) {
                    options.viewport = this.settings('viewport_value.size');
                }
            }

            if (this.settings('media_query')) {
                if (this.settings('media_query')) {
                    options.media = this.settings('media_query');
                }
            }

            if (this.settings('easing')) {
                if (this.settings('easing_value.size')) {
                    options.easing = this.settings('easing_value.size');
                }
            }

            if (this.settings('target')) {
                if (this.settings('target') === 'section') {
                    options.target = '.elementor-section.elementor-element-' + jQuery(element).closest('section').data('id');
                }
            }



            if (this.settings('show')) {
                if (
                    this.settings('y') ||
                    this.settings('x') ||
                    this.settings('opacity') ||
                    this.settings('blur') ||
                    this.settings('rotate') ||
                    this.settings('scale') ||
                    this.settings('hue') ||
                    this.settings('sepia') ||
                    this.settings('viewport') ||
                    this.settings('media_query') ||
                    this.settings('easing') ||
                    this.settings('target')
                ) {

                    bdtUIkit.parallax(element, options);
                }
            }

        }
    });

    //console.log($(this.$element).hasClass("elementor-section"));

    elementorFrontend.hooks.addAction('frontend/element_ready/section', function($scope) {
        elementorFrontend.elementsHandler.addHandler(ScrollingEffect, { $element: $scope });
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function($scope) {
        elementorFrontend.elementsHandler.addHandler(ScrollingEffect, { $element: $scope });
    });
});
$window.on('elementor/frontend/init', function () {

    var ModuleHandler = elementorModules.frontend.handlers.Base, FloatingEffect;

    FloatingEffect = ModuleHandler.extend({

        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                direction: 'alternate',
                easing: 'easeInOutSine',
                loop: true
            };
        },

        settings: function (key) {
            return this.getElementSettings('ep_floating_effects_' + key);
        },

        onElementChange: debounce(function (prop) {
            if (prop.indexOf('ep_floating') !== -1) {
                this.anime && this.anime.restart();
                this.run();
            }
        }, 400),

        run: function () {
            var options = this.getDefaultSettings(),
                element = this.findElement('.elementor-widget-container').get(0);

            if (this.settings('translate_toggle')) {
                if (this.settings('translate_x.sizes.from').length !== 0 || this.settings('translate_x.sizes.to').length !== 0) {
                    options.translateX = {
                        value: [this.settings('translate_x.sizes.from') || 0, this.settings('translate_x.sizes.to') || 0],
                        duration: this.settings('translate_duration.size'),
                        delay: this.settings('translate_delay.size') || 0
                    };
                }
                // console.log(options);

                if (this.settings('translate_y.sizes.from').length !== 0 || this.settings('translate_y.sizes.to').length !== 0) {
                    options.translateY = {
                        value: [this.settings('translate_y.sizes.from') || 0, this.settings('translate_y.sizes.to') || 0],
                        duration: this.settings('translate_duration.size'),
                        delay: this.settings('translate_delay.size') || 0
                    };
                }
            }

            if (this.settings('rotate_toggle')) {
                if (this.settings('rotate_infinite') !== 'yes' ) {
                    if (this.settings('rotate_x.sizes.from').length !== 0 || this.settings('rotate_x.sizes.to').length !== 0) {
                        options.rotateX = {
                            value   : [this.settings('rotate_x.sizes.from') || 0, this.settings('rotate_x.sizes.to') || 0],
                            duration: this.settings('rotate_duration.size'),
                            delay   : this.settings('rotate_delay.size') || 0
                        };
                    }
                    if (this.settings('rotate_y.sizes.from').length !== 0 || this.settings('rotate_y.sizes.to').length !== 0) {
                        options.rotateY = {
                            value   : [this.settings('rotate_y.sizes.from') || 0, this.settings('rotate_y.sizes.to') || 0],
                            duration: this.settings('rotate_duration.size'),
                            delay   : this.settings('rotate_delay.size') || 0
                        };
                    }
                    if (this.settings('rotate_z.sizes.from').length !== 0 || this.settings('rotate_z.sizes.to').length !== 0) {
                        options.rotateZ = {
                            value   : [this.settings('rotate_z.sizes.from') || 0, this.settings('rotate_z.sizes.to') || 0],
                            duration: this.settings('rotate_duration.size'),
                            delay   : this.settings('rotate_delay.size') || 0
                        };
                    }
                }
            }

            if (this.settings('scale_toggle')) {
                if (this.settings('scale_x.sizes.from').length !== 0 || this.settings('scale_x.sizes.to').length !== 0) {
                    options.scaleX = {
                        value: [this.settings('scale_x.sizes.from') || 0, this.settings('scale_x.sizes.to') || 0],
                        duration: this.settings('scale_duration.size'),
                        delay: this.settings('scale_delay.size') || 0
                    };
                }
                if (this.settings('scale_y.sizes.from').length !== 0 || this.settings('scale_y.sizes.to').length !== 0) {
                    options.scaleY = {
                        value: [this.settings('scale_y.sizes.from') || 0,  this.settings('scale_y.sizes.to') || 0],
                        duration: this.settings('scale_duration.size'),
                        delay: this.settings('scale_delay.size') || 0
                    };
                }
            }

            if (this.settings('skew_toggle')) {
                if (this.settings('skew_x.sizes.from').length !== 0 || this.settings('skew_x.sizes.to').length !== 0) {
                    options.skewX = {
                        value: [this.settings('skew_x.sizes.from') || 0, this.settings('skew_x.sizes.to') || 0],
                        duration: this.settings('skew_duration.size'),
                        delay: this.settings('skew_delay.size') || 0
                    };
                }
                if (this.settings('skew_y.sizes.from').length !== 0 || this.settings('skew_y.sizes.to').length !== 0) {
                    options.skewY = {
                        value: [this.settings('skew_y.sizes.from') || 0, this.settings('skew_y.sizes.to') || 0],
                        duration: this.settings('skew_duration.size'),
                        delay: this.settings('skew_delay.size') || 0
                    };
                }
            }

            if (this.settings('border_radius_toggle')) {
                jQuery(element).css('overflow', 'hidden');
                if (this.settings('border_radius.sizes.from').length !== 0 || this.settings('border_radius.sizes.to').length !== 0) {
                    options.borderRadius = {
                        value: [this.settings('border_radius.sizes.from') || 0,  this.settings('border_radius.sizes.to') || 0],
                        duration: this.settings('border_radius_duration.size'),
                        delay: this.settings('border_radius_delay.size') || 0
                    };
                }
            }

            if (this.settings('opacity_toggle')) {
                if (this.settings('opacity_start.size').length !== 0 || this.settings('opacity_end.size').length !== 0) {
                    options.opacity = {
                        value: [this.settings('opacity_start.size') || 1, this.settings('opacity_end.size') || 0],
                        duration: this.settings('opacity_duration.size'),
                        easing: 'linear'
                    };
                }
            }

            if (this.settings('easing')) {
                options.easing = this.settings('easing');
            }


            if (this.settings('show')) {
                options.targets = element;
                if (
                    this.settings('translate_toggle') ||
                    this.settings('rotate_toggle') ||
                    this.settings('scale_toggle') ||
                    this.settings('skew_toggle') ||
                    this.settings('border_radius_toggle') ||
                    this.settings('opacity_toggle')
                ) {
                    this.anime = window.anime && window.anime(options);
                }
            }

        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(FloatingEffect, {
            $element: $scope
        });
    });
});
$window.on('elementor/frontend/init', function () {
    var ModuleHandler = elementorModules.frontend.handlers.Base,
        BackgroundParallax;

    BackgroundParallax = ModuleHandler.extend({

        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                media: false,
                easing: 1,
                viewport: 1,
            };
        },

        onElementChange: debounce(function (prop) {
            if ((prop.indexOf('section_parallax_') !== -1) || (prop.indexOf('ep_parallax_') !== -1)) {
                this.run();
            }
        }, 400),

        settings: function (key) {
            // return this.getElementSettings('section_parallax_' + key);
            return this.getElementSettings(key);
        },

        run: function () {
            var options = this.getDefaultSettings(),
                element = this.findElement('.elementor-section').get(0);

            if (jQuery(this.$element).hasClass("elementor-section")) {
                element = this.$element.get(0);
            }

            if (this.settings('section_parallax_x_value.size')) {
                options.bgx = this.settings('section_parallax_x_value.size') || 0;
            }
            if (this.settings('section_parallax_value.size')) {
                options.bgy = this.settings('section_parallax_value.size') || 0;
            }


            if (this.settings('ep_parallax_bg_colors')) {
                if (this.settings('ep_parallax_bg_border_color_start') || this.settings('ep_parallax_bg_border_color_end')) {
                    options.borderColor = [this.settings('ep_parallax_bg_border_color_start') || 0, this.settings('ep_parallax_bg_border_color_end') || 0];
                }
            }
            if (this.settings('ep_parallax_bg_colors')) {
                if (this.settings('ep_parallax_bg_color_start') || this.settings('ep_parallax_bg_color_end')) {
                    options.backgroundColor = [this.settings('ep_parallax_bg_color_start') || 0, this.settings('ep_parallax_bg_color_end') || 0];
                }
            }

            if ((this.settings('section_parallax_on')) && (this.settings('section_parallax_on') === 'yes')) {
                if (
                    this.settings('section_parallax_x_value') ||
                    this.settings('section_parallax_value') ||
                    this.settings('ep_parallax_bg_colors')
                ) {
                    this.bgParallax = bdtUIkit.parallax(element, options);
                }
            }

        }
    });


    elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(BackgroundParallax, {
            $element: $scope
        });
    });

});
$window.on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {

        $scope.hasClass('elementor-element-edit-mode') && $scope.addClass('bdt-background-overlay-yes');

    });

});
$window.on('elementor/frontend/init', function () {
    var ModuleHandler = elementorModules.frontend.handlers.Base,
        Tooltip;

    Tooltip = ModuleHandler.extend({

        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                allowHTML: true,
            };
        },

        onElementChange: debounce(function (prop) {
            if (prop.indexOf('element_pack_widget_') !== -1) {
                this.instance.destroy();
                this.run();
            }
        }, 400),

        settings: function (key) {
            return this.getElementSettings('element_pack_widget_' + key);
        },

        run: function () {
            var options = this.getDefaultSettings();
            var widgetID = this.$element.data('id');
            var widgetContainer = document.querySelector('.elementor-element-' + widgetID + ' .elementor-widget-container');

            if (this.settings('tooltip_text')) {
                options.content = this.settings('tooltip_text');
            }

            options.arrow = !!this.settings('tooltip_arrow');
            options.followCursor = !!this.settings('tooltip_follow_cursor');

            if (this.settings('tooltip_placement')) {
                options.placement = this.settings('tooltip_placement');
            }

            if (this.settings('tooltip_trigger')) {
                if (this.settings('tooltip_custom_trigger')) {
                    options.triggerTarget = document.querySelector(this.settings('tooltip_custom_trigger'));
                } else {
                    options.trigger = this.settings('tooltip_trigger');
                }
            }
            // if (this.settings('tooltip_animation_duration')) {
            //     options.duration = this.settings('tooltip_animation_duration.sizes.from');
            // }
            if (this.settings('tooltip_animation')) {
                if (this.settings('tooltip_animation') === 'fill') {
                    options.animateFill = true;
                } else {
                    options.animation = this.settings('tooltip_animation');
                }
            }
            if (this.settings('tooltip_x_offset.size') || this.settings('tooltip_y_offset.size')) {
                options.offset = [this.settings('tooltip_x_offset.size') || 0, this.settings('tooltip_y_offset.size') || 0];
            }
            if (this.settings('tooltip')) {
                options.theme = 'bdt-tippy-' + widgetID;
                this.instance = tippy(widgetContainer, options);
            }
        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(Tooltip, {
            $element: $scope
        });
    });
});
$window.on('elementor/frontend/init', function () {
    var ModuleHandler = elementorModules.frontend.handlers.Base,
        Particles;

    Particles = ModuleHandler.extend({

        bindEvents: function () {
            this.run();
        },

        getDefaultSettings: function () {
            return {
                allowHTML: true,
            };
        },

        onElementChange: debounce(function (prop) {
            if (prop.indexOf('section_particles') !== -1) {
                // window.pJSDom[0].pJS.fn.vendors.destroypJS();
                this.run();
            }
        }, 400),

        settings: function (key) {
            return this.getElementSettings('section_particles_' + key);
        },

        run: function () {
            var options         = this.getDefaultSettings(),
                element         = this.findElement('.elementor-section').get(0),
                particleID      = 'bdt-particle-container-' + this.$element.data('id'),
                widgetID        = this.$element.data('id'),
                widgetContainer = $('.elementor-element-' + widgetID);
            this.particleID = particleID;

            // start predefined json data
            var jsonData = {
                'particles'    : {
                    'number'     : {
                        'value'  : 80,
                        'density': {
                            'enable'    : true,
                            'value_area': 800
                        }
                    },
                    'color'      : {
                        'value': '#ffffff'
                    },
                    'shape'      : {
                        'type'   : 'circle',
                        'stroke' : {
                            'width': 0,
                            'color': '#000000'
                        },
                        'polygon': {
                            'nb_sides': 5
                        },
                        'image'  : {
                            'src'   : '',
                            'width' : 100,
                            'height': 100
                        }
                    },
                    'opacity'    : {
                        'value' : 0.5,
                        'random': false,
                        'anim'  : {
                            'enable'     : false,
                            'speed'      : 1,
                            'opacity_min': 0.1,
                            'sync'       : false
                        }
                    },
                    'size'       : {
                        'value' : 3,
                        'random': true,
                        'anim'  : {
                            'enable'  : false,
                            'speed'   : 40,
                            'size_min': 0.1,
                            'sync'    : false
                        }
                    },
                    'line_linked': {
                        'enable'  : true,
                        'distance': 150,
                        'color'   : '#ffffff',
                        'opacity' : 0.4,
                        'width'   : 1
                    },
                    'move'       : {
                        'enable'   : true,
                        'speed'    : 6,
                        'direction': 'none',
                        'random'   : false,
                        'straight' : false,
                        'out_mode' : 'out',
                        'bounce'   : false,
                        'attract'  : {
                            'enable' : false,
                            'rotateX': 600,
                            'rotateY': 1200
                        }
                    }
                },
                'interactivity': {
                    'detect_on': 'canvas',
                    'events'   : {
                        'onhover': {
                            'enable': false,
                            'mode'  : 'repulse'
                        },
                        'onclick': {
                            'enable': true,
                            'mode'  : 'push'
                        },
                        'resize' : true
                    },
                    'modes'    : {
                        'grab'   : {
                            'distance'   : 400,
                            'line_linked': {
                                'opacity': 1
                            }
                        },
                        'bubble' : {
                            'distance': 400,
                            'size'    : 40,
                            'duration': 2,
                            'opacity' : 8,
                            'speed'   : 3
                        },
                        'repulse': {
                            'distance': 200,
                            'duration': 0.4
                        },
                        'push'   : {
                            'particles_nb': 4
                        },
                        'remove' : {
                            'particles_nb': 2
                        }
                    }
                },
                'retina_detect': true
            };
            // end of predefine json data


            if (this.settings('js') && this.settings('js').length !== 0) {
                jsonData = JSON.parse(this.settings('js'));
            }

            if (this.settings('on')) {
                if ($('#' + particleID).length === 0) {
                    $(widgetContainer).prepend('<div id="' + particleID + '" class="bdt-particle-container"></div>');
                }

                particlesJS(particleID, jsonData);

            }
        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(Particles, {
            $element: $scope
        });
    });
});
 $window.on('elementor/frontend/init', function ($) {
     var ModuleHandler = elementorModules.frontend.handlers.Base,
         Confetti;

     Confetti = ModuleHandler.extend({

         bindEvents: function () {
             this.run();
         },

         getDefaultSettings: function () {
             return {
                 resize: true,
                 useWorker: true,
             };
         },

         onElementChange: debounce(function (prop) {
             if (prop.indexOf('ep_widget_cf_') !== -1) {
                 //  this.instance.reset();
                 this.run();
                
             }
         }, 400),

         settings: function (key) {
             return this.getElementSettings('ep_widget_cf_' + key);
         },
         randomInRange: function (min, max) {
             return Math.random() * (max - min) + min;
         },
         run: function () {
             var options = this.getDefaultSettings(),
                 $element = this.$element;
                
             if (this.settings('particle_count.size')) {
                 options.particleCount = this.settings('particle_count.size') || 100;
             }
             if (this.settings('start_velocity.size')) {
                 options.startVelocity = this.settings('start_velocity.size') || 45;
             }

             if (this.settings('spread.size')) {
                 options.spread = this.settings('spread.size') || 70;
             }
             if (this.settings('colors')) {
                 var colors = this.settings('colors');
                 options.colors = colors.split(',');
             }
             if (this.settings('shapes')) {
                 var shapes = this.settings('shapes');
                 options.shapes = shapes.split(',');
             }


             if (this.settings('origin')) {
                 if (this.settings('origin_x.size') || this.settings('origin_y.size')) {
                     options.origin = {
                         x: this.settings('origin_x.size') || 0.5,
                         y: this.settings('origin_y.size') || 0.6
                     }
                 }
             }

             if (this.settings('angle.size')) {
                 options.angle = this.settings('angle.size') || 90;
             }

             var this_instance = this;
             var instanceConfetti = {
                 executeConfetti: function () {
                     if (this_instance.settings('type') == 'random') {
                         options.angle = this_instance.randomInRange(55, this_instance.settings('angle.size') || 90);
                         options.spread = this_instance.randomInRange(50, this_instance.settings('spread.size') || 70);
                         options.particleCount = this_instance.randomInRange(55, this_instance.settings('particle_count.size') || 100);
                     }
                     if (this_instance.settings('type') == 'fireworks') {
                         var duration = this_instance.settings('fireworks_duration.size') || 1500;
                         var animationEnd = Date.now() + duration;
                         var defaults = {
                             startVelocity: this_instance.settings('start_velocity.size') || 30,
                             spread: this_instance.settings('spread.size') || 360,
                             shapes: this_instance.settings('shapes.size') ? shapes.split(',') : ['circle', 'circle', 'square'],
                             ticks: 60,
                             zIndex: 0
                         };

                         var interval = setInterval(function () {
                             var timeLeft = animationEnd - Date.now();

                             if (timeLeft <= 0) {
                                 return clearInterval(interval);
                             }

                             var particleCount = 50 * (timeLeft / duration);
                             // since particles fall down, start a bit higher than random
                             confetti(Object.assign({}, defaults, {
                                 particleCount,
                                 origin: {
                                     x: this_instance.randomInRange(0.1, 0.3),
                                     y: Math.random() - 0.2
                                 }
                             }));
                             confetti(Object.assign({}, defaults, {
                                 particleCount,
                                 origin: {
                                     x: this_instance.randomInRange(0.7, 0.9),
                                     y: Math.random() - 0.2
                                 }
                             }));
                         }, 250);
                     }

                     if (this_instance.settings('type') == 'school-pride') {
                         var duration = this_instance.settings('fireworks_duration.size') || 1500;
                         var end = Date.now() + (duration);

                         (function frame() {
                             confetti({
                                 particleCount: this_instance.settings('particle_count.size') || 2,
                                 angle: this_instance.settings('angle.size') || 60,
                                 spread: this_instance.settings('spread.size') || 55,
                                 shapes: this_instance.settings('shapes.size') ? shapes.split(',') : ['circle', 'circle', 'square'],
                                 origin: {
                                     x: 0
                                 },
                                 colors: colors.split(',')
                             });
                             confetti({
                                 particleCount: this_instance.settings('particle_count.size') || 2,
                                 angle: (this_instance.settings('angle.size') || 60) * 2, //120
                                 spread: this_instance.settings('spread.size') || 55,
                                 shapes: this_instance.settings('shapes.size') ? shapes.split(',') : ['circle', 'circle', 'square'],
                                 origin: {
                                     x: 1
                                 },
                                 colors: colors.split(',')
                             });

                             if (Date.now() < end) {
                                 requestAnimationFrame(frame);
                             }
                         }());
                     }

                     if (this_instance.settings('type') == 'snow') {
                         var duration = this_instance.settings('fireworks_duration.size') || 1500;
                         var animationEnd = Date.now() + duration;
                         var skew = 1;

                         (function frame() {
                             var timeLeft = animationEnd - Date.now();
                             var ticks = Math.max(200, 500 * (timeLeft / duration));
                             skew = Math.max(0.8, skew - 0.001);

                             confetti({
                                 particleCount: this_instance.settings('particle_count.size') || 1,
                                 startVelocity: this_instance.settings('start_velocity.size') || 0,
                                 ticks: ticks,
                                 origin: {
                                     x: Math.random(),
                                     // since particles fall down, skew start toward the top
                                     y: (Math.random() * skew) - 0.2
                                 },
                                 colors: colors.split(','),
                                 shapes: this_instance.settings('shapes.size') ? shapes.split(',') : ['circle'],
                                 gravity: this_instance.randomInRange(0.4, 0.6),
                                 scalar: this_instance.randomInRange(0.4, 1),
                                 drift: this_instance.randomInRange(-0.4, 0.4)
                             });

                             if (timeLeft > 0) {
                                 requestAnimationFrame(frame);
                             }
                         }());
                     }

                     if ((this_instance.settings('type') == 'basic') ||
                         (this_instance.settings('type') == 'random')) {
                         this_instance.instance = confetti(options);
                          
                     }
                 }
             };

             if (this.settings('confetti') == 'yes') {

                 if ((this.settings('trigger_type') == 'click')) {
                     jQuery(this.settings('trigger_selector')).on('click', function () {
                         instanceConfetti.executeConfetti();
                        //  $(this).unbind('mouseenter mouseleave');
                     });
                 } else if (this.settings('trigger_type') == 'mouseenter') {
                     jQuery(this.settings('trigger_selector')).on('mouseenter', function () {
                         instanceConfetti.executeConfetti();
                         //  $(this).unbind('mouseenter mouseleave');
                     });
                 } else if (this.settings('trigger_type') == 'ajax-success') {
                     jQuery(document).ajaxComplete(function (event, jqxhr, settings) {
                         instanceConfetti.executeConfetti();
                     });
                 } else if (this.settings('trigger_type') == 'delay') {
                     setTimeout(function () {
                         instanceConfetti.executeConfetti();
                     }, this.settings('trigger_delay.size') ? this.settings('trigger_delay.size') : 1000);
                 } else if (this.settings('trigger_type') == 'onview') {
                     elementorFrontend.waypoint($element, function () {
                         instanceConfetti.executeConfetti();
                     }, {
                         // offset: 'bottom-in-view',
                         offset: '80%'
                     });
                 } else {
                     instanceConfetti.executeConfetti();
                    
                 }

             }
         }
     });

     elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
         elementorFrontend.elementsHandler.addHandler(Confetti, {
             $element: $scope
         });
     });
     
     elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
         elementorFrontend.elementsHandler.addHandler(Confetti, {
             $element: $scope
         });
     });

 });
jQuery(document).ready(function () {
    jQuery('body').on('click', '.bdt-element-link', function () {
        var $el      = jQuery(this),
            settings = $el.data('settings'),
            data     = settings.element_pack_wrapper_link,
            id   = 'bdt-element-link-' + $el.data('id');

        if (jQuery('#' + id).length === 0) {
            jQuery('body').append(
                jQuery(document.createElement('a')).prop({
                    target: data.is_external ? '_blank' : '_self',
                    href  : data.url,
                    class : 'bdt-hidden',
                    id    : id,
                    rel   : data.nofollow ? 'nofollow noreferer' : ''
                })
            );
        }

        jQuery('#' + id)[0].click();

    });
});
$window.on('elementor/frontend/init', function () {
    let ModuleHandler = elementorModules.frontend.handlers.Base,
        TileScroll;

    TileScroll = ModuleHandler.extend({
        bindEvents: function () {
            this.run();
        },
        getDefaultSettings: function () {
            return {
                allowHTML: true,
            };
        },

        // onElementChange: debounce(function (prop) {
        //     if (prop.indexOf('element_pack_tile_scroll') !== -1) {
        //         this.run();
        //     }
        // }, 400),

        settings: function (key) {
            return this.getElementSettings('element_pack_tile_scroll_' + key);
        },

        run: function () {
            var tileScroll_ID = 'bdt-tile-scroll-container-' + this.$element.data('id'),
                widgetID = this.$element.data('id'),
                widgetContainer = $('.elementor-element-' + widgetID);

            if (this.settings('show') == 'yes') {
                if ($('#' + tileScroll_ID).length === 0) {
                    let display = this.settings('display');
                    var $content = `
                        <div id="${tileScroll_ID}" class="bdt-tile-scroll bdt-tile-scroll--${display}">
                            <div class="bdt-tile-scroll__wrap">`;
                    this.settings('elements').forEach(element => {
                        let images = element.element_pack_tile_scroll_images;

                        let x_start = element.element_pack_tile_scroll_x_start.size;
                        let x_end = element.element_pack_tile_scroll_x_end.size;
                        // console.log(images);
                        if (display === 'horizontal') {
                            var parallax = 'data-bdt-parallax="target: .elementor-element-' + widgetID + '; viewport: 1.1; x:' + x_start + ',' + x_end + '"';
                        } else {
                            var parallax = 'data-bdt-parallax="y:' + x_start + ',' + x_end + '"';
                        }
                        $content += `<div class="bdt-tile-scroll__line" ${parallax}>`;
                        images.forEach(image => {
                            $content += `<div class=" bdt-tile-scroll__line-img" style="background-image:url(${image.url})" loading="lazy"></div>`;
                        });
                        $content += `</div>`;
                    });
                    $content += `</div></div>`;

                    $(widgetContainer).prepend($content);
                }
            }
        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
        if (!$scope.hasClass("bdt-tile-scroll-yes")) {
            return;
        }
        elementorFrontend.elementsHandler.addHandler(TileScroll, {
            $element: $scope
        });
    });
});

})(jQuery, window.elementorFrontend);