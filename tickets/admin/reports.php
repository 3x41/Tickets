<?php
include '../inc/functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE status = "open" OR status = "hold" ORDER BY created DESC');
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

	<h2>Reports</h2>

	<p>Welcome <?php echo($username); ?> </p>

<h1>Not working</h1>

	<div class="btns">
		<a href="#" class="btn">Show Report</a>
	</div>



</div>

<?=template_footer()?>
