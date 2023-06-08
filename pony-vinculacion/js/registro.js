var radioButtons = document.querySelectorAll('input[name="tipo"]');
let alumno = document.getElementById('alumnoForm');
let vinculacion = document.getElementById('vinculacionForm');
let empresa1 = document.getElementById('empresa1Form');
let empresa2 = document.getElementById('empresa2Form');
let selected="alumno";

vinculacion.style.display='none';
empresa1.style.display='none';
empresa2.style.display='none';


radioButtons.forEach(function (radioButton) {
  radioButton.addEventListener('change', function () {
    if (this.checked) {
      switch (this.value) {
        case "alumno":
          alumno.style.display = 'flex';
          vinculacion.style.display = 'none';
          empresa1.style.display = 'none';
          empresa2.style.display = 'none';
          selected = "alumno";
          break;

        case "vinculacion":
          alumno.style.display = 'none';
          vinculacion.style.display = 'flex';
          empresa1.style.display = 'none';
          empresa2.style.display = 'none';
          selected = "vinculacion"
          break;

        case "empresa":
          alumno.style.display = 'none';
          vinculacion.style.display = 'none';
          empresa1.style.display = 'flex';
          empresa2.style.display = 'flex';
          selected = "empresa"
          break;
      }
    }
  });
});


function checkPasswordMatch() {
  var passwordAlumno = document.getElementsByName("contrasenaAlumno")[0].value;
  var confirmPasswordAlumno = document.getElementsByName("confirmarContrasenaAlumno")[0].value;
  var mismatchMessageAlumno = document.getElementById("mismatchMessageAlumno");

  var passwordEmpresa = document.getElementsByName("contrasenaEmpresa")[0].value;
  var confirmPasswordEmpresa = document.getElementsByName("confirmarContrasenaEmpresa")[0].value;
  var mismatchMessageEmpresa = document.getElementById("mismatchMessageEmpresa");

  var passwordVinculacion = document.getElementsByName("contrasenaVinculacion")[0].value;
  var confirmPasswordVinculacion = document.getElementsByName("confirmarContrasenaVinculacion")[0].value;
  var mismatchMessageVinculacion = document.getElementById("mismatchMessageVinculacion");

  switch (selected) {
    case "alumno":
      if (passwordAlumno !== confirmPasswordAlumno) {
        mismatchMessageAlumno.style.display = "block";
      } else {
        mismatchMessageAlumno.style.display = "none";
      }
      break;

    case "vinculacion":
      if (passwordVinculacion !== confirmPasswordVinculacion) {
        mismatchMessageVinculacion.style.display = "block";
      } else {
        mismatchMessageVinculacion.style.display = "none";
      }
      break;

    case "empresa":
      if (passwordEmpresa !== confirmPasswordEmpresa) {
        mismatchMessageEmpresa.style.display = "block";
      } else {
        mismatchMessageEmpresa.style.display = "none";
      }
      break;
  }
}