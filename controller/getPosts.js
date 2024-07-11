// script.js

// Function to dynamically populate posts based on selected department
$(document).ready(function () {
  $("#inputDepartement").change(function () {
    var departementId = $(this).val();
    $.ajax({
      type: "POST",
      url: "controller/getPosts.php", // PHP script to fetch posts based on department
      data: {
        departementId: departementId,
      },
      success: function (response) {
        $("#inputPost").html(response);
      },
    });
  });
});
