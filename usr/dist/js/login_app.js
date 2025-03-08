let form = document.getElementById("form");
let curpInput = document.getElementById("curp");
let noctrlInput = document.getElementById("noctrl");

const toggle = document.querySelector('.toggle');
const body = document.body;

toggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
});

function showErrorModal() {
    let modal = new bootstrap.Modal(document.getElementById('errorModal'));
    modal.show();
}

form.addEventListener("submit", (e) => {
    if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        form.classList.add("was-validated");
        return;
    }

    e.preventDefault();

    let datos = new FormData(form);

    fetch('../../dist/personal/php/login_db.php', {
        method: "POST",
        body: datos,
    })
    .then((response) => response.json())
    .then((data) => {
            if (data[0].clave === "ok") {

                sessionStorage.setItem("entrada", "ENTRO EL ALUMNO");
                
                location.href = "../../index.php";
            } else {
                showErrorModal();
            }
        })
        .catch(error => {
            alert("Error: " + error);
        });
});

curpInput.addEventListener('input', function (e) {
    e.target.value = e.target.value.toUpperCase();
});
