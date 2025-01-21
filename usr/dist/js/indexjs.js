document.getElementById("salir").addEventListener("click", ()=>{
    fetch('dist/personal/php/close.php',
        {
            method: 'POST'
        });
        location.reload();
});