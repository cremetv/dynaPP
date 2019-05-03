if ($('body').hasClass('clients')) {
  $(document).ready(function() {
    scrollLog();

    $('#search').quicksearch('main .box--client', {
      selector: 'h1'
    });
    $('#search').focus();

  });

  // actions
  const deleteClient = (id) => {
    let post_data = {
      // 'id': id,
      'condition': `id = ${id}`,
      'table': 'clients'
    };
    let post_function_data = {
      'post_data': post_data,
      'url': 'helpers/delete_row.php',
      'response': 'Client successfuly deleted',
    }
    ajaxCall(post_function_data, function(returnValue) {
      console.log('RESPONSE:');
      console.log(returnValue);
      if (returnValue === 'success') {
        let boxTarget = $(`.box--client[client-id="${id}"]`);
        TweenMax.to(boxTarget, .25, {
          height: 0,
          ease: Power4.easeOut,
          onComplete: function() {
            boxTarget.remove();
          }
        });
      }
    });
  }

  // listeners
  $('.delete-client').on('click', function() {
    let clientId = $(this).attr('client-id');
    deleteClient(clientId);
  });
}
