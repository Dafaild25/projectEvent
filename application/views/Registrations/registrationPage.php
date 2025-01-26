<div class="container my-3">
	<div class="card shadow-lg">
		<div class="card-header bg-primary text-white">
			<h4 class="mb-0">
				<?php echo isset($registration) ? 'EDIT REGISTRATION' : 'ADD REGISTRATION'; ?>
			</h4>
		</div>
		<div class="card-body">
			<form id="registrationForm" method="post"
				action="<?php echo isset($registration) ? site_url('Registrations/update') : site_url('Registrations/save'); ?>">
				<div class="row g-3">
					<input type="hidden" name="id" id="id"
						value="<?php echo isset($registration) ? $registration->id : ''; ?>">
					<!-- Primera fila -->
					<div class="col-md-6">
						<select name="asistent_id" id="asistent_id" class="form-select">
							<option value="">Select an Asistent</option>
							<?php foreach ($asistents as $asistent): ?>
								<option value="<?= $asistent->id; ?>" <?= isset($registration) && $registration->asistent_id == $asistent->id ? 'selected' : ''; ?>>
									<?= $asistent->first_name; ?> 	<?= $asistent->last_name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6">
						<select name="party_id" id="party_id" class="form-control">
							<option value="">Select an Event</option>
							<?php foreach ($partys as $party): ?>
								<option value="<?= $party->id; ?>" <?= isset($registration) && $registration->party_id == $party->id ? 'selected' : ''; ?>>
									<?= $party->name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

				</div>

				<div class="row g-3 mt-3">

					<div class="col-md-12">
						<div class="text-end mt-3">
							<button type="submit" class="btn btn-success">Register</button>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
</div>

<!-- Tabla para listar los REGISTROS -->
<div class="container">
	<div class="table-resposive">
		<table class="table table-bordered table-hover" id="partyTable">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>ASISTENT</th>
					<th>EVENT</th>
					<th>REGISTRATION DATE</th>
					<th>DATE EVENT</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="asistentTable">
				<?php if (!empty($registrations)) { ?>
					<?php foreach ($registrations as $registration) { ?>
						<tr>
							<td><?php echo htmlspecialchars($registration->id); ?></td>
							<!-- Buscar el nombre del asistente -->
							<td>
								<?php
								$asistent = array_filter($asistents, function ($a) use ($registration) {
									return $a->id == $registration->asistent_id;
								});
								$asistent = reset($asistent); // Obtener el primer elemento del array filtrado
								echo isset($asistent) ? htmlspecialchars($asistent->first_name . ' ' . $asistent->last_name) : 'No name';

								?>
							</td>
							<!-- Buscar el nombre del party -->
							<td>
								<?php
								$party = array_filter($partys, function ($p) use ($registration) {
									return $p->id == $registration->party_id;
								});
								$party = reset($party); // Obtener el primer elemento del array filtrado
								echo isset($party) ? htmlspecialchars($party->name) : 'No event';
								?>
							</td>
							<td><?php echo htmlspecialchars($registration->registered_at); ?></td>
							<td>
								<?php
								$party = array_filter($partys, function ($p) use ($registration) {
									return $p->id == $registration->party_id;
								});
								$party = reset($party); // Obtener el primer elemento del array filtrado
								echo isset($party) ? htmlspecialchars($party->start_date) : 'No date';
								?>
							</td>
							<td>
								<a href="<?php echo site_url('Registrations/selectRegistration/' . $registration->id); ?>"
									class="btn btn-primary">
									<i class="fas fa-pen"></i>
								</a>
								<a href="<?php echo site_url('Registrations/delete/' . $registration->id); ?>"
									class="btn btn-danger">
									<i class="fas fa-trash-alt"></i> Delete
								</a>
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr>
						<td colspan="6" class="text-center">No registrations found.</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<script>
	document.getElementById("registrationForm").addEventListener("submit", function (event) {
		var asistentSelect = document.getElementById("asistent_id");
		var partySelect = document.getElementById("party_id");

		// Validar si se ha seleccionado un asistente
		if (!asistentSelect.value) {
			showToast("Please select an Asistent.", "error");
			event.preventDefault();  // Evita que el formulario se envíe
			return false;
		}

		// Validar si se ha seleccionado un evento
		if (!partySelect.value) {
			showToast("Please select an Event.", "error");
			event.preventDefault();  // Evita que el formulario se envíe
			return false;
		}

		// Si todo es válido, el formulario se enviará
	});

	// Función para mostrar los mensajes con Toastify
	function showToast(message, type) {
		Toastify({
			text: message,
			backgroundColor: type === "warning" ? "linear-gradient(to right, #ff6347, #ff4500)" : "linear-gradient(to right,rgb(223, 146, 59),rgb(199, 102, 23))", // Fondo tomate
			color: "#fff",  // Texto y icono blanco
			duration: 3000,
			close: true,
			icon: "⚠️", // Icono de advertencia
			gravity: "top", // Puede ser "top" o "bottom"
			position: "right" // Puede ser "left" o "right"
		}).showToast();
	}
</script>
