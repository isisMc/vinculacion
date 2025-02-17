let valor = 0;
let salir = document.getElementById("salir");
let imgUser = document.getElementById("imgUser");
let nameUser = document.getElementById("nameUser");
let noti_container = document.getElementById("noti_container");
let proceso = "";
let pro = "";
revisar_notificaciones();

// Declaracion de imagenes y nombre del usuario
imgUser.src = "dist/img/usuarios/" + sessionStorage.getItem("img");
nameUser.textContent = sessionStorage.getItem("nombre");

if (nameUser.textContent == "" || nameUser.textContent == "nombre") {
    location.href = "pages/personal/login.php"
}
// Fin de la declaracion

// Eventos
salir.addEventListener("click", () => {
    sessionStorage.removeItem("img");
    sessionStorage.removeItem("nombre");
    sessionStorage.removeItem("num_noti");

    location.href = "pages/personal/login.php";
});

noti_container.addEventListener("click", e => {
    e.preventDefault();

    let clasesPer = e.target.classList[e.target.classList.length - 1];

    if (!(clasesPer == "btn-denegar" || clasesPer == "btn-aceptar"))
        return;

    let id = "";

    if (e.target.parentNode.parentNode.parentNode.childNodes[1].textContent.length <= 10){
        id = e.target.parentNode.parentNode.parentNode.childNodes[1].textContent
    }else{
        idT = e.target.parentNode.parentNode.childNodes[1].textContent;
        id = idT.trim();
    }
    if (clasesPer == "btn-denegar") {
        denegar(id,pro);
    } else {
        (window.confirm("¿Seguro que desea aceptar la solicitud?")) ? aceptar(id) : alert("Solicitud no aceptada");
    }
});

