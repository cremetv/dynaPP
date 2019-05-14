if ($('body').hasClass('datenschutz')) {
  $(document).ready(function() {

    $('#search').quicksearch('main .box--element', {
      selector: 'h1'
    });



    const openInfo = (el) => {
      const box = el.closest('.box');
      const hint = box.find('.box__hint');
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
    }

    $('.open-info').on('click', function() {
      openInfo($(this));
    });



    const updateDatenschutz = (el) => {
      let disabled = $(el).prev('input.check').attr('disabled');
      if (disabled) return;

      let elId = $(el).prev('input.check').attr('data-element');
      let clientId = $('body').attr('data-client');
      let table = 'datenschutz';
      let target, condition, responseType, response;

      if ($(el).prev('input.check').prop('checked')) {
        // is checked => is now unchecked
        target = 'helpers/delete_row.php';
        condition = `clientId = ${clientId} AND elementId = ${elId}`;
        responseType = 'error';
        response = '❌ removed';
      } else {
        // is not checked => now checked
        target = 'helpers/add_row.php';
        condition = {
          'clientId': clientId,
          'elementId': elId
        }
        responseType = 'success';
        response = '✔ added';
      }

      let post_data = {
        'table': table,
        'condition': condition,
      };

      let post_function_data = {
        'post_data': post_data,
        'url': target,
        'responseType': responseType,
        'response': response,
      }

      ajaxCall(post_function_data, function(returnValue) {
        if (returnValue === 'success') {
          // console.log('Success =)');
        }
      });
    }

    $('.checkbox-label').on('click', function() {
      updateDatenschutz($(this));
    });

  });
}
