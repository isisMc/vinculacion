document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('fileInput').click(); 
});
document.getElementById('modalUpload').addEventListener('click', function() {
    let modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
});

let selectedFile = null;

document.getElementById('fileInput').addEventListener('change', function(event) {
    selectedFile = event.target.files[0];
    document.getElementById('fileName').textContent = selectedFile ? "Archivo seleccionado: " + selectedFile.name : "";
});

document.getElementById('submitButton').addEventListener('click', function() {
    const generationInput = document.getElementById('generationInput').value.trim();
    const semesterSelect = document.getElementById('semesterSelect').value;
    
    if (!generationInput) {
        alert("Por favor, ingrese la generación.");
        return;
    }

    if (!selectedFile) {
        alert("Por favor, seleccione un archivo CSV.");
        return;
    }

    const formData = new FormData();
    formData.append('csv_file', selectedFile);
    formData.append('generacion', generationInput);
    formData.append('semestre', semesterSelect);

    fetch('dist/personal/php/subir.php', {
        method: 'POST',
        body: formData 
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar el archivo.');
    });
});