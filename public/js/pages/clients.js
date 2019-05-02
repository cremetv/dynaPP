if ($('body').hasClass('clients')) {
  $(document).ready(function() {

    $('#search').quicksearch('main .box--client', {
      selector: 'h1'
    });

    $('#search').focus();

  });
}
