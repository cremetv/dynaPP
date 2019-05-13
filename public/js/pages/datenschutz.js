if ($('body').hasClass('datenschutz')) {
  $(document).ready(function() {

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

  });
}
