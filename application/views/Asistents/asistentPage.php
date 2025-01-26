<div class="container my-3">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
					<?php echo isset($party) ?'EDIT ASISTANT' : 'ADD ASSISTANT'; ?>
				</h4>
            </div>
			<div class="card-body">
    			<form id="asistentForm" method="post" action="<?php echo isset($asistent)? site_url('Asistents/update'):site_url('Asistents/save');?>">
        		<div class="row g-3">
				<input type="hidden"name="id" id="id" value="<?php echo isset($asistent) ? $asistent->id : ''; ?>" >
            <!-- Primera fila -->
            <div class="col-md-3">
                <input 
                    type="text" 
                    id="first_name" 
                    name="first_name" 
                    class="form-control" 
                    placeholder="First Name" 
					value="<?php echo isset($asistent) ? $asistent->first_name : ''; ?>"
                    required
                >
            </div>
            <div class="col-md-3">
                <input 
                    type="text" 
                    id="last_name" 
                    name="last_name" 
                    class="form-control" 
					value="<?php echo isset($asistent) ? $asistent->last_name : ''; ?>"
                    required
                >
            </div>
            <div class="col-md-3">
                <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    class="form-control" 
					value="<?php echo isset($asistent) ? $asistent->email : ''; ?>"

                    placeholder="Location"
                >
            </div>

			<div class="col-md-3">
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control" 
					value="<?php echo isset($asistent) ? $asistent->phone : ''; ?>"

                    placeholder="Location"
                >
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
		<table class="table table-bordered table-hover" id="partyTable">
                    <thead class="table-dark" >
                        <tr>
                            <th>ID</th>
                            <th>Firs Names</th>
                            <th>Last names</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="partyTable">
						<?php if (!empty($asistents)) { ?>
							<?php foreach ($asistents as $asistent) { ?>
								<tr>
									<td><?php echo htmlspecialchars($asistent->id); ?></td>
									<td><?php echo htmlspecialchars($asistent->first_name); ?></td>
									<td><?php echo htmlspecialchars($asistent->last_name); ?></td>
									<td><?php echo htmlspecialchars($asistent->email); ?></td>
									<td><?php echo htmlspecialchars($asistent->phone); ?></td>
									<td>
										<a href="<?php echo site_url('Asistents/selectAsistent/' .$asistent->id);?>" class="btn btn-primary"> <i class="fas fa-pen"></i></a>
										<a href="<?php echo site_url('Asistents/delete/' . $asistent->id); ?>" class="btn btn-danger">
											<i class="fas fa-trash-alt"></i> Delete
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

	
