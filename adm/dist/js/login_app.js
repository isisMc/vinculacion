let form_admin = document.getElementById("form_admin");
const toggle = document.querySelector('.toggle');
const body = document.body;

toggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
});

function showErrorModal() {
    let modal = new bootstrap.Modal(document.getElementById('errorModal'));
    modal.show();
}

form_admin.addEventListener("submit", (e) => {
    if (!form_admin.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        form_admin.classList.add("was-validated");
        return;
    }
    e.preventDefault();

    let datos = new FormData(form_admin);

    fetch('../../dist/personal/php/login_admin_db.php', {
        method: "POST",
        body: datos,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data[0].clave === "ok") {
            sessionStorage.setItem("nombre",data[0].nombre);   
            sessionStorage.setItem("img",data[0].img);                

            location.href = "../../index.html";
        } else {
            showErrorModal();
        }
    })
    .catch(error => {
        alert("Error: " + error);
    });
});