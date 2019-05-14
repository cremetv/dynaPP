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
      'responseType': 'success',
      'response': 'Client successfuly deleted',
    }
    ajaxCall(post_function_data, function(returnValue) {
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

  const addClient = () => {
    let clientName = $('#clientName').val(),
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

    let values = {
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
    }

    let post_data = {
      'table': 'clients',
      'values': values
    }

    let post_function_data = {
      'post_data': post_data,
      'url': 'helpers/insert_row.php',
      'response': 'Client successfuly created',
    }
    ajaxCall(post_function_data, function(returnValue) {
      console.log(returnValue);
      if (returnValue === 'success') {
        // add new client to list or reload page
      }
    });
  }

  // listeners
  $('.delete-client').on('click', function() {
    let clientId = $(this).attr('client-id');
    deleteClient(clientId);
  });
}
