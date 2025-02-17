const enviar = document.getElementById("btn");
const video = document.getElementById("video");
const volver = document.getElementById("volver");
const volver2 = document.getElementById("volver2");
const volver3 = document.getElementById("volver3");
const formFoto = document.getElementById("personal");
const fechaInicio = document.getElementById("inicio");
const fechaFinal = document.getElementById("termino");
const openModal = document.getElementById("openModal");
const formEmpresa = document.getElementById("formularioEsc");
const takeSnapshot = document.getElementById("takeSnapshot");
const formDtUnicos = document.getElementById("formularioEmp");
const takePictureButton = document.getElementById("takePicture");
let actividades_textArea = document.getElementById("actividades");
let btnSs = document.getElementById("btnSs");
let enviado = 0;
let subir = false;
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

if (document.getElementById("empresa").value.length > 0) 
  document.getElementById("btn2").disabled = false;

if(openModal != null){
  const imagenSeleccionda = document.getElementById("imagenSeleccionda");
  let path = "";
  let modalInstance;

  openModal.addEventListener("click", () => {
      modalInstance = new bootstrap.Modal(document.getElementById("cameraModal"));
      modalInstance.show();

      navigator.mediaDevices.getUserMedia({ video: true })
          .then(stream => {
              video.srcObject = stream;
              video.style.width = '100%';
              video.style.height = 'auto';
          })
          .catch(error => {
            if (error.name === 'NotAllowedError') {
                alert("No se otorgaron permisos para acceder a la cámara.");
            } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
                alert("No se encontró una cámara en tu dispositivo.");
            } else {
                alert("Ocurrió un error inesperado al acceder a la cámara.");
            }
        
            modalInstance.hide();
          });
  });

  takeSnapshot.addEventListener("click", () => {
    const canvas = document.getElementById('foto');
    const context = canvas.getContext('2d');

    canvas.width = video.clientWidth;
    canvas.height = video.clientHeight;

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    takePictureButton.disabled = false;
  });

  takePictureButton.addEventListener("click", () => {
    const noctrl = document.getElementById("noctrl").value;

    if (modalInstance) {
        modalInstance.hide();
        const stream = video.srcObject; 
        const tracks = stream.getTracks(); 
        tracks.forEach(track => track.stop()); 
    }

    const dataURL = foto.toDataURL('image/png');
    foto.style.display = 'none'; 

    fetch('../config/php/upload.php', {
        method: 'POST',
        body: JSON.stringify({ image: dataURL, noctrl: noctrl }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())  
    .then(data => {
        if (data.success) {
            const path = data.imagePath; 
            imagenSeleccionda.src = path; 

            fetch("../config/php/saveImg.php", {
                method: "POST",
                body: JSON.stringify({ noctrl: noctrl, path: path }), 
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.clave !== 'ok') {
                    alert(data.mensaje); 
                }
            })
            .catch(error => console.error('Error', error));
        } else {
            alert('Error al guardar la imagen: ' + data.error);
        }
    })
    .catch(error => console.error('Error en upload.php:', error));
  });
}

document.getElementById("salir").addEventListener("click", ()=>{
    mensajeEnv = 0;

    sessionStorage.removeItem("entrada");
    sessionStorage.removeItem("num_noti");
    sessionStorage.removeItem("mensaje_env");

    location.href = "pages/personal/login.php";
});


// Inicio de las funciones de los formularios

document.getElementById("btnSs").addEventListener("click", ( ) => {
  formFoto.classList.add("hidden");
  formEmpresa.classList.remove("hidden");
});

document.getElementById("btn2").addEventListener("click", ( ) => {
  formEmpresa.classList.add("hidden");
  formDtUnicos.classList.remove("hidden");
});

document.getElementById("volver2").addEventListener("click", ( ) => {
  formEmpresa.classList.add("hidden");
  formFoto.classList.remove("hidden");
});

document.getElementById("volver3").addEventListener("click", ( ) => {
  formDtUnicos.classList.add("hidden");
  formEmpresa.classList.remove("hidden");
});

formDtUnicos.addEventListener("submit", (e) => {
  e.preventDefault();
  if (!formDtUnicos.checkValidity()) 
    return;

  let data = new FormData(formDtUnicos);
  
  data.append("termino", document.getElementById("termino").value);

  data.append("id_empresa", sessionStorage.getItem("id_empresa_hide"));
  
  fetch("dist/personal/php/guardar_datos.php", {
      method: "POST",
      body: data
  })
      .then(response => response.json())
      .then(data => {
        if (data[0].clave !== "OK") {
          alert(data[0].mensaje);
        } else {
          fetch("dist/personal/php/actualizarStatus.php")
            .then(responses => responses.json())
            .then(datas => {
              if (datas[0].clave !== "OK") {
                alert(datas[0].mensaje);
              } else {
                alert("Solicitud enviada\nEspere a que sea revisada por el administrador.");
                
                location.href = "pages/personal/login.php";
              }
            })
            .catch(errors => {
              console.error("Error en la actualización del status:", errors);
              alert("Error al actualizar el status");
            });
        }
      })
      .catch(error => {
          console.error("Error en la solicitud:", error);
      });
});
if(direccion.value.trim()=== ""  || direccion.value.trim()=== null  || numext.value.trim()=== "" ||numext.value.trim()=== null ||numint.value.trim()=== "" ||numint.value.trim()=== null||
 cp.value.trim()=== ""|| cp.value.trim()=== null||colonia.value.trim()=== ""|| colonia.value.trim()=== null ||telefono.value.trim()=== "" ||telefono.value.trim()=== null){
 if(direccion.value.trim()=== ""  || direccion.value.trim()=== null){
  direccion.removeAttribute('disabled');
 }
 if(numext.value.trim()=== ""  || numext.value.trim()=== null){
  numext.removeAttribute('disabled');
 }
 if(numint.value.trim()=== ""  || numint.value.trim()=== null){
  numint.removeAttribute('disabled');
 }
 if(cp.value.trim()=== ""  || cp.value.trim()=== null){
  cp.removeAttribute('disabled');
 }
 if(colonia.value.trim()=== ""  || colonia.value.trim()=== null){
  colonia.removeAttribute('disabled');
 }
 if(telefono.value.trim()=== ""  || telefono.value.trim()=== null){
  telefono.removeAttribute('disabled');
 }
 subir = true;
} 

