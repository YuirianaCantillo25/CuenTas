// compraProducto.js


function buscarProductoCompra() {
    const buscarCodigo = document.getElementById('buscarCodigo').value;

    fetch(`../php/Stock/buscarCodigo-Compra.php?codigo=${buscarCodigo}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById('nombreProducto2').value = data.nombreProducto;
            document.getElementById('costo2').value = data.costo;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function registrarCompra() {
    const buscarCodigo = document.getElementById('buscarCodigo').value;
    const unidadesCompradas = parseInt(document.getElementById('unidadesCompradas').value) || 0;

    const formData = new FormData();
    formData.append('buscarCodigo', buscarCodigo);
    formData.append('unidadesCompradas', unidadesCompradas);

    fetch('../php/Stock/compras.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        resetForm();  // Limpia los campos después de registrar la compra
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function resetForm() {
    document.getElementById('buscarCodigo').value = '';
    document.getElementById('nombreProducto2').value = '';
    document.getElementById('costo2').value = '';
    document.getElementById('unidadesCompradas').value = '';
}
