const enviar = document.getElementById("btn");
const video = document.getElementById("video");
const volver = document.getElementById("volver");
const volver2 = document.getElementById("volver2");
const volver3 = document.getElementById("volver3");
const formFoto = document.getElementById("personal");
const fechaInicio = document.getElementById("inicio");
const fechaFinal = document.getElementById("termino");
const formEmpresa = document.getElementById("formularioEsc");
const formDtUnicos = document.getElementById("formularioEmp");
let actividades_textArea = document.getElementById("actividades");
let enviado = 0;
let subir = false;
let today = new Date();
let btnSs = document.getElementById("btnSs");

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

