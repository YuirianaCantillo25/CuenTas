

document.addEventListener('DOMContentLoaded', cargarListadoProductos);

function cargarListadoProductos() {
    const urlPhp = '../php/Stock/lista_Inventario.php';
    fetch(urlPhp)
        .then(response => response.json())
        .then(data => {
            mostrarListadoProductos(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function mostrarListadoProductos(productos) {
    const listadoProductosDiv = document.getElementById('listadoProductos');
    listadoProductosDiv.innerHTML = '';

    productos.forEach(producto => {
        const productoDiv = document.createElement('div');
        productoDiv.classList.add('producto');
        productoDiv.classList.add('c5');
        productoDiv.classList.add('action'); 
        productoDiv.classList.add('d-flex');
        productoDiv.classList.add('aling-item-left');
        productoDiv.classList.add('justify-content-between');
        


         // Mostrar codigo
         const codigo = document.createElement('p');
         codigo.classList.add('h4');
         codigo.classList.add('c5');
         codigo.classList.add('action');
         codigo.classList.add('w-15');
         codigo.classList.add('justify-content-center');
         codigo.textContent = '' + producto.codigo_producto;
         productoDiv.appendChild(codigo);

        // Mostrar nombre
        const nombre = document.createElement('p');
        nombre.classList.add('h4');
        nombre.classList.add('c5');
        nombre.classList.add('action');
        nombre.classList.add('w-15');
        nombre.textContent = '' + producto.nombre_producto;
        nombre.classList.add('aling-item-center');
        nombre.classList.add('justify-content-between');
        productoDiv.appendChild(nombre);

        // Mostrar costo
        const costo = document.createElement('p');
        costo.classList.add('h4');
        costo.classList.add('c5');
        costo.classList.add('action');
        costo.classList.add('w-15');
        costo.classList.add('aling-item-center');
        costo.classList.add('justify-content-between');
        costo.textContent = '' + producto.costo;
        productoDiv.appendChild(costo);

        // Mostrar precio de venta
        const precioVenta = document.createElement('p');
        precioVenta.classList.add('h4');
        precioVenta.classList.add('fw-bold');
        precioVenta.classList.add('c5');
        precioVenta.classList.add('action');
        precioVenta.classList.add('w-15');
        precioVenta.classList.add('aling-item-center');
        precioVenta.classList.add('justify-content-between');
        precioVenta.textContent = '' + producto.precio_venta;
        productoDiv.appendChild(precioVenta);

        // Mostrar stock
        const stock = document.createElement('p');
        stock.classList.add('h4');
        stock.classList.add('fw-bold');
        stock.classList.add('c1');
        stock.classList.add('action');
        stock.classList.add('w-15');
        stock.classList.add('aling-item-centert');
        stock.classList.add('justify-content-between');
        stock.textContent = '' + producto.stock;
        productoDiv.appendChild(stock);

        listadoProductosDiv.appendChild(productoDiv);

    });
}