function revisar_notificaciones() {

    fetch('dist/personal/php/revisarNoti.php')
        .then(response => response.json())
        .then(data => {

            if (data[0].clave == "NOTI") {
                alert(data[0].mensaje);
            } else {
                if (data[0].clave == "ERROR") {
                    alert(data[0].mensaje);
                } else {
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
                            
                                <button id="${data[i].id}" class="btn btn-light border-0 mx-1">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-success border-0 mx-1 btn-aceptar">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger border-0 mx-1 btn-denegar">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        `;
                        if (data[i].proceso_a_revisar == "Formulario") {
                            pro = 0;
                        } else if (data[i].proceso_a_revisar == "Primer Reporte") {
                            pro = 1;
                        } else if (data[i].proceso_a_revisar == "Segundo Reporte") {
                            pro = 2;
                        } else if (data[i].proceso_a_revisar == "Tercer Reporte") {
                            pro = 3;
                        } else if (data[i].proceso_a_revisar == "Reporte Final") {
                            pro = 4;
                        }
                        noti_container.appendChild(tr);
                        let buttonAbrirPlantilla = document.getElementById(data[i].id);

                        buttonAbrirPlantilla.addEventListener("click", function () {
                            if (data[i].proceso_a_revisar == "Formulario") {
                                proceso = 0;
                            } else if (data[i].proceso_a_revisar == "Primer Reporte") {
                                proceso = 1;
                            } else if (data[i].proceso_a_revisar == "Segundo Reporte") {
                                proceso = 2;
                            } else if (data[i].proceso_a_revisar == "Tercer Reporte") {
                                proceso = 3;
                            } else if (data[i].proceso_a_revisar == "Reporte Final") {
                                proceso = 4;
                            }
                            abrir_plantilla(data[i].id, proceso);
                        });
                        colocar_notificaciones();
                    }

                    if (data.length > 0) {
                        let value_notis = data.length;
                        document.getElementById("card_noti").classList.remove("d-none");
                    } else if (!document.getElementById("card_noti").classList.contains("d-none")) {
                        document.getElementById("card_noti").classList.add("d-none");
                    }
                }
            }
        })
        .catch(error => alert(error));
}

function colocar_notificaciones() {
    sessionStorage.setItem("num_noti", valor);
    document.getElementById("numNoti").textContent = valor;
    document.getElementById("a_numNoti").title = "Tiene " + valor + " notificaciones.";
    document.getElementById("a_numNoti").title = (parseInt(valor) == 1) ? "Tiene " + valor + " notificación." : "Tiene " + valor + " notificaciones.";
}

function denegar(id,proceso) {
    let modalHTML = `
        <div class="modal fade" id="denegarModal" tabindex="-1" aria-labelledby="denegarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="denegarModalLabel">Denegar Solicitud</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Seguro que desea denegar la solicitud?</p>
                        <textarea id="mensajeDenegacion" class="form-control" placeholder="Escriba un mensaje opcional (opcional)" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmarDenegacion">Denegar</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const denegarModal = new bootstrap.Modal(document.getElementById('denegarModal'), {
        backdrop: 'static',
        keyboard: false
    });

    denegarModal.show();

    document.getElementById('confirmarDenegacion').addEventListener('click', () => {
        const mensaje = document.getElementById('mensajeDenegacion').value;

        enviarDenegacion(id, mensaje, proceso);
        denegarModal.hide();
        document.getElementById('denegarModal').remove();
    });
}
function enviarDenegacion(id, mensaje, proceso) {
    let form = new FormData();

    form.append("id", id);
    form.append("status", 3);
    form.append("proceso", proceso);
    form.append("mensaje", mensaje);

    fetch('dist/personal/php/_modificar_soli.php', {
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

    form.append("id", id);
    form.append("status", 1);

    fetch('dist/personal/php/_modificar_soli.php', {
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => {

            if (data[0].clave == "EXITO") {

                fetch('dist/personal/php/_aumentar_entrega.php', {
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
function abrir_plantilla(id, proceso) {
    console.log(id);
    let form = new FormData();
    form.append("id", id);

    fetch('dist/personal/php/plantilla.php', {
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => {
            if (data[0].clave == "ok") {
                img = data[0].img;
                if (img == "" || img == " ") {
                    img = "dist/img/usuarios/1.png";
                } else {
                    img = "../usr/"+ data[0].img;
                }
                nombres = data[0].nombres;
                paterno = data[0].paterno;
                materno = data[0].materno;
                direccion = data[0].direccion;
                noint = data[0].noint;
                noext = data[0].noext;
                cp = data[0].cp;
                colonia = data[0].colonia;
                municipio = data[0].municipio;
                estado = data[0].estado;
                telefono = data[0].telefono;
                sexo = data[0].sexo;
                especialidad = data[0].especialidad;
                semestre = data[0].semestre;
                grupo = data[0].grupo;
                generacion = data[0].generacion;
                noctrl = data[0].noctrl;
                curp = data[0].curp;

                if (data[1].clave == "ok") {
                    empresa = data[2].nombre_empresa;
                    direccionEmp = data[2].direccionEmp;
                    cpEmp = data[2].cpEmp;
                    coloniaEmp = data[2].coloniaEmp;
                    telefonoEmp = data[2].telefonoEmp;
                    giroEmp = data[2].giroEmp;
                    correoEmp = data[2].correoEmp;
                    puesto = data[2].puesto;
                    tipo = data[2].tipo;

                    horas = data[1].horas;
                    incentivo = data[1].incentivo;
                    departamento = data[1].departamento;
                    hora_entrada = data[1].hora_entrada;
                    hora_salida = data[1].hora_salida;
                    jefe_inmediato = data[1].jefe_inmediato;
                    giro = data[1].giro;
                    inicio = data[1].inicio;
                    termino = data[1].termino;
                    actividades = data[1].actividades;
                    if (proceso != 0) {
                        actividad1 = data[3].actividad1;
                        fecha1 = data[3].fecha1;
                        actividad2 = data[3].actividad2;
                        fecha2 = data[3].fecha2;
                        actividad3 = data[3].actividad3;
                        fecha3 = data[3].fecha3;
                        
                        fechaFinal = data[3].fechaFinal;
                    }
                    if(proceso == 4){
                        reporteFinal = data[4].actividades;
                    }
                    createDynamicModal(proceso);
                }
            }

        })
        .catch(error => {
            console.error("Error:", error);  // Muestra el error completo en la consola
        });

}

function saber_cuantos() {
    fetch('dist/personal/php/cuantos.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("cuantos").title = "El total de alumnos es de " + data[0].alumnos;
            document.getElementById("progress").style = "width: " + data[0].porcentaje + "%;";
            document.getElementById("progress").value = data[0].porcentaje + "%";
        })
        .catch(error => alert(error));
}
function createDynamicModal(proceso) {
    let modalHTML = "";
    switch (proceso) {
        case 0:
            modalHTML = `
    <div class="modal fade" id="exampleModalDynamic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-height: 90vh; width: 90%; margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                            <h2 class="text-center fw-bold">Solicitud de practicas</h2>
                </div>
                <div class="modal-body">
                   <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form id="personal" name="personal" class="ms-3 needs-validation "
                    disabled>
                    <div class="row mt-lg-4">
                        <div class="col-12 my-2 d d-block d-lg-none">
                            <h4 class="text-center">1.-Datos personales</h4>
                        </div>
                        <div class="col-sm-12 col-lg-3 mb-3 text-center">
                            <div>
                               <img id="imagenSeleccionda" for="imagen" src="${img}" class="rounded-pill mb-3 foto_retrato" alt="Imagen por defecto" width="50%">
                                          
                            </div>
                        </div>
                        <div class="col-6 my-2 d d-none d-lg-block">
                            <h4 id="title" class="text-center">1.-Datos personales</h4>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <label for="nombres" class="form-label">Nombre(s): </label>
                            <input type="text" class="form-control rounded-pill mb-3" id="nombres" name="nombres"
                                value="${nombres}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <label for="paterno" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control rounded-pill mb-3" id="paterno" name="paterno"
                                value="${paterno}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <label for="materno" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control rounded-pill mb-3" id="materno" name="materno"
                                value="${materno}" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control rounded-pill" id="direccion" name="direccion"
                                value="${direccion}" disabled />

                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <label for="numext" class="form-label">No. exterior:</label>
                            <input type="text" class="form-control rounded-pill" id="numext" border-top
                                name="numext" maxlength="5" pattern="[0-9]{5}" value="${noext}"
                                disabled />

                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <label for="numint" class="form-label">No. interior:</label>
                            <input type="text" class="form-control rounded-pill" id="numint" name="numint"
                                maxlength="5" pattern="[0-9]{5}" value="${noint}" disabled />

                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <label for="cp" class="form-label">C.P:</label>
                            <input type="text" class="form-control rounded-pill" id="cp" name="cp" maxlength="6"
                                pattern="[0-9]{6}" value="${cp}" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <label for="colonia" class="form-label">Colonia:</label>
                            <input type="text" class="form-control rounded-pill" id="colonia" name="colonia"
                                value="${colonia}" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <label for="edo" class="form-label">Estado:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="edo" name="edo"
                                value="${estado}" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <label for="mun" class="form-label">Municipio:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="mun" name="mun"
                                value="${municipio}" disabled />

                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <label for="telefono" class="form-label">Telefono:</label>
                            <input class="form-control rounded-pill mb-3" type="tel" id="telefono" maxlength="10"
                                name="telefono" pattern="[0-9]{10}" value="${telefono}" disabled />

                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="sexo" maxlength="2"
                                name="sexo" pattern="[0-9]{10}" value="${sexo}" disabled/>
                        </div>
                    </div>
                </form>
                <form id="formularioEsc" name="formularioEsc" class="hidden was-validated">
                    <div class="row mt-lg-4">
                        <div class="col-12 my-2">
                            <h4 id="title" class="text-center fw-bold">2.- Escolaridad</h4>
                        </div>
                        <div class="col-12 col-lg-8">
                            <label for="especialidad" class="form-label">Especialidad:</label>
                            <input class="form-control rounded-pill mb-3" id="especialidad" name="especialidad"
                                value="${especialidad}" disabled />
                        </div>
                        <div class="col-6 col-lg-4">
                            <label for="semestre" class="form-label">Semestre:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="semestre" name="semestre"
                                value="${semestre}" disabled />

                        </div>
                        <div class="col-6 col-lg-4">
                            <label for="grupo" class="form-label">Grupo:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="grupo" name="grupo"
                                value="${grupo}" disabled />

                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="generacion" class="form-label">Generacion:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="generacion"
                                name="generacion" value="${generacion}" disabled />

                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="noctrl" class="form-label">No. ctrl:</label>
                            <input type="text" class="form-control rounded-pill mb-3" id="noctrl" name="noctrl"
                                maxlength="18" pattern="[0-9]{18}" value="${noctrl}" disabled />
                        </div>
                    </div>
                    <div class="row mt-lg-4">
                        <div class="col-12 mb-3">
                            <h4 id="tit" class="text-center fw-bold">3.- Datos de la empresa
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="empresa" class="form-label">Empresa:</label>
                            <input class="form-control rounded-pill mb-3" id="empresa" name="empresa"
                                value="${empresa}" disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="jefe" class="form-label">Jefe inmediato:</label>
                            <input type="text" class="form-control rounded-pill mb-3" id="jefe" name="jefe" value="${jefe_inmediato}"
                                disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="direcEmpresa" class="form-label">Direccion:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="direcEmpresa"
                                name="direcEmpresa" value="${direccionEmp}" disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="correo" class="form-label">Correo:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="correo" name="correo" value="${correoEmp}"
                                disabled />

                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="telefonoEmp" class="form-label">Telefono:</label>
                            <input class="form-control rounded-pill mb-3" type="tel" id="telefonoEmp" maxlength="10"
                                name="telefonoEmp" value="${telefonoEmp}" disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="cpEmp" class="form-label">C.P:</label>
                            <input type="text" class="form-control rounded-pill" id="cpEmp" name="cpEmp" value="${cpEmp}" disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="coloniaEmp" class="form-label">Colonia:</label>
                            <input type="text" class="form-control rounded-pill" id="coloniaEmp" name="coloniaEmp"
                             value="${coloniaEmp}"   disabled />
                        </div>
                    </div>
                </form>
                <form id="formularioEmp" action="#" name="formularioEmp"
                    class="hidden was-validated">
                    <div class="row mt-lg-4">
                        <div class="col-12 my-3">
                            <h4 id="tit" class="text-center fw-bold">
                                4.- Datos de las Practicas.
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="incentivo" class="form-label">Incentivo de $:</label>
                            <input type="text" class="form-control rounded-pill" id="incentivo" name="incentivo" value="${incentivo}"
                            disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <input type="text" class="form-control rounded-pill" id="departamento" name="departamento" value="${departamento}"
                            disabled />
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="horarioInicio" class="form-label">Horario Inicio:</label>
                                    <input type="text" class="form-control rounded-pill" id="horarioInicio" name="horarioInicio" value="${hora_entrada}"
                            disabled />
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="horarioTermino" class="form-label">Horario Termino:</label>
                                    <input type="text" class="form-control rounded-pill" id="horarioTermino" name="horarioTermino" value="${hora_salida}"
                            disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="jefe_inmediato" class="form-label">Nombre del jefe inmediato:</label>
                            <input type="text" class="form-control rounded-pill" id="jefe_inmediato" name="jefe_inmediato" value="${jefe_inmediato}"
                            disabled />
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="giro" class="form-label">Giro:</label>
                            <input type="text" class="form-control rounded-pill" id="giro" name="giro" value="${giroEmp}"
                            disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                            <input type="text" class="form-control rounded-pill" id="inicio" name="inicio" value="${inicio}"
                            disabled />
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="termino" class="form-label colorFondoDos">Termino:</label>
                            <input class="form-control rounded-pill mb-3" type="text" id="termino" name="termino" value="${termino}"
                                disabled required />
                        </div>
                        <div class="col-12">
                            <label for="actividades" class="form-label">Actividades:</label>
                            <input name="actividades" id="actividades" rows="10" cols="40"
                                class="form-control max_height_size_area rounded" value="${actividades}" disabled></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
`;
            break;
        case 1:
            modalHTML = `<div class="modal fade" id="exampleModalDynamic" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-height: 90vh; width: 90%; margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-center fw-bold">Reporte mensual #1</h2>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="col-lg-12">
                            <div class="shadow-lg rounded ">
                                <div class="row max-height_size2">

                                    <div class="col-12 my-2 d d-block d-lg-none">
                                        <h2 class="text-center fw-bold">Reporte mensual #1</h2>
                                    </div>

                                    <div class="col-12 col-lg-12 ">
                                        <form id="personal" name="personal" class="ms-3 needs-validation" novalidate
                                            disabled>
                                            <div class="row mt-lg-4">
                                                <div class="col-sm-12 col-lg-3 mb-3 text-center">
                                                </div>
                                                <div class="col-6 my-2 d d-none d-lg-block">
                                                    <h4 id="title" class="text-center">1.-Datos personales</h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="fechaEnvio" class="form-label">Fecha envio: </label>
                                                    <input class="form-control rounded-pill px-0 px-0 text-center"
                                                        type="date" id="fechaEnvio" name="fechaEnvio" value="${fecha1}" disabled />
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="nombres" class="form-label">Nombre Completo: </label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="nombres" name="nombres" value="${nombres} ${paterno} ${materno}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="noctrl" class="form-label">No. ctrl:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}"
                                                        value="${noctrl}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="especialidad" class="form-label">Especialidad:</label>
                                                    <input class="form-control rounded-pill mb-3" id="especialidad"
                                                        name="especialidad" value="${especialidad}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="semestre" class="form-label">Semestre:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="semestre" name="semestre" value="${semestre}" disabled />

                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="grupo" class="form-label">Grupo:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text" id="grupo"
                                                        name="grupo" value="${grupo}" disabled />
                                                </div>
                                            </div>
                                        </form>
                                        <form id="formularioEsc" name="formularioEsc" class="needs-validation"
                                            novalidate>
                                            <div class="row mt-lg-4">
                                                <div class="col-12 mb-3">
                                                    <h4 id="tit" class="text-center fw-bold">2.- Datos de la empresa
                                                    </h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="empresa" class="form-label">Empresa:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="empresa" name="empresa" value="${empresa}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="direcEmpresa" class="form-label">Direccion:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="direcEmpresa" name="direcEmpresa" value="${direccionEmp}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-12">
                                                    <label for="area" class="form-label">Area donde realizara sus
                                                        practicas
                                                        profesionales:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3" id="area"
                                                        name="area" value="${departamento}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="inicio" name="inicio" value="${inicio}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="termino"
                                                        class="form-label colorFondoDos">Termino:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="termino" name="termino" value="${termino}" disabled />

                                                </div>
                                                <div class="col-12">
                                                    <label for="actividades" class="form-label">Actividades:</label>
                                                    <input name="actividades" id="actividades" rows="10" cols="40"
                                                        class="form-control max_height_size_area rounded" value="${actividad1}"
                                                        disabled></input>
                                                </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>`;
            break;
        case 2:
            modalHTML = `<div class="modal fade" id="exampleModalDynamic" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-height: 90vh; width: 90%; margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-center fw-bold">Reporte mensual #2</h2>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="col-lg-12">
                            <div class="shadow-lg rounded ">
                                <div class="row max-height_size2">

                                    <div class="col-12 my-2 d d-block d-lg-none">
                                        <h2 class="text-center fw-bold">Reporte mensual #2</h2>
                                    </div>

                                    <div class="col-12 col-lg-12 ">
                                        <form id="personal" name="personal" class="ms-3 needs-validation" novalidate
                                            disabled>
                                            <div class="row mt-lg-4">
                                                <div class="col-sm-12 col-lg-3 mb-3 text-center">
                                                </div>
                                                <div class="col-6 my-2 d d-none d-lg-block">
                                                    <h4 id="title" class="text-center">1.-Datos personales</h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="fechaEnvio" class="form-label">Fecha envio: </label>
                                                    <input class="form-control rounded-pill px-0 px-0 text-center"
                                                        type="date" id="fechaEnvio" name="fechaEnvio" value="${fecha1}" disabled />
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="nombres" class="form-label">Nombre Completo: </label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="nombres" name="nombres" value="${nombres} ${paterno} ${materno}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="noctrl" class="form-label">No. ctrl:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}"
                                                        value="${noctrl}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="especialidad" class="form-label">Especialidad:</label>
                                                    <input class="form-control rounded-pill mb-3" id="especialidad"
                                                        name="especialidad" value="${especialidad}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="semestre" class="form-label">Semestre:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="semestre" name="semestre" value="${semestre}" disabled />

                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="grupo" class="form-label">Grupo:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text" id="grupo"
                                                        name="grupo" value="${grupo}" disabled />
                                                </div>
                                            </div>
                                        </form>
                                        <form id="formularioEsc" name="formularioEsc" class="needs-validation"
                                            novalidate>
                                            <div class="row mt-lg-4">
                                                <div class="col-12 mb-3">
                                                    <h4 id="tit" class="text-center fw-bold">2.- Datos de la empresa
                                                    </h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="empresa" class="form-label">Empresa:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="empresa" name="empresa" value="${empresa}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="direcEmpresa" class="form-label">Direccion:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="direcEmpresa" name="direcEmpresa" value="${direccionEmp}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-12">
                                                    <label for="area" class="form-label">Area donde realizara sus
                                                        practicas
                                                        profesionales:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3" id="area"
                                                        name="area" value="${departamento}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="inicio" name="inicio" value="${inicio}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="termino"
                                                        class="form-label colorFondoDos">Termino:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="termino" name="termino" value="${termino}" disabled />

                                                </div>
                                                <div class="col-12">
                                                    <label for="actividades" class="form-label">Actividades:</label>
                                                    <input name="actividades" id="actividades" rows="10" cols="40"
                                                        class="form-control max_height_size_area rounded" value="${actividad2}"
                                                        disabled></input>
                                                </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>`;
            break;
        case 3:
            modalHTML = `<div class="modal fade" id="exampleModalDynamic" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-height: 90vh; width: 90%; margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-center fw-bold">Reporte mensual #3</h2>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="col-lg-12">
                            <div class="shadow-lg rounded ">
                                <div class="row max-height_size2">

                                    <div class="col-12 my-2 d d-block d-lg-none">
                                        <h2 class="text-center fw-bold">Reporte mensual #3</h2>
                                    </div>

                                    <div class="col-12 col-lg-12 ">
                                        <form id="personal" name="personal" class="ms-3 needs-validation" novalidate
                                            disabled>
                                            <div class="row mt-lg-4">
                                                <div class="col-sm-12 col-lg-3 mb-3 text-center">
                                                </div>
                                                <div class="col-6 my-2 d d-none d-lg-block">
                                                    <h4 id="title" class="text-center">1.-Datos personales</h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="fechaEnvio" class="form-label">Fecha envio: </label>
                                                    <input class="form-control rounded-pill px-0 px-0 text-center"
                                                        type="date" id="fechaEnvio" name="fechaEnvio" value="${fecha1}" disabled />
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <label for="nombres" class="form-label">Nombre Completo: </label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="nombres" name="nombres" value="${nombres} ${paterno} ${materno}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="noctrl" class="form-label">No. ctrl:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3"
                                                        id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}"
                                                        value="${noctrl}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="especialidad" class="form-label">Especialidad:</label>
                                                    <input class="form-control rounded-pill mb-3" id="especialidad"
                                                        name="especialidad" value="${especialidad}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="semestre" class="form-label">Semestre:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="semestre" name="semestre" value="${semestre}" disabled />

                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <label for="grupo" class="form-label">Grupo:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text" id="grupo"
                                                        name="grupo" value="${grupo}" disabled />
                                                </div>
                                            </div>
                                        </form>
                                        <form id="formularioEsc" name="formularioEsc" class="needs-validation"
                                            novalidate>
                                            <div class="row mt-lg-4">
                                                <div class="col-12 mb-3">
                                                    <h4 id="tit" class="text-center fw-bold">2.- Datos de la empresa
                                                    </h4>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="empresa" class="form-label">Empresa:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="empresa" name="empresa" value="${empresa}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="direcEmpresa" class="form-label">Direccion:</label>
                                                    <input class="form-control rounded-pill mb-3" type="text"
                                                        id="direcEmpresa" name="direcEmpresa" value="${direccionEmp}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-12">
                                                    <label for="area" class="form-label">Area donde realizara sus
                                                        practicas
                                                        profesionales:</label>
                                                    <input type="text" class="form-control rounded-pill mb-3" id="area"
                                                        name="area" value="${departamento}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="inicio" name="inicio" value="${inicio}" disabled />
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label for="termino"
                                                        class="form-label colorFondoDos">Termino:</label>
                                                    <input class="form-control rounded-pill mb-3" type="date"
                                                        id="termino" name="termino" value="${termino}" disabled />

                                                </div>
                                                <div class="col-12">
                                                    <label for="actividades" class="form-label">Actividades:</label>
                                                    <input name="actividades" id="actividades" rows="10" cols="40"
                                                        class="form-control max_height_size_area rounded" value="${actividad3}"
                                                        disabled></input>
                                                </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>`;
            break;
        case 4:
            modalHTML = `<div class="modal fade" id="exampleModalDynamic" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-height: 90vh; width: 90%; margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-center fw-bold">Reporte final</h2>
                </div>
                <div class="modal-body">
                    <div class="content">
                    <div class="col-lg-12">
              <div class="container shadow-lg rounded justify-content-center">
                <div class="row max-height_size2">

                  <div class="col-12 my-2 d d-block d-lg-none">
                    <h2 class="text-center fw-bold">Reporte final</h2>
                  </div>

                  <div class="col-12 col-lg-12 ">
                    <form id="personal" name="personal" class="ms-3 needs-validation" novalidate disabled>
                      <div class="row mt-lg-4">
                        <div class="col-sm-12 col-lg-3 mb-3 text-center">
                        </div>
                        <div class="col-6 my-2 d d-none d-lg-block">
                          <h4 id="title" class="text-center">1.-Datos personales</h4>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-auto">
                          <label for="fechaEnvio" class="form-label  my-auto">Fecha: </label>
                          <input class="form-control rounded-pill px-0 px-0 text-center" type="date" id="fechaEnvio" name="fechaEnvio" value="${fechaFinal}" disabled />
                        </div>
                        <div class="col-sm-12 col-lg-8">
                          <label for="nombres" class="form-label">Nombre Completo: </label>
                          <input type="text" class="form-control rounded-pill mb-3" id="nombres" name="nombres" value="${nombres} ${paterno} ${materno}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="noctrl" class="form-label">No. ctrl:</label>
                          <input type="text" class="form-control rounded-pill mb-3" id="noctrl" name="noctrl" maxlength="18" pattern="[0-9]{18}" value="${noctrl}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-4">
                          <label for="especialidad" class="form-label">Especialidad:</label>
                          <input class="form-control rounded-pill mb-3" id="especialidad" name="especialidad" value="${especialidad}" disabled />
                        </div>
                        <div class="col-sm-4 col-lg-4">
                          <label for="semestre" class="form-label">Semestre:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="semestre" name="semestre" value="${semestre}" disabled />

                        </div>
                        <div class="col-sm-4 col-lg-4">
                          <label for="grupo" class="form-label">Grupo:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="grupo" name="grupo" value="${grupo}" disabled />
                        </div>
                      </div>
                    </form>
                    <form id="formularioEsc" name="formularioEsc" class="needs-validation" novalidate>
                      <div class="row mt-lg-4">
                        <div class="col-12 mb-3">
                          <h4 id="tit" class="text-center fw-bold">2.- Datos de la empresa</h4>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          <label for="empresa" class="form-label">Empresa:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="empresa" name="empresa" value="${empresa}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="direcEmpresa" class="form-label">Direccion:</label>
                          <input class="form-control rounded-pill mb-3" type="text" id="direcEmpresa" name="direcEmpresa" value="${direccion}" disabled />
                        </div>
                        <div class="col-sm-6 col-lg-12">
                          <label for="area" class="form-label">Area donde realizara sus practicas profesionales:</label>
                          <input type="text" class="form-control rounded-pill mb-3" id="area" name="area" value="${departamento}" disabled/>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="inicio" class="form-label colorFondoDos">Inicio:</label>
                          <input class="form-control rounded-pill mb-3" type="date" id="inicio" name="inicio" value="${inicio}" disabled/>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                          <label for="termino" class="form-label colorFondoDos">Termino:</label>
                          <input class="form-control rounded-pill mb-3" type="date" id="termino" name="termino" value="${termino}" disabled/>

                        </div>
                        <div class="col-12">
                          <label for="actividades" class="form-label">Actividades:</label>
                          <input name="actividades" id="actividades" rows="10" cols="40" class="form-control max_height_size_area rounded" value=${reporteFinal}></inpur>
                        </div>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>`;
                break;
    }


    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const modalElement = document.getElementById('exampleModalDynamic');

    if (modalElement) {
        const bootstrapModal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });

        bootstrapModal.show();

        const closeButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
        if (closeButton) {
            closeButton.addEventListener('click', function () {
                modalElement.remove();
                location.reload();
            });
        }
    }


}