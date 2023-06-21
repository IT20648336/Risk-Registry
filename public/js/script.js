$(document).ready(function() {
  // Retrieve the CSRF token
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $('.notificationacceptbtn, .notificationremovebtn').click(function() {
    var button = $(this);
    var riskId = button.data('risk-id');
    var status = button.hasClass('notificationacceptbtn') ? 'approved' : 'rejected';

    $.ajax({
      url: '/update-email-status/' + riskId + '/' + status,
      type: 'PUT',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function(response) {
        // Handle the success response
        console.log(response);

        // Reload the page
        location.reload();
      },
      error: function(xhr, status, error) {
        // Handle the error response
        console.error(error);
      }
    });
  });
});
