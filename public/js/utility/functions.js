let toasts = 0;

const toast = (type, message) => {
  const tl = new TimelineMax();
  const toastEl = $(`<div class="toast ${type}">${message}</div>`);

  $('body').append(toastEl);

  tl.to(toastEl, .25, {
    opacity: 1,
    y: 0 + (66 * toasts),
    ease: Power4.easeOut,
    onComplete: function() {
      toasts++;
    }
  });
  tl.to(toastEl, .5, {
    delay: 2,
    y: '-100px',
    opacity: 0,
    ease: Power4.easeOut,
    onComplete: function() {
      toastEl.remove();
      toasts--;
    }
  });
}

// const ajaxCall = (post_data, url, response) => {
const ajaxCall = (post_function_data, callback) => {
  let post_data = post_function_data.post_data;
  let url = post_function_data.url;
  let responseType = post_function_data.responseType;
  let response = post_function_data.response;

  let settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'data': post_data,
    'method': 'POST',
    'headers': { 'cache-control': 'no-cache' }
  }

  $.ajax(settings).done(function(r) {
    // console.log('-----------');
    // console.log(r);
    // console.log('-----------');
    if (r.startsWith('success')) {
      !response ? response = 'success' : null;
      toast(responseType, response);
      callback('success');
    } else {
      toast('error', 'something went wrong!');
      callback('error');
    }
  });
}
