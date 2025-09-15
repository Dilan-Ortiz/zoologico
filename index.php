<?php
require('config.php');
$sql = "SELECT * FROM personas";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoologico</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person_add" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,-25&icon_names=person_add" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Zoológico</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    </nav>

      <div class="container mt-4">
    <div class="row">
    <div class="col-md-7 mb-3">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
            Lista de Personas
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Edad</th>
                    <th>Correo</th>
                </tr>
                </thead>
                <tbody id="tabla-personas">
                
                </tbody>
            </table>
            </div>
        </div>
        <div class="row mt-5">
      <div class="col-md-6 mx-auto">
        <div class="card shadow">
          <div class="card-header bg-warning fw-bold">
            Subir Archivo CSV
          </div>
          <div class="card-body text-center">
            <form action="reciexcel.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="file" name="dataCliente" id="file-input" class="form-control">
              </div>
              <input type="submit" name="subir" class="btn btn-warning w-100" value="Subir Excel" />
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>
          <div class="col-md-5 mb-3">
          <div class="card shadow">
            <div class="card-header bg-success text-white">
              <span class="material-symbols-outlined">
              person_add
              </span>Registrar Persona
            </div>
            <div class="card-body">
            <form id="formulario" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="number" class="form-control" id="documento" name="documento" placeholder="Ej: 1106227312">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Simba">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ej: 3132688859">
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" placeholder="Ej: 31">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ej: dilansantiortizm@gmail.com">
                </div>
                <button type="submit" class=" btn btn-success w-100">Guardar</button>
            </form>
            </div>
        </div>
        </div>
    </div>
      </div>



        <script>
            const formulario = document.getElementById('formulario');
            formulario.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(formulario);
                formData.append('documento', document.getElementById('documento').value);
                formData.append('nombre', document.getElementById('nombre').value);
                formData.append('telefono', document.getElementById('telefono').value);
                formData.append('edad', document.getElementById('edad').value);
                formData.append('correo', document.getElementById('correo').value);

                try {
                    const response = await fetch('registrar.php', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();

                    if (result.message) {
                        alert(result.message);
                        limpiarFormulario();
                    } else if (result.error) {
                        alert(result.error);
                    }
                } catch (error) {
                    alert('Error al conectar con el servidor.');
                }

                function limpiarFormulario() {
                    document.getElementById('documento').value = '';
                    document.getElementById('nombre').value = '';
                    document.getElementById('telefono').value = '';
                    document.getElementById('edad').value = '';
                    document.getElementById('correo').value = '';
                }
            });

            const tabla = document.querySelector('#tabla-personas');
          const opciones = {
            method :'POST'
          }

          fetch('listar.php',opciones)
            .then(respuesta => respuesta.json())
            .then(resultado =>{

                resultado.forEach(elemento => {
                  
                  tabla.innerHTML +=  `
                            <tr>
                              <th scope="row">${elemento.documento}</th>
                              <td>${elemento.nombre}</td>
                              <td>${elemento.telefono}</td>
                              <td>${elemento.edad}</td>
                              <td>${elemento.correo}</td>
                            </tr>
                  `
                });
            });
        </script>
</body>
</html>