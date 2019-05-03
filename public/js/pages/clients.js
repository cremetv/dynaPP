if ($('body').hasClass('clients')) {
  $(document).ready(function() {

    $('#search').quicksearch('main .box--client', {
      selector: 'h1'
    });
    $('#search').focus();

  });

  // actions
  const deleteClient = (id) => {
    let post_data = {
      'id': id,
      'table': 'clients'
    };
    ajaxCall(post_data, 'helpers/delete_row.php', 'Client successfuly deleted');
  }

  // listeners
  $('.delete-client').on('click', function() {
    let clientId = $(this).attr('client-id');
    deleteClient(clientId);
  });
}
