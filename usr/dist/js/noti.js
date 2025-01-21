let numNoti = document.getElementById('numNoti');
let notificationMenu = document.getElementById('notificationMenu');
let idAlumno = localStorage.getItem('idAlumno');
let entrega = localStorage.getItem('status')-1;
let stats = localStorage.getItem('statu');
let mensajeRechazo = "Sin mensajes";
numNoti.style.display = "inline-block";
numNoti.textContent = "1"; 
if(stats == 0){
const notificationData = {
    0: {
        header: "Solicitud Aceptada",
        message: "¡La solicitud ha sido aceptada!<br> Lleva los papeles a vinculacion.",
        buttonText: "Descargar solicitud",
        ruta: "testprojectnew/solicitud.php"
    },
    1: {
        header: "Reporte Aceptado",
        message: "¡El PRIMER reporte ha sido aceptado!<br> Lleva los papeles a vinculacion.",
        buttonText: "Descargar reporte",
        ruta: "testprojectnew/repuno.php"
    },
    2: {
        header: "Reporte Aceptado",
        message: "¡El SEGUNDO reporte ha sido aceptado!<br> Lleva los papeles a vinculacion.",
        buttonText: "Descargar reporte",
        ruta: "testprojectnew/repdos.php"
    },
    3: {
        header: "Reporte Aceptado",
        message: "¡El TERCER reporte ha sido aceptado!<br> Lleva los papeles a vinculacion.",
        buttonText: "Descargar reporte",
        ruta: "testprojectnew/reptres.php"
    },
    4: {
        header: "Reporte Final Aceptado",
        message: "¡El reporte FINAL ha sido aceptado!<br> Lleva los papeles a vinculacion.",
        buttonText: "Descargar reporte",
        ruta: "testprojectnew/repfinal.php"
    },
};

if (notificationData[entrega]) {
    const data = notificationData[entrega];
    notificationMenu.innerHTML = `
        <span class="dropdown-item dropdown-header">${data.header}</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-check-circle mr-2" style="color: green;"></i> ${data.message}
            <span class="float-right text-muted text-sm"></span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item btn btn-primary btn-sm" id="downloadButton">
            <i class="fas fa-file-download mr-2"></i> ${data.buttonText}
        </a>

        <div class="dropdown-divider"></div>
    `;
    descragar(data.ruta);
}

function descragar(ruta) {
    const downloadButton = document.getElementById('downloadButton');
    downloadButton.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = ruta;
    });
}
} else if (stats == 3) {
let form = new FormData();
form.append("idAlumno", idAlumno);
form.append("proceso", entrega + 1);

fetch('dist/personal/php/mensajes.php', {
    method: "POST",
    body: form
})
    .then(response => response.json())
    .then(data => {
        if (data[0].clave === "ok") {
            mensajeRechazo = data[0].datosRechazo;
            actualizarMenuRechazo(mensajeRechazo, entrega);
        }
    })
    .catch(error => alert("Error: " + error));
}

function actualizarMenuRechazo(mensaje, entrega) {
const notificationData = {
    0: {
        header: "Solicitud Rechazada",
        message: "¡La solicitud ha sido rechazada!<br>",
        mensajeRechazo: "Mensaje del administrador:<br>"+  mensaje
    },
    1: {
        header: "Reporte Rechazado",
        message: "¡El PRIMER reporte se ha devuleto!<br>",
        mensajeRechazo: "Mensaje del administrador:<br>"+  mensaje
    },
    2: {
        header: "Reporte rechazado",
        message: "¡El SEGUNDO reporte se ha devuleto!<br>",
        mensajeRechazo: "Mensaje del administrador:<br>"+  mensaje
    },
    3: {
        header: "Reporte rechazado",
        message: "¡El TERCER reporte se ha devuleto!<br>",
        mensajeRechazo: "Mensaje del administrador:<br>"+  mensaje
    },
    4: {
        header: "Reporte Final Rechazado",
        message: "¡El reporte FINAL se ha devuleto!<br>",
        mensajeRechazo: "Mensaje del administrador:<br>"+ mensaje
    },
};

if (notificationData[entrega]) {
    const data = notificationData[entrega];
    notificationMenu.innerHTML = `
        <span class="dropdown-item dropdown-header">${data.header}</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-ban mr-2" style="color: red;"></i> ${data.message} 
            <i class="fas fa-comments mr-2" style="color: white;"></i> ${data.mensajeRechazo} 
            <span class="float-right text-muted text-sm"></span>
        </a>
        <div class="dropdown-divider"></div>
    `;
}
}

const notificationBell = document.getElementById('notificationBell');
notificationBell.addEventListener('click', function (e) {
e.preventDefault();
notificationMenu.classList.toggle('show');
});