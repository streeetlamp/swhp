/*
 * Author: VCU Libraries Digital Engagement
 *
 * javascripting all the things
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  // open links in new window plz
  $("a").each(function () {
    if (this.hostname != document.location.hostname && this.href != "javascript:void(0)") this.target = "_blank";
  });

  /*
  * THA SLIDER
  */
  var $sliderEl = $('.slider');
  $sliderEl.each(function(i){
    initSlider(this, i);
  });

  function initSlider(element, i) {

    var $element = $(element);

    var customOptions = {
      autoplay: false,
      slidespeed: 7000,
      slidenav: false,
      slidedots: false
    }
    customOptions = $.extend(customOptions, $element.data());


    if (customOptions.slidenav) {
      function sliderNav() {
        var nextBtn = $('<button />', {'class': 'slide-btn-next'}).html('<i class="fa fa-angle-right"></i>'),
            prevBtn = $('<button />', {'class': 'slide-btn-prev'}).html('<i class="fa fa-angle-left"></i>'),
            theBtns = $('<nav />', {'class': 'slider-buttons'}).append(prevBtn, nextBtn);

        return theBtns;
      }

      $element.append(sliderNav);
    }

    var slider = new Wallop(element, {
      itemClass: 'slide',
      buttonPreviousClass: 'slide-btn-prev',
      buttonNextClass: 'slide-btn-next',
      currentItemClass: 'slide-current',
      showPreviousClass: 'slide-showPrevious',
      showNextClass: 'slide-showNext',
      hidePreviousClass: 'slide-hidePrevious',
      hideNextClass: 'slide-hideNext'
    });

    slider.options = $.extend(slider.options, customOptions);


    // autoplay
    var slideCount = slider.allItemsArrayLength + 1,
        slideStart = slider.currentItemIndex,
        slideIndex = slideStart,
        randomSlide = Math.floor(Math.random() * slideCount),
        slideSpeed = slider.options.slidespeed,
        sliderTimer;


    function autoSlide() {
      slider.next();
    }

    if (slider.options.autoplay) {
      sliderTimer = setInterval(autoSlide, slideSpeed);
    }


    // slider dot navigation 
    if (customOptions.slidedots && slideCount >= 1) {
      var $dotsWrap = $('<ul />', {'class': 'slider-dots-wrap'});

      for (var i = 0; i < slideCount; i++) {
        var $dotEl = $('<li />', {'class': 'slider-dot'}).html('<a href="javascript:void(0)"><i class="fa fa-circle-o"></i></a>');
        $dotsWrap.append($dotEl);
      }
      $element.append($dotsWrap);
    }

    var paginationDots = Array.prototype.slice.call(document.querySelectorAll('.slider-dot'));

    paginationDots.forEach(function (dotEl, index) {
      dotEl.addEventListener('click', function() {
        slider.goTo(index);
      });
    });

    slider.on('change', function(event) {
      if (slider.options.slidedots) {
        removeClass(document.querySelector('.slider-dot-current'), 'slider-dot-current');
        addClass(paginationDots[event.detail.currentItemIndex], 'slider-dot-current');
      }

      if (slider.options.autoplay) {
        clearInterval(sliderTimer);
        sliderTimer = setInterval(autoSlide, slideSpeed); 
      }
    }); // end of dots


    // swiping 
    var slideSwipe = new Hammer(element);
    slideSwipe.on('swipe', function(event){
      if (event.direction === 2) {
        slider.next();
      }
      if (event.direction === 4) {
        slider.previous();
      }
      return;
    });


    // Helpers
    function addClass(element, className) {
      if (!element) { return; }
      element.className = element.className.replace(/\s+$/gi, '') + ' ' + className;
    }

    function removeClass(element, className) {
      if (!element) { return; }
      element.className = element.className.replace(className, '');
    }

  } //initSlider()

}); /* end of as page load scripts */