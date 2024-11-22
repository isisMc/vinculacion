let num_noti = 0;

if (!sessionStorage.getItem("entrada")){
    location.href = "pages/personal/login.php"
}

revisar_notificaciones();

function revisar_notificaciones() {
    fetch('dist/personal/php/revisarNoti.php')
        .then(response => response.json())
        .then(data => {
            if (sessionStorage.getItem("mensaje_env")) {
                return;                
            }

            alert(data[0].mensaje);

            if (data[0].mensaje === "No hay notificaciones pendientes" || data[0].mensaje.split(" ")[0] === "En") {
                sessionStorage.setItem("mensaje_env", 1);
            } else {
                if (data[0].mensaje.split(" ")[0] === "Se" || data[0].mensaje.split(" ")[0] === "El") {
                    fetch('dist/personal/php/actualizarStatus.php')
                        .then(responses => responses.json())
                        .then(datas => {
                            if (datas[0].clave !== "OK")
                                alert("Error: " + data[0].mensaje);
                        })
                        .catch(errors => alert(errors));    
                }
            }
            
        })
        .catch(error => console.log(error));
}

document.getElementById("salir").addEventListener("click", ()=>{
    mensajeEnv = 0;

    sessionStorage.removeItem("entrada");
    sessionStorage.removeItem("num_noti");
    sessionStorage.removeItem("mensaje_env");

    location.href = "pages/personal/login.php";
});

sessionStorage.setItem("num_noti",num_noti);