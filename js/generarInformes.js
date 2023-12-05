console.log("¡El archivo JavaScript se ha cargado correctamente!");
  function buscarInformes() {
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;

    fetch(`../php/Informe/consultaInforme.php?fechaDesde=${fechaDesde}&fechaHasta=${fechaHasta}`)
      .then(response => response.json())
      .then(data => {
        if (data.fechas.length > 0) {
          generarGrafico(data.ingresos, data.gastos, data.fechas);
          document.getElementById('btnBuscarOtraFecha').style.display = 'block';
          document.getElementById('mensajeError').style.display = 'none';
        } else {
          document.getElementById('btnBuscarOtraFecha').style.display = 'none';
          document.getElementById('mensajeError').style.display = 'block';
        }
      })
      .catch(error => console.error('Error:', error));
  }

  function generarGrafico(ingresos, gastos, fechas) {
    const ctx = document.getElementById('grafico').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: fechas,
        datasets: [{
          label: 'Ingresos',
          backgroundColor: 'rgba(0, 128, 128, 0.6)',  // Tonalidad más fuerte de cyan
        borderColor: 'rgba(0, 128, 128, 1)', 
          borderWidth: 1,
          data: ingresos
        }, {
          label: 'Gastos',
          backgroundColor: 'rgba(178, 34, 34, 0.6)',  // Tonalidad más fuerte de rojo
        borderColor: 'rgba(178, 34, 34, 1)',
          borderWidth: 1,
          data: gastos
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  function recargarPagina() {
    location.reload();
  }