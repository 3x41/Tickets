<?php


include '../inc/functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM location');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
//  echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}

?>

<?=template_header('Tickets')?>

<div class="content home">

	<div class="btns">
	<a href="config.php" class="btn" >Back</a>
		<a href="create_location.php" class="btn">Add Location</a>
	</div>



	<h2>Ticket Location</h2>


	<div class="tickets-list">
		<?php foreach ($users as $user): ?>
		<a href="view_location.php?id=<?=$user['id']?>" class="ticket">
			<span class="con">
				
				<i class="far fa-info fa-2x"></i>
				
			</span>
			<span class="con">
			    
				<span class="title"><?=htmlspecialchars($user['location'], ENT_QUOTES)?></span>
				
			</span>
			<span class="con created"></span>
		</a>
		<?php endforeach; ?>
	</div>

</div>

<?=template_footer()?>
