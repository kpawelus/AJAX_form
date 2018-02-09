<?php 
	include "database.php";
	
	if(isset($_REQUEST['submit_form'])) {
		//securing form form sql injection
		$username = mysqli_real_escape_string($conn, strip_tags($_REQUEST['name']));
		$email = mysqli_real_escape_string($conn, strip_tags($_REQUEST['email']));
		$contactnumber = mysqli_real_escape_string($conn, strip_tags($_REQUEST['contact_number']));
		$notes =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['notes']));
		//inserting info into servers database (variables taken from above)
		$ins_sql = "INSERT INTO learning_ajax (u_name, u_email, u_number, u_number) VALUES ('$username', '$email ', '$contactnumber', '$notes')";
		//run this code on server
		$run_sql = mysqli_query($conn, $ins_sql);
	}
	
	if(isset($_REQUEST['delete_form'])) {
		$del_sql = "DELETE FROM learning_ajax WHERE u_id = '$_REQUEST[delete_form]'";
		$del_run = mysqli_query($conn, $del_sql);
	}
	
	if(isset($_REQUEST['edit_form'])) {
		//securing form form sql injection
		$edit_username =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_name']));
		$edit_email =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_email']));
		$edit_contactnumber =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_contact_number']));
		$edit_notes =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_notes']));
		//changing info in servers database (variables taken from above)
		$edit_sql = "UPDATE learning_ajax SET u_name = '$edit_username', u_email = '$edit_email', u_number = '$edit_contactnumber', u_notes = '$edit_notes' WHERE u_id = '$_REQUEST[edit_id]'";
		$edit_run = mysqli_query($conn, $edit_sql);
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
									<form onsubmit='return edit_func($rows[u_id]);' id='reseting_edit_form$rows[u_id]'>
										<div class='form-group'>
											<label>Change name</label>
											<input type='text' value='$rows[u_name]' id='edit_name$rows[u_id]' class='form-control' required></input>
										</div>
										<div class='form-group'>
											<label>Change e-mail</label>
											<input type='email' value='$rows[u_email]' id='edit_email$rows[u_id]' class='form-control' required></input> 
										</div>
										<div class='form-group'>
											<label>Change contact number</label>
											<input type='text' value='$rows[u_number]' id='edit_contact_number$rows[u_id]' class='form-control' required></input>
										</div>
										<div class='form-group'>
											<label>Change notes</label>
											<textarea class='form-control' value='$rows[u_notes]' id='edit_notes$rows[u_id]'></textarea>
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