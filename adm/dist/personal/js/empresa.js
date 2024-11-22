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

document.getElementById("salir").addEventListener("click", ()=>{
    sessionStorage.removeItem("img");
    sessionStorage.removeItem("nombre");
    sessionStorage.removeItem("num_noti");

    location.href = "pages/personal/login.php";
});

container.addEventListener("click",e => {
    e.preventDefault();
    
    const clasesPer = e.target.classList[e.target.classList.length-1];

    if (!(clasesPer == "btn-eliminar" || clasesPer == "btn-editar")) return;

    let id = "";
    
    id = e.target.closest("tr").childNodes[0].textContent;
    
    if (clasesPer == "btn-eliminar") {
        (window.confirm("¿Seguro que desea eliminar este usuario?")) ? eliminar(id) : alert("Usuario no eliminado");
    } else {
        editar(id);
    }
});

function eliminar(id) {
    const form = new FormData(); 

    form.append("id",id);
    form.append("tablas","empresas");
    form.append("columnas","idEmpresa");

    fetch("dist/personal/php/eliminar.php",{
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data[0].mensaje);

            location.reload();
        })
        .catch (error => {
            console.error(error);
            alert("Ocurrió un error al procesar la solicitud.");
        })
}

function editar(id) {
    
}