$(document).ready(function() {
    // Mostrar spinner mientras se cargan los datos
    $('#encuestasRecientes').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando encuestas...</div>');

    // Cargar nombre del usuario
    $.ajax({
        url: '../php/login/usuario.php',
        method: 'GET',
        success: function(response) {
            const usuario = JSON.parse(response);
            if (usuario.error) {
                alert('Error al obtener el usuario');
            } else {
                $('#nombreUsuario').text(usuario.nombreUsuario);
            }
        }
    });

    // Cargar encuestas recientes
    $.ajax({
        url: '../php/encuesta/dashoboard.php',
        method: 'GET',
        success: function(response) {
            const encuestas = JSON.parse(response);
            const encuestasList = $('#encuestasRecientes');

            encuestasList.empty(); // Limpiar la lista antes de agregar encuestas

            if (encuestas.error) {
                encuestasList.html('<div class="text-center">No hay encuestas disponibles</div>');
            } else {
                encuestas.forEach(function(encuesta) {
                    const estado = encuesta.activa ? 'Activa' : 'Cerrada';
                    const badgeClass = encuesta.activa ? 'badge-primary' : 'badge-secondary';
                    const li = `<li class="list-group-item">${encuesta.titulo} <span class="badge ${badgeClass}">${estado}</span></li>`;
                    encuestasList.append(li);
                });
            }
        },
        error: function() {
            $('#encuestasRecientes').html('<div class="text-center">Error al cargar encuestas.</div>');
        }
    });
});
