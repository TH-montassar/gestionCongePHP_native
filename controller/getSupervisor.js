$(document).ready(function () {
  $("#inputRole").change(function () {
    var selectedRole = $(this).val();
    var $supervisorSelect = $("#inputSupervisor");

    $supervisorSelect
      .empty()
      .prop("disabled", true)
      .append("<option selected>supervisor..</option>");

    if (selectedRole === "Responsable_RH") {
      $supervisorSelect.prop("disabled", true);
    } else if (selectedRole === "Manager") {
      $.ajax({
        url: "function/getRh.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          $supervisorSelect.prop("disabled", false);
          $supervisorSelect
            .empty()
            .append("<option selected>Choisir..</option>");
          // Populate supervisor options
          data.forEach(function (employee) {
            $supervisorSelect.append(
              '<option value="' +
                employee.MATRICULE +
                '">' +
                employee.NOM +
                " " +
                employee.PRENOM +
                "</option>"
            );
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error fetching managers: " + textStatus);
        },
      });
    } else if (selectedRole === "Employe") {
      $.ajax({
        url: "function/getManagers.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          $supervisorSelect.prop("disabled", false);
          $supervisorSelect
            .empty()
            .append("<option selected>Choisir..</option>");
          // Populate supervisor options
          data.forEach(function (manager) {
            $supervisorSelect.append(
              '<option value="' +
                manager.MATRICULE +
                '">' +
                manager.NOM +
                " " +
                manager.PRENOM +
                "</option>"
            );
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error fetching managers: " + textStatus);
        },
      });
    }
  });
});
