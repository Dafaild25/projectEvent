
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center">
                <?php echo isset($room) ? 'Edit Room' : 'Register Room'; ?>
            </h3>
            <form action="<?php echo isset($room) ? site_url('Rooms/update') : site_url('Rooms/save'); ?>" 
                id="frm_register_room" method="post">
                <!-- Campo oculto para ID -->
                <input type="hidden" name="id" id="id" value="<?php echo isset($room) ? $room->id : ''; ?>">

                <label for=""><b>Name:</b></label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Enter the Name" 
                    value="<?php echo isset($room) ? $room->name : ''; ?>" >
                <br>

                <label for=""><b>Description:</b></label>
                <input type="text" name="description" id="description" class="form-control" 
                    placeholder="Enter your Description" 
                    value="<?php echo isset($room) ? $room->description : ''; ?>" >
                <br>

                

                <!-- Botones -->
                <button class="btn btn-success" type="submit">
                    Save
                </button>
                <button class="btn btn-danger" type="button" onclick="resetForm()">Cancel</button>


   
            </form>
        </div>

        <div class="col-md-8">
            <h3 class="text-center">LIST OF ROOMS</h3>
            <hr>
            

            <?php if ($rooms): ?>
                <table class="table table-bordered table-striped table-hover" id="tbl-rooms">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">DESCRIPTION</th>
                            <th class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $roomTemporal): ?>
                            <tr>
                                <td class="text-center"><?php echo $roomTemporal->id; ?></td>
                                <td class="text-center"><?php echo $roomTemporal->name; ?></td>
                                <td class="text-center"><?php echo $roomTemporal->description; ?></td>
                                <td class="text-center">
                                    <!-- Contenedor de columnas para los botones -->
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="<?php echo site_url('Collections/CollectionPage/' . $roomTemporal->id); ?>" class="btn btn-info">
                                                <i class="fas fa-boxes"></i> Collection
                                            </a>
                                        </div>
                                       
                                        <div class="col-4">
                                            <!-- Botón de editar con icono -->
                                            <a href="<?php echo site_url('Rooms/edit/' . $roomTemporal->id); ?>" 
                                            class="btn btn-warning">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <!-- Botón de eliminar con icono -->
                                            <button class="btn btn-danger btn-delete" 
                                                data-url="<?php echo site_url('Rooms/delete/' . $roomTemporal->id)  . '?action=delete'; ?>">
                                                <i class="fas fa-trash-alt"></i> 
                                            </button>
                                            
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h3 style="color:red;">THERE ARE NO REGISTERED ROOMS</h3>
            <?php endif; ?>
        </div>
       

    </div>
</div>




<br><br>
<script>
    

    function resetForm() {
        // Obtén el formulario
        const form = document.getElementById('frm_register_room');
        
        // Restablece el formulario
        form.reset();

        // Asegúrate de limpiar manualmente los valores en campos dinámicos
        document.getElementById('id').value = '';
        form.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        // Establecer la acción del formulario para "save" en lugar de "update"
        form.action = "<?php echo site_url('Rooms/save'); ?>";
    }

    $(document).ready(function() {
        $('#tbl-rooms').DataTable({
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": false
        });

        // Confirmación de eliminación con SweetAlert2
        $('.btn-delete').on('click', function(event) {
            event.preventDefault(); // Prevent default action

            const deleteUrl = $(this).data('url'); // Get the URL from the data-url attribute

            // Display confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to delete the record
                    $.ajax({
                        url: deleteUrl,
                        method: 'POST', // Or 'GET' depending on your setup
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // Show success notification using Toastify
                                Toastify({
                                    text: response.message,
                                    duration: 2000,
                                    backgroundColor: "green",
                                    close: true
                                }).showToast();

                                // Redirect or reload the page after showing the message
                                setTimeout(() => {
                                    location.reload(); // Reload the page
                                }, 2000);
                            } else if (response.status === 'error') {
                                // Show error notification using Toastify
                                Toastify({
                                    text: response.message,
                                    duration: 3000,
                                    backgroundColor: "red",
                                    close: true
                                }).showToast();
                            }
                        },
                        error: function() {
                            // Handle generic errors
                            Toastify({
                                text: "An error occurred while trying to delete the room.",
                                duration: 3000,
                                backgroundColor: "red",
                                close: true
                            }).showToast();
                        }
                    });
                }
            });
        });



        // Manejo del formulario de registro/actualización
        $('#frm_register_room').on('submit', function (event) {
            event.preventDefault(); // Evitar el envío inmediato del formulario

            let isValid = true; // Bandera de validación
            let message = ''; // Mensaje de error

            // Especificar campos obligatorios por ID
            const requiredFields = ['#name', '#description']; // IDs de los campos obligatorios

            // Verificar si los campos requeridos están vacíos
            requiredFields.forEach(selector => {
                const input = $(selector);
                if (input.val().trim() === '') {
                    isValid = false;
                    message = `The field ${input.attr('name')} is required!`; // Mensaje dinámico
                    input.focus(); // Colocar el foco en el campo vacío
                    return false; // Salir del bucle si se encuentra un campo vacío
                }
            });

            // Si alguna validación falla, evitar el envío del formulario
            if (!isValid) {
                // Mostrar mensaje de error con Toastify
                Toastify({
                    text: message,
                    duration: 3000,
                    backgroundColor: "red",
                    close: true
                }).showToast();
                return; // Detener el flujo
            }

            const form = this; // Referencia al formulario actual
            const action = form.action.includes('update') ? 'update' : 'save'; // Identificar la acción (guardar o actualizar)

            // Confirmación con SweetAlert
            Swal.fire({
                title: action === 'save' ? 'Are you sure you want to save this record?' : 'Are you sure you want to update this record?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar Toastify de éxito
                    Toastify({
                        text: action === 'save' ? "Room saved successfully!" : "Room updated successfully!",
                        duration: 2000, // Mostrar mensaje durante 2 segundos
                        backgroundColor: "green",
                        close: true
                    }).showToast();

                    // Retrasar el envío del formulario para mostrar el mensaje
                    setTimeout(function () {
                        form.submit(); // Enviar el formulario después del mensaje
                    }, 2000); // Esperar 2 segundos
                }
            });
        });


           

    });
</script>
