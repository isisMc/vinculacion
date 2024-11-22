document.getElementById("salir").addEventListener("click", () => {
    mensajeEnv = 0;
  
    sessionStorage.removeItem("entrada");
    sessionStorage.removeItem("num_noti");
  
    location.href = "pages/personal/login.php";
  });
  const formulario = document.getElementById("personal");
  const formulario2 = document.getElementById("formularioEsc");
  let today = new Date();
  let yyyy = today.getFullYear();
  let mm = today.getMonth() + 1;
  let dd = today.getDate();
  let formattedDate = yyyy + "-" + mm + "-" + dd;
  
  document.getElementById("salir").addEventListener("click", () => {
    mensajeEnv = 0;
  
    sessionStorage.removeItem("entrada");
    sessionStorage.removeItem("num_noti");
  
    location.href = "pages/personal/login.php";
  });
  
  if (mm < 10) {
    mm = "0" + mm;
  }
  if (dd < 10) {
    dd = "0" + dd;
  }
  document.getElementById("fechaEnvio").value = formattedDate;
  
  formulario2.addEventListener("submit", (e) => {
    e.preventDefault();
    document.getElementById("fechaEnvio").disabled = false;
    enviarDatos();
    document.getElementById("fechaEnvio").disabled = true;
  });
  function enviarDatos() {
    const formData = new FormData(formulario2);
  
    fetch("dist/personal/php/insertReporte.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data[0].clave === "ok") {
          alert(
            "Reporte enviado y en proceso de revisión. Por favor esté pendiente a una respuesta."
          );
        } else {
          alert("Error intentelo de nuevo");
        }
      })
      .catch((error) => {
        console.log("Error en la conexión con el servidor: " + error);
      });
  }
  