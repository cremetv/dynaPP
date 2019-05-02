/*! @license
* dynaPP
*
* © 2019 Marcel Hauser (https://ice-creme.de)
*/
//@prepros-prepend components/tooltip.js

/* scroll log to bottom */
const scrollLog = () => {
  const log = $('.log');
  let scrollHeight = log[0].scrollHeight;
  TweenLite.to(log, 2, {scrollTo: scrollHeight, ease:Power2.easeOut});
}

$(document).ready(function() {
  scrollLog();
});

//@prepros-append pages/clients.js
