let container = document.getElementById("container_prin");

let imgUser = document.getElementById("imgUser");
let nameUser = document.getElementById("nameUser");

imgUser.src = "dist/img/usuarios/" + sessionStorage.getItem("img");
nameUser.textContent = sessionStorage.getItem("nombre");

if (nameUser.textContent == "" || nameUser.textContent == "nombre"){
    location.href = "pages/personal/login.php"
}

document.getElementById("numNoti").textContent = sessionStorage.getItem("num_noti");
document.getElementById("a_numNoti").title = (sessionStorage.getItem("num_noti") == 1)?"Tiene " + sessionStorage.getItem("num_noti") + " notificación." : "Tiene " + sessionStorage.getItem("num_noti") + " notificaciones.";
/*document.addEventListener("click", function(event) {
    if (event.target.tagName === "BUTTON" || event.target.closest("button")) {
        let button = event.target.closest("button"); // Captura el botón en caso de que el clic sea en el ícono `<i>`
        let id = button.id; // Obtiene el ID del botón
        console.log("Botón clickeado:", id);

        // Verifica el tipo de botón usando el ID
        let action = '';
        let idAlumno = '';

        if (id.startsWith("borrar-")) {
            action = 'borrar';
            idAlumno = id.split("-")[1]; // Extrae el idAlumno del ID
            console.log("Se clickeó el botón de borrar para el alumno con ID:", idAlumno);
        } else if (id.startsWith("editar-")) {
            action = 'editar';
            idAlumno = id.split("-")[1];
            console.log("Se clickeó el botón de editar para el alumno con ID:", idAlumno);
        } else if (id.startsWith("foto-")) {
            action = 'foto';
            idAlumno = id.split("-")[1];
            console.log("Se clickeó el botón de foto para el alumno con ID:", idAlumno);
        }

        // Realiza el fetch solo si se ha determinado una acción
        if (action) {
            fetch('dist/personal/php/bef.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: action, idAlumno: idAlumno })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Maneja la respuesta del servidor

                // Si la acción es editar y la respuesta es exitosa, abrir el modal
                if (action === "editar" && data[0].clave === "OK") {
                    abrirModal(data[0].alumno); // Pasar la información del alumno al modal
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    }
});

// Función para abrir el modal y mostrar la información del alumno
function abrirModal(alumno) {
    const modalContent = document.getElementById("modal-content");
    modalContent.innerHTML = `
        <img src="${alumno.img}" alt="Foto del Alumno" width="100px">
        <p>Nombres: ${alumno.nombres}</p>
        <p>Paterno: ${alumno.paterno}</p>
        <p>Materno: ${alumno.materno}</p>
        <p>Dirección: ${alumno.direccion}</p>
        <p>No. Int: ${alumno.noint}</p>
        <p>No. Ext: ${alumno.noext}</p>
        <p>CP: ${alumno.cp}</p>
        <p>Colonia: ${alumno.colonia}</p>
        <p>Estado: ${alumno.estado}</p>
        <p>Municipio: ${alumno.municipio}</p>
        <p>Teléfono: ${alumno.telefono}</p>
        <p>Sexo: ${alumno.sexo}</p>
        <p>Especialidad: ${alumno.especialidad}</p>
        <p>Semestre: ${alumno.semestre}</p>
        <p>Grupo: ${alumno.grupo}</p>
        <p>Generación: ${alumno.generacion}</p>
        <p>CURP: ${alumno.curp}</p>
        <p>No. Control: ${alumno.noctrl}</p>
    `;
    document.querySelector(".modal-overlay").classList.remove("hide"); // Mostrar el modal
}

// Cerrar el modal
document.querySelector(".close-modal-btn").addEventListener("click", function() {
    document.querySelector(".modal-overlay").classList.add("hide"); // Ocultar el modal
});*/

document.getElementById("container_grupos").addEventListener("click", (e) => {
  if (e.target.classList[e.target.classList.length - 1] !== "btn_grupos") 
      return;

  let btnselect = e.target.id;

  // Cambiar el color del botón seleccionado
  document.getElementById(btnselect).classList.remove("btn-light");
  document.getElementById(btnselect).classList.add("btn-danger");

  // Almacenar el grupo seleccionado en sessionStorage
  sessionStorage.setItem("grupoSeleccionado", btnselect.split("-")[1]);

  let form = new FormData();
  form.append("grupo", btnselect.split("-")[1]);

  fetch("dist/personal/php/cambiar_sesion.php", {
      method: "POST",
      body: form
  })
  .then(response => response.json())
  .then(data => {
      if (data[0].clave !== "OK") {
          alert(data[0].mensaje);
      } else {
          location.reload();
      }
  })
  .catch(error => console.log(error));
});

// Al cargar la página, cambiar el color del botón del grupo seleccionado
window.onload = function() {
  let grupoSeleccionado = sessionStorage.getItem("grupoSeleccionado");
  if (grupoSeleccionado) {
      let btnGrupo = document.getElementById("btn-" + grupoSeleccionado);
      if (btnGrupo) {
          btnGrupo.classList.remove("btn-light");
          btnGrupo.classList.add("btn-danger");
      }
  }
};

document.getElementById("salir").addEventListener("click", ()=>{
    sessionStorage.removeItem("img");
    sessionStorage.removeItem("nombre");
    sessionStorage.removeItem("num_noti");

    location.href = "pages/personal/login.php";
});