<?php 
	include "db.php";
	
	if(isset($_REQUEST['submit_form'])) {
		echo "The form has been submitted. $_REQUEST[name]";
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
				<td><button class='btn btn-success'>Edit</button> <button class='btn btn-danger'>Delete</button></td>
			</tr>
		";
		$c++;
	}
?>
<!-- u_name etc are simply names of the the table columns in your database on server -->