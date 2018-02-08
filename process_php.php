<?php 
	include "database.php";
	
	if(isset($_REQUEST['submit_form'])) {
		//inserting info into servers database
		$ins_sql = "INSERT INTO learning_ajax (u_name, u_email, u_number, u_number) VALUES ('$_REQUEST[name]', '$_REQUEST[email]', '$_REQUEST[contact_number]', '$_REQUEST[notes]')";
		//run this code on server
		$run_sql = mysqli_query($conn, $ins_sql);
	}
	
	if(isset($_REQUEST['del_id'])) {
		$del_sql = "DELETE FROM learning_ajax WHERE u_id = '$_REQUEST[del_id]'";
		$del_run = mysqli_query($conn, $del_sql);
	}
	
	$sql = "SELECT * FROM learning_ajax";
	$run = mysqli_query($conn, $sql);
	$c = 1;
	while($rows = mysqli_fetch_assoc($run)) {
		echo " 
			<tr>
				<td>$c</td>
				<td>$rows[u_id]</td>
				<td>$rows[u_name]</td>
				<td>$rows[u_email]</td>
				<td>$rows[u_number]</td>
				<td>$rows[u_notes]</td>
				<td>
					<button class='btn btn-success' data-toggle='modal' data-target='#edit_elem$rows[u_id]' data-backdrop='static'>Edit</button>
					<button class='btn btn-danger' onclick=delete_func('$rows[u_id]');>Delete</button>
					
					<div class='modal fade text-left' id='edit_elem$rows[u_id]'>
						<div class='modal-dialog'>
							<div class='modal-content'>
								<div class='modal-header'>
									<h4>Edit person</h4>
									<button type='button' class='close' data-dismiss='modal'>&times;</button>
								</div>
								<div class='modal-body'>
									<form onsubmit='return edit_func($rows[u_id]);' id='form_clear'>
										<div class='form-group'>
											<label>Change name</label>
											<input type='text' id='edit_name' class='form-control' required></input>
										</div>
										<div class='form-group'>
											<label>Change e-mail</label>
											<input type='email' id='edit_email' class='form-control' required></input> 
										</div>
										<div class='form-group'>
											<label>Change contact number</label>
											<input type='text' id='edit_contact_number' class='form-control' required></input>
										</div>
										<div class='form-group'>
											<label>Change notes</label>
											<textarea class='form-control' id='edit_notes'></textarea>
										</div>
										<div class='form-group'>
											<button type='button' class='btn btn-info btn-block btn-lg'>Done Editing</button>
										</div>
									</form>
								</div>
								<div class='modal-footer'>
									<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
								</div>
							<div>
						</div>
					</div>
				</td>
			</tr>
		";
		$c++;
	}
?>
<!-- u_name etc are simply names of the the table columns in your database on server -->