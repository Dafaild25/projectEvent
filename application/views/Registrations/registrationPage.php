<div class="container my-3">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
					<?php echo isset($registration) ?'EDIT REGISTRATION' : 'ADD REGISTRATION'; ?>
				</h4>
            </div>
			<div class="card-body">
    			<form id="asistentForm" method="post" action="<?php echo isset($registration)? site_url('Registration/update'):site_url('Registration/save');?>">
        		<div class="row g-3">
				<input type="hidden"name="id" id="id" value="<?php echo isset($registration) ? $registration->id : ''; ?>" >
            <!-- Primera fila -->
            <div class="col-md-6">
                <input 
                    type="text" 
                    id="asistent_id " 
                    name="asistent_id " 
                    class="form-control" 
                    placeholder="First Name" 
					value="<?php echo isset($registration) ? $registration->asistent_id  : ''; ?>"
                    required
                >
            </div>
            <div class="col-md-6">
                <input 
                    type="text" 
                    id="party_id" 
                    name="party_id" 
                    class="form-control" 
					value="<?php echo isset($registration) ? $registration->party_id : ''; ?>"
                    required
                >
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
                    <thead class="table-dark" >
                        <tr>
                            <th>ID</th>
                            <th>ASISTENT</th>
                            <th>EVENTS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="asistentTable">
						<?php if (!empty($registrations)) { ?>
							<?php foreach ($registrations as $registration) { ?>
								<tr>
									<td><?php echo htmlspecialchars($registration->id); ?></td>
									<td><?php echo htmlspecialchars($registration->asistent_id); ?></td>
									<td><?php echo htmlspecialchars($registration->event_id); ?></td>
									
									<td>
										<a href="<?php echo site_url('Registrations/selectRegistration/' .$asistent->id);?>" class="btn btn-primary"> <i class="fas fa-pen"></i></a>
										<a href="<?php echo site_url('Registrations/delete/' . $asistent->id); ?>" class="btn btn-danger">
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

	
