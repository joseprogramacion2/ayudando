<!-- Modal para editar cliente -->
<div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="editarClienteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editarClienteModalLabel">Editar Cliente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarClienteForm" action="{{ route('clientes.update', ['id' => 0]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editClienteId" name="id">

                    <div class="row">
                        <!-- Columna 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" id="Codigo" name="Codigo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="Empresa_Cliente" class="form-label">Empresa/Cliente</label>
                                <input type="text" class="form-control" id="Empresa_Cliente" name="Empresa_Cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="Correo_Electronico" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="Correo_Electronico" name="Correo_Electronico" required>
                            </div>
                            <div class="mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-select" id="Estado" name="Estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="Telefono" name="Telefono" required>
                            </div>
                        </div>
                        <!-- Columna 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Tipo_Cliente" class="form-label">Tipo de Cliente</label>
                                <select class="form-select" id="Tipo_Cliente" name="Tipo_Cliente" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="Individual">Individual</option>
                                    <option value="Empresa">Empresa</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Departamento" class="form-label">Departamento</label>
                                <select class="form-select" id="Departamento" name="Departamento" required>
                                    <option value="">Seleccione un departamento</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Sacatepéquez">Sacatepéquez</option>
                                    <option value="Chimaltenango">Chimaltenango</option>
                                    <option value="Escuintla">Escuintla</option>
                                    <option value="Zacapa">Zacapa</option>
                                    <option value="Izabal">Izabal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Municipio" class="form-label">Municipio</label>
                                <select class="form-select" id="Municipio" name="Municipio" required>
                                    <option value="">Seleccione un municipio</option>
                                    <optgroup label="Guatemala">
                                        <option value="Ciudad de Guatemala">Ciudad de Guatemala</option>
                                        <option value="Mixco">Mixco</option>
                                        <option value="Villa Nueva">Villa Nueva</option>
                                        <option value="Santa Catarina Pinula">Santa Catarina Pinula</option>
                                        <!-- Agregar más municipios según sea necesario -->
                                    </optgroup>
                                    <optgroup label="Sacatepéquez">
                                        <option value="Antigua Guatemala">Antigua Guatemala</option>
                                        <option value="San Lucas Sacatepéquez">San Lucas Sacatepéquez</option>
                                        <option value="San Miguel Dueñas">San Miguel Dueñas</option>
                                        <!-- Agregar más municipios según sea necesario -->
                                    </optgroup>
                                    <optgroup label="Chimaltenango">
                                        <option value="Chimaltenango">Chimaltenango</option>
                                        <option value="San José Poaquil">San José Poaquil</option>
                                        <option value="San Martín Jilotepeque">San Martín Jilotepeque</option>
                                        <!-- Agregar más municipios según sea necesario -->
                                    </optgroup>
                                    <optgroup label="Escuintla">
                                        <option value="Escuintla">Escuintla</option>
                                        <option value="Santa Lucía Cotzumalguapa">Santa Lucía Cotzumalguapa</option>
                                        <option value="La Democracia">La Democracia</option>
                                        <!-- Agregar más municipios según sea necesario -->
                                    </optgroup>
                                    <optgroup label="Zacapa">
                                        <option value="Zacapa">Zacapa</option>
                                        <option value="Chiquimula">Chiquimula</option>
                                        <option value="La Unión">La Unión</option>
                                        <option value="San Jorge">San Jorge</option>
                                    </optgroup>
                                    <optgroup label="Izabal">
                                        <option value="Puerto Barrios">Puerto Barrios</option>
                                        <option value="Livingston">Livingston</option>
                                        <option value="El Estor">El Estor</option>
                                        <option value="María Dolores">María Dolores</option>
                                        <option value="Los Amates">Los Amates</option>
                                        <!-- Agregar más municipios según sea necesario -->
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="DPI" class="form-label">DPI</label>
                                <input type="text" class="form-control" id="DPI" name="DPI">
                            </div>
                            <div class="mb-3">
                                <label for="Patente" class="form-label">Patente</label>
                                <input type="text" class="form-control" id="Patente" name="Patente">
                            </div>
                            <div class="mb-3">
                                <label for="RTU" class="form-label">RTU</label>
                                <input type="text" class="form-control" id="RTU" name="RTU">
                            </div>
                            <div class="mb-3">
                                <label for="Completar_Direccion" class="form-label">Completar Dirección</label>
                                <input type="text" class="form-control" id="Completar_Direccion"
                                    name="Completar_Direccion" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
