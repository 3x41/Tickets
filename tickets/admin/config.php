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

<div class="btns"><a href="users.php" class="btn">System Users</a><p> </p></div>


<h2>Ticket Configuration</h2>


<div class="btns">
<a href="source.php" class="btn">Source</a>
<p>This is a list of where the job came from. E.g. Phone, Email, IM</p>
</div>

<div class="btns">
<a href="location.php" class="btn">Location</a>
<p>Where / What room / Building</p>
</div>

<div class="btns">
<a href="department.php" class="btn">Department</a>
</div>

<div class="btns">
<a href="catagory.php" class="btn">Catagory</a>
<p>Hardware software etc</p>
</div>

<div class="btns">
<a href="priority.php" class="btn">Priority</a>
<p>High, Normal, Low</p>
</div>

</div>



	</div>


</div>

<?=template_footer()?>
