document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('fileInput').click(); 
});

let selectedFile = null;

document.getElementById('fileInput').addEventListener('change', function(event) {
    selectedFile = event.target.files[0];
    document.getElementById('fileName').textContent = selectedFile ? "Archivo seleccionado: " + selectedFile.name : "";
    const formData = new FormData();
    formData.append('csv_file', selectedFile);

    fetch('dist/personal/php/subirEmp.php', {
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

