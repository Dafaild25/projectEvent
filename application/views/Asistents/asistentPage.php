<div class="container my-3">
	<div class="card shadow-lg">
		<div class="card-header bg-primary text-white">
			<h4 class="mb-0">
				<?php echo isset($party) ? 'EDIT ASISTANT' : 'ADD ASSISTANT'; ?>
			</h4>
		</div>
		<div class="card-body">
			<form id="asistentForm" method="post"
				action="<?php echo isset($asistent) ? site_url('Asistents/update') : site_url('Asistents/save'); ?>">
				<div class="row g-3">
					<input type="hidden" name="id" id="id" value="<?php echo isset($asistent) ? $asistent->id : ''; ?>">
					<!-- Primera fila -->
					<div class="col-md-3">
						<input type="text" id="first_name" name="first_name" class="form-control"
							placeholder="First Names"
							value="<?php echo isset($asistent) ? $asistent->first_name : ''; ?>" required>
					</div>
					<div class="col-md-3">
						<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Names"
							value="<?php echo isset($asistent) ? $asistent->last_name : ''; ?>" required>
					</div>
					<div class="col-md-3">
						<input type="email" id="email" name="email" class="form-control"
							value="<?php echo isset($asistent) ? $asistent->email : ''; ?>" placeholder="Email">
					</div>

					<div class="col-md-3">
						<input type="phone" id="phone" name="phone" class="form-control"
							value="<?php echo isset($asistent) ? $asistent->phone : ''; ?>" placeholder="Phone">
					</div>
				</div>

				<div class="row g-3 mt-3">

					<div class="col-md-12">
						<div class="text-end mt-3">
							<button type="submit" class="btn btn-success">Add Asistent</button>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
</div>

<!-- Tabla para listar los ASISTENT -->
<div class="container">
	<div class="table-resposive">
		<table class="table table-bordered table-hover" id="asistentTable">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Firs Names</th>
					<th>Last names</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody >
				<?php if (!empty($asistents)) { ?>
					<?php foreach ($asistents as $asistent) { ?>
						<tr>
							<td><?php echo htmlspecialchars($asistent->id); ?></td>
							<td><?php echo htmlspecialchars($asistent->first_name); ?></td>
							<td><?php echo htmlspecialchars($asistent->last_name); ?></td>
							<td><?php echo htmlspecialchars($asistent->email); ?></td>
							<td><?php echo htmlspecialchars($asistent->phone); ?></td>
							<td>
								<a href="<?php echo site_url('Asistents/selectAsistent/' . $asistent->id); ?>"
									class="btn btn-primary"> <i class="fas fa-pen"></i></a>
								<a href="<?php echo site_url('Asistents/delete/' . $asistent->id); ?>" class="btn btn-danger">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr>
						<td colspan="6" class="text-center">No parties found.</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<script>
	// Función para validar el formulario
	function validateForm(event) {
		event.preventDefault(); // Prevenir el envío del formulario si no es válido

		// Obtener los valores de los campos
		const firstName = document.getElementById('first_name').value.trim();
		const lastName = document.getElementById('last_name').value.trim();
		const email = document.getElementById('email').value.trim();
		const phone = document.getElementById('phone').value.trim();

		// Validación de los campos
		if (firstName === '') {
			showToast('Please enter First Name', 'error');
			return false;
		}

		if (lastName === '') {
			showToast('Please enter Last Name', 'error');
			return false;
		}

		// Validar el formato del correo electrónico
		const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
		if (email !== '' && !emailPattern.test(email)) {
			showToast('Please enter a valid Email', 'error');
			return false;
		}

		// Validar el formato del teléfono
		const phonePattern = /^[0-9]{10}$/;
		if (phone !== '' && !phonePattern.test(phone)) {
			showToast('Please enter a valid Phone number (10 digits)', 'error');
			return false;
		}

		// Si todo está correcto, enviamos el formulario
		document.getElementById('asistentForm').submit();
	}

	// Función para mostrar los mensajes con Toastify
	function showToast(message, type) {
		Toastify({
			text: message,
			backgroundColor: type === 'error' ? "linear-gradient(to right, #ff5f6d,rgb(231, 19, 12))" : "linear-gradient(to right, #00b09b, #96c93d)",
			duration: 3000,
			close: true
		}).showToast();
	}

	// Asociamos la validación al evento de submit del formulario
	document.getElementById('asistentForm').addEventListener('submit', validateForm);


	$(document).ready(function () {
		// Inicializa la tabla con DataTables
		$('#asistentTable').DataTable({
			"responsive": true,  // Hace que la tabla sea adaptable a diferentes tamaños de pantalla
			
		});
	});
</script>
