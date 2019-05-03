const toast = (type, message) => {
  const tl = new TimelineMax();
  const toastEl = $(`<div class="toast ${type}">${message}</div>`);

  $('body').append(toastEl);

  tl.to(toastEl, .25, {
    opacity: 1,
    y: 0,
    ease: Power4.easeOut,
  });
  tl.to(toastEl, .5, {
    delay: 2,
    y: '-100px',
    opacity: 0,
    ease: Power4.easeOut,
    onComplete: function() {
      toastEl.remove();
    }
  });
}

const ajaxCall = (post_data, url, response) => {
  let settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'data': post_data,
    'method': 'POST',
    'headers': { 'cache-control': 'no-cache' }
  }

  toast('success', response);

  // $.ajax(settings).done(function(r) {
  //   if (r == 'success' || r.includes('prepros')) {
  //     !response ? response = 'success' : null;
  //     toast('success', response);
  //   } else {
  //     toast('error', 'something went wrong!');
  //   }
  // });
}