btnSs.addEventListener("click", (e) => {
  if(subir == true){
  e.preventDefault();

  let dataN = new FormData(formFoto);
  fetch("dist/personal/php/subir_datos.php", {
    method: "POST",
    body: dataN
})
    .then(response => response.json())
    .then(data => {
      if (data[0].clave !== "OK") {
        alert(data[0].mensaje);
      } 
    })
    .catch(error => {
      location.href = "dist/personal/php/subir_datos.php";
        console.error("Error en la solicitud:", error);
      
    });

} 
});
//Fin de las funciones de los formualrios

document.getElementById("searchInput").addEventListener("keyup", function() {
  const input = this.value.toLowerCase();
  const listItems = document.querySelectorAll("#professionList li");
  const ul = document.getElementById("professionList");  
  let tiene = 0;

  if (input.length === 0) {
      ul.style.display = "none";
      return;
  }

  listItems.forEach(item => {
      const profession = item.textContent.toLowerCase();
      if (profession.includes(input)) {
          item.style.display = "";
          tiene++;
      } else {
          item.style.display = "none";
      }
  });

  if (tiene > 0) {
      ul.style.display = "block";
      tiene = 0;
  } else {
      ul.style.display = "none";
      tiene = 0;
  }
}); 

document.getElementById("professionList").addEventListener("click", e => {
  e.preventDefault();

  let clasesPer = e.target.classList[e.target.classList.length-1];

  if (clasesPer !== "seleccionar-empresa")
      return;

  let celdas = e.target.closest("li").querySelectorAll("span");

  if (celdas[0].textContent.length === 0 || celdas[0].textContent === " ") {
      alert("Empresa vacía\nHable con la administridora")
  } else {
      document.getElementById("empresa").value = celdas[1].textContent;
      obtenerDatos(celdas[0].textContent);
  }
});

actividades_textArea.placeholder = "Ejemplo de cómo ingresar las actividades (no ingrese números):\nBarrer, limpiar cajas, acomodar cajas, barrer, trapear.";

actividades_textArea.addEventListener("keyup", function () {
  (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,]*$/g.test(actividades_textArea.value)) ?
      actividades_textArea.classList.replace("is-invalid", "is-valid") :
      actividades_textArea.classList.replace("is-valid", "is-invalid");
});

function obtenerDatos(idEmpresa) {
  let datos = new FormData();
  datos.append("idEmpresa", idEmpresa);

  fetch("dist/personal/php/obtenerDatos.php", {
      method: "POST",
      body: datos
  })
      .then(response => response.json())
      .then(data => {
          if (data[0].clave !== "ok") {
              alert("Error al obtener los datos\nNotifique lo a los administradores.");
              console.log("Error tipo: "+ data[0].clave);
          } else {
            sessionStorage.setItem("id_empresa_hide", idEmpresa);
            document.getElementById("correo").value          = data[0].correo;
            document.getElementById("direcEmpresa").value    = data[0].direccion;
            document.getElementById("jefe").value            = data[0].jefe;
            document.getElementById("telefonoEmp").value     = data[0].telefono;
            document.getElementById("cpEmp").value           = data[0].cp;
            document.getElementById("coloniaEmp").value      = data[0].colonia;
            document.getElementById("btn2").disabled         = false;
          }
      })
      .catch(error => {
          console.error("Error en la solicitud:", error);
      });
}

document.getElementById("fechaEnvio").value = formattedDate;

let maxDate = new Date(today);
maxDate.setMonth(maxDate.getMonth() + 3);

if (maxDate.getDate() !== dd) {
  maxDate.setDate(0);
}

let maxYyyy = maxDate.getFullYear();
let maxMm = maxDate.getMonth() + 1;
let maxDd = maxDate.getDate();

if (maxMm < 10) {
  maxMm = "0" + maxMm;
}
if (maxDd < 10) {
  maxDd = "0" + maxDd;
}

let formattedMaxDate = `${maxYyyy}-${maxMm}-${maxDd}`;

fechaInicio.setAttribute("min", formattedDate);
fechaInicio.setAttribute("max", formattedMaxDate);

fechaInicio.addEventListener("change", () => {
  if (fechaInicio.value !== "") {
    const [yyyy, mm, dd] = fechaInicio.value.split("-");
    
    let fecha = new Date(`${yyyy}-${mm}-${dd}`);

    fecha.setMonth(fecha.getMonth() + 4);

    if (fecha.getDate() !== parseInt(dd)) {
        fecha.setDate(0);
    }

    const yyyyMax = fecha.getFullYear();
    const mmMax = (fecha.getMonth() + 1).toString().padStart(2, "0");
    const ddMax = fecha.getDate().toString().padStart(2, "0");
    const fechaMax = `${yyyyMax}-${mmMax}-${ddMax}`;

    fechaFinal.value = fechaMax;
  }
});

