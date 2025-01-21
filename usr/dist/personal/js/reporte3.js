const formulario = document.getElementById("personal");
const formulario2 = document.getElementById("formularioEsc");
let today = new Date();

let yyyy = today.getFullYear();
let mm = today.getMonth() + 1;
let dd = today.getDate();

if (mm < 10) {
  mm = "0" + mm;
}
if (dd < 10) {
  dd = "0" + dd;
}

let formattedDate = `${yyyy}-${mm}-${dd}`;
document.getElementById("fechaEnvio").value = formattedDate;

document.getElementById("salir").addEventListener("click", () => {
  mensajeEnv = 0;

  sessionStorage.removeItem("entrada");
  sessionStorage.removeItem("num_noti");

  location.href = "pages/personal/login.php";
});

formulario2.addEventListener("submit", (e) => {
  e.preventDefault();
  document.getElementById("fechaEnvio").disabled = false;
  enviarDatos();
  document.getElementById("fechaEnvio").disabled = true;
});
function enviarDatos() {
  const formData = new FormData(formulario2);
formData.append("idAlumno", idAlumno.value);
formData.append("fecha3", fechaEnvio.value);

  fetch("dist/personal/php/insertReporte3.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data[0].clave === "OK") {
        alert(
          "Reporte enviado y en proceso de revisión. Por favor esté pendiente a una respuesta."
        );
        fetch('dist/personal/php/close.php',
          {
              method: 'POST'
          });
          location.reload();
      } else {
        alert("Error intentelo de nuevo");
      }
    })
    .catch((error) => {
      console.log("Error en la conexión con el servidor: " + error);
    });
}
