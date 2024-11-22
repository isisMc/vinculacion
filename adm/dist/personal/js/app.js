let valor = 0;
let salir = document.getElementById("salir");
let imgUser = document.getElementById("imgUser");
let nameUser = document.getElementById("nameUser");
let noti_container = document.getElementById("noti_container");

revisar_notificaciones();

// Declaracion de imagenes y nombre del usuario
imgUser.src = "dist/img/usuarios/" + sessionStorage.getItem("img");
nameUser.textContent = sessionStorage.getItem("nombre");

if (nameUser.textContent == "" || nameUser.textContent == "nombre"){
    location.href = "pages/personal/login.php"
}
// Fin de la declaracion

// Eventos
salir.addEventListener("click", ()=>{
    sessionStorage.removeItem("img");
    sessionStorage.removeItem("nombre");
    sessionStorage.removeItem("num_noti");

    location.href = "pages/personal/login.php";
});

noti_container.addEventListener("click", e => {
    e.preventDefault();

    let clasesPer = e.target.classList[e.target.classList.length-1];

    if (!(clasesPer == "btn-denegar" || clasesPer == "btn-aceptar"))
        return;

    let id = "";

    if(e.target.parentNode.parentNode.parentNode.childNodes[1].textContent.length <= 10)
        id= e.target.parentNode.parentNode.parentNode.childNodes[1].textContent
    else 
        id = e.target.parentNode.parentNode.childNodes[1].textContent;
        
    if (clasesPer == "btn-denegar") {
        (window.confirm("¿Seguro que desea denegar la solicitud?")) ? denegar(id) : alert("Solicitud no denegada");
    } else {
        (window.confirm("¿Seguro que desea aceptar la solicitud?")) ? aceptar(id) : alert("Solicitud no aceptada");
    }
});

// Fin de los eventos

function revisar_notificaciones() {
    
    fetch('dist/personal/php/revisarNoti.php')
        .then(response => response.json())
        .then(data => {

            if(data[0].clave == "NOTI"){
                alert(data[0].mensaje);
            }else{
                if (data[0].clave == "ERROR"){
                    alert(data[0].mensaje);
                }else{
                    valor = data.length;
                    for (let i = 0; i < data.length; i++) {
                        let tr = document.createElement("tr");
    
                        tr.innerHTML = `
                            <td>
                                <p>${data[i].id}</p>
                            </td>
                            <td>
                                <p>${data[i].nombre}</p>
                            </td>
                            <td>
                                ${data[i].proceso_a_revisar}
                            </td>
                            <td>
                                <button class="btn btn-warning border-0 mx-1">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-warning border-0 mx-1 btn-aceptar">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger border-0 mx-1 btn-denegar">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        `;
            
                        noti_container.appendChild(tr);
                        
                        colocar_notificaciones();
                    }

                    if (data.length > 0) {
                        let value_notis = data.length;
                        document.getElementById("card_noti").classList.remove("d-none");
                    } else if(!document.getElementById("card_noti").classList.contains("d-none")){
                        document.getElementById("card_noti").classList.add("d-none");
                    }
                }
            }
        })
        .catch(error => alert(error));
}

function colocar_notificaciones() {
    sessionStorage.setItem("num_noti",valor);
    document.getElementById("numNoti").textContent = valor;
    document.getElementById("a_numNoti").title = "Tiene " + valor + " notificaciones.";
    document.getElementById("a_numNoti").title = (parseInt(valor) == 1)?"Tiene " + valor + " notificación." : "Tiene " + valor + " notificaciones.";
}

function denegar(id) {
    let form = new FormData();

    form.append("id",id);
    form.append("status",3);
    
    fetch('dist/personal/php/_modificar_soli.php',{
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data[0].mensaje);

            location.reload();
        })
        .catch(error => alert(error));
}

function aceptar(id) {
    let form = new FormData();
    
    form.append("id",id);
    form.append("status",2);
    
    fetch('dist/personal/php/_modificar_soli.php',{
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => {

            if (data[0].clave == "EXITO") {

                fetch('dist/personal/php/_aumentar_entrega.php',{
                    method: "POST",
                    body: form
                })
                    .then(response2 => response2.json())
                    .then(data2 => {
                        alert(data[0].mensaje + "\n" + data2[0].mensaje);
            
                        location.reload();
                    })
                    .catch(error => alert(error));

            }
            
        })
        .catch(error => alert(error));
}

function saber_cuantos() {
    fetch('dist/personal/php/cuantos.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("cuantos").title = "El total de alumnos es de " + data[0].alumnos;
            document.getElementById("progress").style = "width: "+ data[0].porcentaje+ "%;";
            document.getElementById("progress").value = data[0].porcentaje + "%";
        })
        .catch(error => alert(error));
}