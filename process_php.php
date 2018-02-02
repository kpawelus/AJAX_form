<?php 
	include "db.php";
	
	if(isset($_REQUEST['submit_form'])) {
		echo "The form has been submitted. $_REQUEST[name]";
		//inserting info into servers database
		$ins_sql = "INSERT INTO users (u_name, u_email, u_number, u_number) VALUES ('$_REQUEST[name]', '$_REQUEST[email]', '$_REQUEST[contact_number]', '$_REQUEST[notes]')";
		//run this code on server
		$run_sql = mysqli_query($conn, $ins_sql);
	}
	
	if(isset($_REQUEST['del_id'])) {
		$del_sql = "DELETE FROM users WHERE u_id = '$_REQUEST[del_id]'";
		$del_run = mysqli_query($conn, $del_sql);
	}
	
	$sql = "SELECT * FROM learning_ajax";
	$run = mysqli_query($conn, $sql);
	$c = 1;
	while($rows = mysqli_fetch_assoc($run)) {
		echo " 
			<tr>
				<td>$c</td>
				<td>$rows[u_name]</td>
				<td>$rows[u_email]</td>
				<td>$rows[u_number]</td>
				<td>$rows[u_notes]</td>
				<td>
					<button class='btn btn-success'>Edit</button>
					<button class='btn btn-danger' onclick=delete_func('$rows[u_id]');>Delete</button>
				</td>
			</tr>
		";
		$c++;
	}
?>
<!-- u_name etc are simply names of the the table columns in your database on server -->