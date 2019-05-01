'use strict';

$('document').ready(function () {
  var tooltipEl = '<div class="tooltip"></div>';
  $('body').append(tooltipEl);

  var showTooltip = function showTooltip(el) {
    var tooltip = $('.tooltip');
    var tooltipText = el.attr('data-tooltip');
    var tooltipPos = el.attr('data-tooltip-position');

    var posX = void 0,
        posY = void 0;

    tooltipPos == undefined ? tooltipPos = 'bottom' : null;

    $(tooltip).removeClass('top bottom right left').html(tooltipText).addClass(tooltipPos);

    switch (tooltipPos) {
      case 'bottom':
        posX = el.offset().left - (tooltip.outerWidth() / 2 - el.outerWidth() / 2);
        posY = el.offset().top + el.outerHeight() + 10;
        break;
      case 'top':
        posX = el.offset().left - (tooltip.outerWidth() / 2 - el.outerWidth() / 2);
        posY = el.offset().top - tooltip.outerHeight() - 10;
        break;
      case 'left':
        posX = el.offset().left - tooltip.outerWidth() - 10;
        posY = el.offset().top + (el.outerHeight() / 2 - tooltip.outerHeight() / 2);
        break;
      case 'right':
        posX = el.offset().left + el.outerWidth() + 10;
        posY = el.offset().top + (el.outerHeight() / 2 - tooltip.outerHeight() / 2);
        break;
      default:
        posX = el.offset().left - (tooltip.outerWidth() / 2 - el.outerWidth() / 2);
        posY = el.offset().top + el.outerHeight() + 10;
    }

    TweenMax.set(tooltip, {
      display: 'block',
      left: posX,
      top: posY
    });
  };

  var hideTooltip = function hideTooltip() {
    var tooltip = $('.tooltip');
    TweenMax.set(tooltip, {
      display: 'none',
      top: 0,
      left: 0
    });
  };

  $('[data-tooltip]').on('mouseover', function () {
    showTooltip($(this));
  }).on('mouseout', hideTooltip);
});

/*! @license
* dynaPP
*
* © 2019 Marcel Hauser (https://ice-creme.de)
*/
//@prepros-prepend components/tooltip.js