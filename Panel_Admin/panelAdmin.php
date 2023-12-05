<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="shortcut icon" href="../img/CuenTas.jpeg" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .buttons {
            margin-bottom: 20px;
        }

        button {
            padding: 10px;
            margin-right: 10px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        #formularioAgregar, #formularioEliminar {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            display: none;
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input, select {
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007BFF;
            color: white;
        }

        .btn-danger {
            background-color: #DC3545;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Tabla de Usuarios -->

        <h1>Panel de Administrador</h1>

        <!-- Lista de Usuarios -->
        <h2>Lista de Usuarios</h2>
        
        <div id="tablaUsuarios">
            <?php
            $conexion = mysqli_connect("localhost", "root", "", "usuariosCuentas");

            if ($conexion) {
                $query = "SELECT * FROM usuarios";
                $result = mysqli_query($conexion, $query);

                if ($result) {
                    echo "<table border='1'>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['rol']}</td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Error en la consulta: " . mysqli_error($conexion);
                }

                mysqli_close($conexion);
            } else {
                echo "Error al conectar a la base de datos.";
            }
            ?>
        </div>

        <!-- Botones de Agregar y Eliminar -->
        <div class="buttons">
            <button class="btn-primary" onclick="mostrarFormulario('agregar')">Agregar Usuario</button>
            <button class="btn-danger" onclick="mostrarFormulario('eliminar')">Eliminar Usuario</button>
        </div>

        <!-- Formulario de Agregar Usuario -->
        <div id="formularioAgregar">
            <h2>Formulario de Registro</h2>
            <form onsubmit="return agregarUsuario()">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="administrador">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                </select>
                <button class="btn-primary" type="submit">Guardar</button>
            </form>
        </div>

        <!-- Formulario de Eliminar Usuario -->
        <div id="formularioEliminar">
            <h2>Eliminar Usuario</h2>
            <form id="formEliminarUsuario" onsubmit="return eliminarUsuario()">
                <label for="emailEliminar">Correo del Usuario:</label>
                <input type="email" id="emailEliminar" placeholder="Correo del Usuario" required>
                <button class="btn-danger" type="submit">Eliminar</button>
            </form>
        </div>

        <!-- Mensaje de Confirmación -->
        <div id="mensaje" style="color: green; margin-top: 10px;"></div>

         <!-- Botón de Regresar -->
         <button class="btn-primary" onclick="window.location.href='../html/CuenTasAdmin.html'">Regresar</button>
    </div>

    <script>
        function mostrarFormulario(tipo) {
            // Restablecer el mensaje antes de mostrar el formulario
            document.getElementById('mensaje').innerHTML = '';

            document.getElementById('formularioAgregar').style.display = tipo === 'agregar' ? 'block' : 'none';
            document.getElementById('formularioEliminar').style.display = tipo === 'eliminar' ? 'block' : 'none';
        }

        function agregarUsuario() {
            // Lógica para agregar el usuario usando AJAX o PHP
            var nombre = document.getElementById('nombre').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('contraseña').value;
            var rol = document.getElementById('rol').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    if (xhr.responseText.includes("exitosamente")) {
                        document.getElementById('nombre').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('contraseña').value = '';
                        document.getElementById('rol').value = 'administrador';
                    }
                    // Refrescar la página después de mostrar el mensaje
                    location.reload();
                }
            };

            xhr.open("POST", "agregarUsuario.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("nombre=" + nombre + "&email=" + email + "&contraseña=" + password + "&rol=" + rol);

            // Evitar que el formulario se envíe y la página se recargue
            return false;
        }

        function eliminarUsuario() {
            // Lógica para eliminar el usuario usando AJAX o PHP
            var emailEliminar = document.getElementById('emailEliminar').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    // Refrescar la página después de mostrar el mensaje
                    location.reload();
                }
            };

            xhr.open("POST", "eliminarUsuario.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("emailEliminar=" + emailEliminar);

            // Evitar que el formulario se envíe y la página se recargue
            return false;
        }
    </script>

</body>

</html>
