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

var toasts = 0;

var toast = function toast(type, message) {
  var tl = new TimelineMax();
  var toastEl = $('<div class="toast ' + type + '">' + message + '</div>');

  $('body').append(toastEl);

  tl.to(toastEl, .25, {
    opacity: 1,
    y: 0 + 66 * toasts,
    ease: Power4.easeOut,
    onComplete: function onComplete() {
      toasts++;
    }
  });
  tl.to(toastEl, .5, {
    delay: 2,
    y: '-100px',
    opacity: 0,
    ease: Power4.easeOut,
    onComplete: function onComplete() {
      toastEl.remove();
      toasts--;
    }
  });
};

// const ajaxCall = (post_data, url, response) => {
var ajaxCall = function ajaxCall(post_function_data, callback) {
  var post_data = post_function_data.post_data;
  var url = post_function_data.url;
  var responseType = post_function_data.responseType;
  var response = post_function_data.response;

  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'data': post_data,
    'method': 'POST',
    'headers': { 'cache-control': 'no-cache' }
  };

  $.ajax(settings).done(function (r) {
    console.log('-----------');
    console.log(r);
    console.log('-----------');
    if (r.startsWith('success')) {
      !response ? response = 'success' : null;
      toast(responseType, response);
      callback('success');
    } else {
      toast('error', 'something went wrong!');
      callback('error');
    }
  });
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

//@prepros-append pages/clients.js
//@prepros-append pages/datenschutz.js

if ($('body').hasClass('clients')) {
  $(document).ready(function () {
    scrollLog();

    $('#search').quicksearch('main .box--client', {
      selector: 'h1'
    });
    $('#search').focus();
  });

  // actions
  var deleteClient = function deleteClient(id) {
    var post_data = {
      // 'id': id,
      'condition': 'id = ' + id,
      'table': 'clients'
    };
    var post_function_data = {
      'post_data': post_data,
      'url': 'helpers/delete_row.php',
      'responseType': 'success',
      'response': 'Client successfuly deleted'
    };
    ajaxCall(post_function_data, function (returnValue) {
      console.log(returnValue);
      if (returnValue === 'success') {
        var boxTarget = $('.box--client[client-id="' + id + '"]');
        TweenMax.to(boxTarget, .25, {
          height: 0,
          ease: Power4.easeOut,
          onComplete: function onComplete() {
            boxTarget.remove();
          }
        });
      }
    });
  };

  var addClient = function addClient() {
    var clientName = $('#clientName').val(),
        legalLink = $('#legalLink').val(),
        businessType = $('#businessType').val(),
        betreiber = $('#betreiber').val(),
        vorname = $('#vorname').val(),
        nachname = $('#nachname').val(),
        bezeichnung = $('#bezeichnung').val(),
        street = $('#street').val(),
        additionalAddress = $('#additionalAddress').val(),
        plz = $('#plz').val(),
        city = $('#city').val(),
        email = $('#email').val(),
        tel = $('#tel').val(),
        fax = $('#fax').val(),
        vertretenDurch = $('#vertretenDurch').val();

    var values = {
      'clientName': clientName,
      'legalLink': legalLink,
      'businessType': businessType,
      'betreiber': betreiber,
      'vorname': vorname,
      'nachname': nachname,
      'bezeichnung': bezeichnung,
      'street': street,
      'additionalAddress': additionalAddress,
      'plz': plz,
      'city': city,
      'email': email,
      'tel': tel,
      'fax': fax,
      'vertretenDurch': vertretenDurch
    };

    var post_data = {
      'table': 'clients',
      'values': values
    };

    var post_function_data = {
      'post_data': post_data,
      'url': 'helpers/insert_row.php',
      'response': 'Client successfuly created'
    };
    ajaxCall(post_function_data, function (returnValue) {
      console.log(returnValue);
      if (returnValue === 'success') {
        // add new client to list or reload page
      }
    });
  };

  // listeners
  $('.delete-client').on('click', function () {
    var clientId = $(this).attr('client-id');
    deleteClient(clientId);
  });
}

if ($('body').hasClass('datenschutz')) {
  $(document).ready(function () {

    $('#search').quicksearch('main .box--element', {
      selector: 'h1'
    });

    var openInfo = function openInfo(el) {
      var box = el.closest('.box');
      var hint = box.find('.box__hint');
      hint.toggleClass('box__hint--open');
      if ($(hint).hasClass('box__hint--open')) {
        TweenMax.set(hint, {
          height: 'auto'
        });
        TweenMax.from(hint, .25, {
          height: 0,
          ease: Quad.easeInOut
        });
      } else {
        TweenMax.to(hint, .25, {
          height: 0,
          ease: Quad.easeInOut
        });
      }
    };

    $('.open-info').on('click', function () {
      openInfo($(this));
    });

    var updateDatenschutz = function updateDatenschutz(el) {
      var disabled = $(el).prev('input.check').attr('disabled');
      if (disabled) return;

      var elId = $(el).prev('input.check').attr('data-element');
      var clientId = $('body').attr('data-client');
      var table = 'datenschutz';
      var target = void 0,
          condition = void 0,
          responseType = void 0,
          response = void 0;

      if ($(el).prev('input.check').prop('checked')) {
        // is checked => is now unchecked
        target = 'helpers/delete_row.php';
        condition = 'clientId = ' + clientId + ' AND elementId = ' + elId;
        responseType = 'error';
        response = '❌ removed';
      } else {
        // is not checked => now checked
        target = 'helpers/add_row.php';
        condition = {
          'clientId': clientId,
          'elementId': elId
        };
        responseType = 'success';
        response = '✔ added';
      }

      var post_data = {
        'table': table,
        'condition': condition
      };

      var post_function_data = {
        'post_data': post_data,
        'url': target,
        'responseType': responseType,
        'response': response
      };

      ajaxCall(post_function_data, function (returnValue) {
        if (returnValue === 'success') {
          // console.log('Success =)');
        }
      });
    };

    $('.checkbox-label').on('click', function () {
      updateDatenschutz($(this));
    });
  });
}
//# sourceMappingURL=main-dist.js.map