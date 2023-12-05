// inventario.js
function registrarProducto() {
    const codigoProducto = document.getElementById('codigoProducto3').value;
    const nombreProducto = document.getElementById('nombreProducto3').value;
    const costo = parseFloat(document.getElementById('costo').value) || 0;
    const precioVenta = parseFloat(document.getElementById('precioVenta').value) || 0;
    const existenciaInicial = parseInt(document.getElementById('existenciaInicial').value) || 0;

 
    const formData = new FormData();
    formData.append('codigoProducto3', codigoProducto);
    formData.append('nombreProducto3', nombreProducto);
    formData.append('costo', costo);
    formData.append('precioVenta', precioVenta);
    formData.append('existenciaInicial', existenciaInicial);
 

    fetch('../php/Stock/registar_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        // Puedes redirigir a otra página o realizar otras acciones después de registrar el producto
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Limpiar el formulario después de registrar el producto
    document.getElementById('codigoProducto3').value = '';
    document.getElementById('nombreProducto3').value = '';
    document.getElementById('costo').value = '';
    document.getElementById('precioVenta').value = '';
    document.getElementById('existenciaInicial').value = '';
   
}
