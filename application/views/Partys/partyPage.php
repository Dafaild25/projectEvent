<div class="container my-3">
	<div class="card shadow-lg">
		<div class="card-header bg-primary text-white">
			<h4 class="mb-0">
				<?php echo isset($party) ? 'EDIT EVENT' : 'ADD EVENT'; ?>
			</h4>
		</div>
		<div class="card-body">
			<form id="partyForm" method="post"
				action="<?php echo isset($party) ? site_url('Partys/update') : site_url('Partys/save'); ?>">
				<div class="row g-3">
					<input type="hidden" name="id" id="id" value="<?php echo isset($party) ? $party->id : ''; ?>">
					<!-- Primera fila -->
					<div class="col-md-4">
						<input type="text" id="name" name="name" class="form-control" placeholder="Party Name"
							value="<?php echo isset($party) ? $party->name : ''; ?>" required>
					</div>
					<div class="col-md-4">
						<input type="date" id="start_date" name="start_date" class="form-control"
							value="<?php echo isset($party) ? $party->start_date : ''; ?>" required>
					</div>
					<div class="col-md-4">
						<input type="text" id="location" name="location" class="form-control"
							value="<?php echo isset($party) ? $party->location : ''; ?>" placeholder="Location">
					</div>
				</div>

				<div class="row g-3 mt-3">
					<!-- Segunda fila con descripción -->
					<div class="col-md-6">
						<textarea id="description" name="description" class="form-control" placeholder="Description">
							<?php echo isset($party) ? $party->description : ''; ?>
						</textarea>
					</div>
					<div class="col-md-6">
						<div class="text-end mt-3">
							<button type="submit" class="btn btn-success">Add Party</button>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
</div>

<!-- Tabla para listar los eventos -->
<div class="container">
	<div class="table-resposive">
		<table class="table table-bordered table-hover" id="partyTable">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Start Date</th>
					<th>Location</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="partyTable">
				<?php if (!empty($partys)) { ?>
					<?php foreach ($partys as $party) { ?>
						<tr>
							<td><?php echo htmlspecialchars($party->id); ?></td>
							<td><?php echo htmlspecialchars($party->name); ?></td>
							<td><?php echo htmlspecialchars($party->description); ?></td>
							<td><?php echo htmlspecialchars($party->start_date); ?></td>
							<td><?php echo htmlspecialchars($party->location); ?></td>
							<td>
								<a href="<?php echo site_url('Partys/selectParty/' . $party->id); ?>" class="btn btn-primary">
									<i class="fas fa-pen"></i></a>
								<a href="<?php echo site_url('Partys/delete/' . $party->id); ?>" class="btn btn-danger">
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
		event.preventDefault(); 

		// Obtener los valores de los campos
		const name = document.getElementById('name').value.trim();
		const startDate = document.getElementById('start_date').value.trim();
		const location = document.getElementById('location').value.trim();
		const description = document.getElementById('description').value.trim();

		// Validación de los campos
		if (name === '') {
			showToast('Please enter a Party Name', 'error');
			return false;
		}

		if (startDate === '') {
			showToast('Please select a Start Date', 'error');
			return false;
		}

		if (location === '') {
			showToast('Please enter a Location', 'error');
			return false;
		}

		if (description === '') {
			showToast('Please enter a Description', 'error');
			return false;
		}

		// Si todo está correcto, enviamos el formulario
		document.getElementById('partyForm').submit();
	}

	// Función para mostrar los mensajes con Toastify
	function showToast(message, type) {
		Toastify({
			text: message,
			backgroundColor: type === 'error' ? "linear-gradient(to right, #ff5f6d,rgb(228, 27, 27))" : "linear-gradient(to right, #00b09b, #96c93d)",
			duration: 3000,
			close: true
		}).showToast();
	}

	// Asociamos la validación al evento de submit del formulario
	document.getElementById('partyForm').addEventListener('submit', validateForm);
</script>
