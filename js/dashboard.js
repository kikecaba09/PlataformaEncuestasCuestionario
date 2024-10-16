$(document).ready(function() {
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
            if (encuestas.error) {
                alert('Error al obtener encuestas');
            } else {
                const encuestasList = $('#encuestasRecientes');
                encuestasList.empty(); // Limpiar la lista antes de agregar encuestas
                encuestas.forEach(function(encuesta) {
                    const estado = encuesta.activa ? 'Activa' : 'Cerrada';
                    const badgeClass = encuesta.activa ? 'badge-primary' : 'badge-secondary';
                    const li = `<li class="list-group-item">${encuesta.titulo} <span class="badge ${badgeClass} float-right">${estado}</span></li>`;
                    encuestasList.append(li);
                });
            }
        }
    });
});
