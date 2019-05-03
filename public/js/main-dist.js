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

var toast = function toast(type, message) {
  var tl = new TimelineMax();
  var toastEl = $('<div class="toast ' + type + '">' + message + '</div>');

  $('body').append(toastEl);

  tl.to(toastEl, .25, {
    opacity: 1,
    y: 0,
    ease: Power4.easeOut
  });
  tl.to(toastEl, .5, {
    delay: 2,
    y: '-100px',
    opacity: 0,
    ease: Power4.easeOut,
    onComplete: function onComplete() {
      toastEl.remove();
    }
  });
};

var ajaxCall = function ajaxCall(post_data, url, response) {
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'data': post_data,
    'method': 'POST',
    'headers': { 'cache-control': 'no-cache' }
  };

  toast('success', response);

  // $.ajax(settings).done(function(r) {
  //   if (r == 'success' || r.includes('prepros')) {
  //     !response ? response = 'success' : null;
  //     toast('success', response);
  //   } else {
  //     toast('error', 'something went wrong!');
  //   }
  // });
};

/*! @license
* dynaPP
*
* © 2019 Marcel Hauser (https://ice-creme.de)
*/
//@prepros-prepend components/tooltip.js
//@prepros-prepend utility/functions.js

/* scroll log to bottom */
var scrollLog = function scrollLog() {
  var log = $('.log');
  var scrollHeight = log[0].scrollHeight;
  TweenLite.to(log, 2, { scrollTo: scrollHeight, ease: Power2.easeOut });
};

$(document).ready(function () {
  scrollLog();
});

//@prepros-append pages/clients.js

if ($('body').hasClass('clients')) {
  $(document).ready(function () {

    $('#search').quicksearch('main .box--client', {
      selector: 'h1'
    });
    $('#search').focus();
  });

  // actions
  var deleteClient = function deleteClient(id) {
    var post_data = {
      'id': id,
      'table': 'clients'
    };
    ajaxCall(post_data, 'helpers/delete_row.php', 'Client successfuly deleted');
  };

  // listeners
  $('.delete-client').on('click', function () {
    var clientId = $(this).attr('client-id');
    deleteClient(clientId);
  });
}