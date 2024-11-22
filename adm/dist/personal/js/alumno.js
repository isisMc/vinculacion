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

document.getElementById("container_grupos").addEventListener("click", (e)=> {

  if (e.target.classList[e.target.classList.length - 1] !== "btn_grupos") 
    return

  let form = new FormData();

  form.append("grupo", e.target.id.split("-")[1]);

  fetch("dist/personal/php/cambiar_sesion.php",{
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(data => {
      (data[0].clave !== "OK")?alert(data[0].mensaje):location.reload();
    })
    .catch(error => console.log(error));
});

document.getElementById("salir").addEventListener("click", ()=>{
    sessionStorage.removeItem("img");
    sessionStorage.removeItem("nombre");
    sessionStorage.removeItem("num_noti");

    location.href = "pages/personal/login.php";
});