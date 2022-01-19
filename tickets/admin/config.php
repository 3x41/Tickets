<?php


include '../inc/functions.php';


$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
//  echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: ../login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}

?>

<?=template_header('Tickets')?>

<div class="content home">





	<h2>System Configuration</h2>

<div class="btns">
<table>
<tr>
	<td><a href="users.php" class="btn">System Users</a></td>
	<td>Users</td>
</tr>
<tr>
	<td>Ticket Config</td>
	<td></td>

</tr>

<tr>
	<td><a href="source.php" class="btn">Source</a></td>
	<td>This is a list of where the job came from. E.g. Phone, Email, IM</td>
</tr>


<tr>
	<td><a href="location.php" class="btn">Location</a></td>
	<td>Where / What room / Building</td>
</tr>


<tr>
	<td><a href="department.php" class="btn">Department</a></td>
	<td></td>
</tr>




<tr>
	<td><a href="catagory.php" class="btn">Catagory</a></td>
	<td>Hardware software etc</td>
</tr>




</table>

	</div>


</div>

<?=template_footer()?>
