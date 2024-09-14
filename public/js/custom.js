document.addEventListener('DOMContentLoaded', function() {
    // Inicializar el modal de agregar cliente
    var agregarClienteModal = new bootstrap.Modal(document.getElementById('agregarClienteModal'));

    // Manejar el botón para abrir el modal de agregar cliente
    document.getElementById('openAgregarClienteModal').addEventListener('click', function() {
        agregarClienteModal.show();
    });

    // Función para generar un código aleatorio
    function generateRandomCode() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';
        for (let i = 0; i < 8; i++) {
            code += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return code;
    }

    // Agregar el código al enviar el formulario
    document.querySelector('#agregarClienteForm').addEventListener('submit', function(event) {
        const codigoInput = document.getElementById('Codigo');
        if (!codigoInput.value) {
            const codigo = generateRandomCode();
            codigoInput.value = codigo;
            console.log("Código generado: " + codigo); // Verificar si el código se genera correctamente
        }
    });

    // Validaciones
    const empresaClienteInput = document.querySelector('input[name="Empresa_Cliente"]');
    const telefonoInput = document.querySelector('input[name="Telefono"]');
    const dpiInput = document.querySelector('input[name="DPI"]');
    const patenteInput = document.querySelector('input[name="Patente"]');
    const rtuInput = document.querySelector('input[name="RTU"]');
    const tipoClienteSelect = document.querySelector('select[name="Tipo_Cliente"]');
    const completarDireccionInput = document.querySelector('input[name="Completar_Direccion"]');

    // Validar campo Empresa/Cliente
    empresaClienteInput.addEventListener('input', function() {
        const value = empresaClienteInput.value;
        if (/[^a-zA-Z\s]/.test(value)) {
            alert('El campo Empresa/Cliente solo debe contener letras.');
            empresaClienteInput.value = value.replace(/[^a-zA-Z\s]/g, '');
        }
    });

    // Validar campo Teléfono
    telefonoInput.addEventListener('input', function() {
        const value = telefonoInput.value;
        if (/[^0-9-]/.test(value)) {
            alert('El campo Teléfono solo debe contener números y guiones.');
            telefonoInput.value = value.replace(/[^0-9-]/g, '');
        }
    });

    // Validar campo Completar Dirección
    completarDireccionInput.addEventListener('input', function() {
        const value = completarDireccionInput.value;
        if (!/^[\w\s]+$/.test(value)) {
            alert('Ingrese una dirección coherente.');
        }
    });

    // Habilitar/Deshabilitar campos según el tipo de cliente (DPI, Patente, RTU como texto)
    tipoClienteSelect.addEventListener('change', function() {
        const tipoCliente = tipoClienteSelect.value;

        if (tipoCliente === 'Individual') {
            // Clientes individuales, DPI habilitado
            dpiInput.disabled = false;
            patenteInput.disabled = true;
            rtuInput.disabled = true;
        } else if (tipoCliente === 'Empresa') {
            // Empresas, Patente y RTU habilitados
            dpiInput.disabled = true;
            patenteInput.disabled = false;
            rtuInput.disabled = false;
        }
    });

    // Inicializar el estado de los campos al cargar la página
    document.getElementById('Tipo_Cliente').dispatchEvent(new Event('change'));

    // Búsqueda dinámica
    function performSearch() {
        let query = document.getElementById('search').value;
        fetch(`/clientes/buscar?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let tbody = document.querySelector('#clientesTable tbody');
                tbody.innerHTML = '';

                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="14" class="text-center">Código o cliente no existe</td></tr>';
                } else {
                    data.forEach(item => {
                        let row = `
                            <tr>
                                <td>${item.Codigo}</td>
                                <td>${item.Empresa_Cliente}</td>
                                <td>${item.Correo_Electronico}</td>
                                <td>${item.Estado}</td>
                                <td>${item.Telefono}</td>
                                <td>${item.DPI ? item.DPI : ''}</td>
                                <td>${item.Patente ? item.Patente : ''}</td>
                                <td>${item.RTU ? item.RTU : ''}</td>
                                <td>${item.Tipo_Cliente}</td>
                                <td>${item.Departamento}</td>
                                <td>${item.Municipio}</td>
                                <td>${item.Completar_Direccion}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editarClienteModal" data-id="${item.id}"
                                        data-nombre="${item.Empresa_Cliente}">
                                        <span class="fa-solid fa-user-edit"></span>
                                    </button>
                                </td>
                                <td>
                                    <form action="javascript:void(0);" method="POST" onsubmit="handleDelete(${item.id});">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <span class="fa-solid fa-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                }
            });
    }

    // Búsqueda al presionar Enter en el campo de búsqueda
    document.getElementById('search').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            performSearch();
        }
    });

    // Búsqueda al hacer clic en el botón de búsqueda
    document.getElementById('searchButton').addEventListener('click', function() {
        performSearch();
    });

    // Recargar la página después de mostrar el mensaje de éxito
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            location.reload();
        }, 1000); // Ajusta el tiempo según sea necesario (3000 ms = 3 segundos)
    }
});



// Mostrar los datos del cliente en el modal de edición
document.addEventListener('DOMContentLoaded', function() {
    var editarModal = document.getElementById('editarClienteModal');
    
    editarModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        // Obtener el ID del cliente antes de asignar la acción del formulario
        var id = button.getAttribute('data-id');
        
        // Actualizar la acción del formulario con el ID del cliente
        var formAction = editarModal.querySelector('#editarClienteForm');
        formAction.action = '/clientes/' + id;  // Aquí se asegura que el ID esté definido

        // Obtener los demás datos del cliente del botón
        var codigo = button.getAttribute('data-codigo');
        var empresa = button.getAttribute('data-empresa');
        var correo = button.getAttribute('data-correo');
        var estado = button.getAttribute('data-estado');
        var telefono = button.getAttribute('data-telefono');
        var dpi = button.getAttribute('data-dpi');
        var patente = button.getAttribute('data-patente');
        var rtu = button.getAttribute('data-rtu');
        var tipo = button.getAttribute('data-tipo');
        var departamento = button.getAttribute('data-departamento');
        var municipio = button.getAttribute('data-municipio');
        var direccion = button.getAttribute('data-direccion');

        // Asignar los valores a los campos del modal
        editarModal.querySelector('#editClienteId').value = id;
        editarModal.querySelector('#Codigo').value = codigo;
        editarModal.querySelector('#Empresa_Cliente').value = empresa;
        editarModal.querySelector('#Correo_Electronico').value = correo;
        editarModal.querySelector('#Estado').value = estado;
        editarModal.querySelector('#Telefono').value = telefono;
        editarModal.querySelector('#DPI').value = dpi;
        editarModal.querySelector('#Patente').value = patente;
        editarModal.querySelector('#RTU').value = rtu;
        editarModal.querySelector('#Tipo_Cliente').value = tipo;
        editarModal.querySelector('#Departamento').value = departamento;
        editarModal.querySelector('#Municipio').value = municipio;
        editarModal.querySelector('#Completar_Direccion').value = direccion;

        // Habilitar/deshabilitar campos según el tipo de cliente
        editarModal.querySelector('#Tipo_Cliente').dispatchEvent(new Event('change'));
    });
});







// Función para manejar la eliminación
function handleDelete(itemId) {
    // Redirige a la vista de eliminación usando la ruta show
    window.location.href = `/clientes/${itemId}/show`;
}

