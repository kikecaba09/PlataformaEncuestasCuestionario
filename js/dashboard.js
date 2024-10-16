document.addEventListener("DOMContentLoaded", function() {
    const encuestasRecientes = document.getElementById('encuestasRecientes');
    encuestasRecientes.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando encuestas...</div>';

    // Cargar nombre del usuario
    fetch('../php/login/usuario.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener el usuario');
            }
            return response.json();
        })
        .then(usuario => {
            if (usuario.error) {
                alert('Error al obtener el usuario: ' + usuario.error);
            } else {
                document.getElementById('nombreUsuario').textContent = usuario.nombreUsuario;
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });

    // Cargar encuestas recientes
    fetch('../php/encuesta/dashoboard.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar encuestas');
            }
            return response.json();
        })
        .then(encuestas => {
            encuestasRecientes.innerHTML = ''; // Limpiar la lista antes de agregar encuestas

            if (encuestas.error) {
                encuestasRecientes.innerHTML = '<div class="text-center">No hay encuestas disponibles</div>';
            } else {
                encuestas.forEach(encuesta => {
                    const estado = encuesta.activa ? 'Activa' : 'Cerrada';
                    const badgeClass = encuesta.activa ? 'badge-primary' : 'badge-secondary';
                    const li = `<li class="list-group-item">${encuesta.titulo} <span class="badge ${badgeClass}">${estado}</span></li>`;
                    encuestasRecientes.innerHTML += li;
                });
            }
        })
        .catch(error => {
            encuestasRecientes.innerHTML = '<div class="text-center">Error al cargar encuestas: ' + error.message + '</div>';
        });
});
