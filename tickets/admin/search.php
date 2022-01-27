<?php
include '../inc/functions.php';
// Connect to MySQL using the below function






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

	<h2>Search</h2>


  	<p>Welcome <?php echo(ucfirst($username)); ?><hr>


<h2>Search Text In Ticket Title</h2>
<form action="search.php" method="post">
    <label for="title">Type in text to search for in the Ticket Title</label>
    <p> </p>
    <input type="text" name="search" placeholder="Search Text" id="search">


<input type="submit" value="Search">


  </form>

<p> </p>
<h2>Search For Ticket Number</h2>
  <form action="search.php" method="post">
      <label for="title">Type in Ticket ID</label>
      <p> </p>

      <input type="text" name="search2" placeholder="Enter Ticket ID Number" id="search2">
  <input type="submit" value="Search For Ticket">
    </form>
<p> </p>
<hr>
<h2>Search Results</h2>

<?php
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$SQL = "";

if (isset($_POST['search2'])) {
$SQL = "SELECT * FROM `tickets` WHERE `id` =".$_POST['search2'].";";
}


if (isset($_POST['search'])) {
$SQL = "SELECT * FROM `tickets` WHERE `title` LIKE '%".$_POST['search']."%' LIMIT 50;";
}

  $stmt = $pdo->prepare($SQL);
  $stmt->execute();
  $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
  <div class="tickets-list">
		<?php foreach ($tickets as $ticket): ?>
		<a href="view.php?id=<?=$ticket['id']?>" class="ticket">

			<span class="con">
			    <span class="id">Ticket #<?=htmlspecialchars($ticket['id'], ENT_QUOTES)?></span>
				<span class="title"><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?></span>
				<span class="msg"><?=htmlspecialchars($ticket['msg'], ENT_QUOTES)?></span>
			</span>
			<span class="con created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></span>
		</a>
		<?php endforeach; ?>
	</div>

<?php

?>
</div>
<?=template_footer()?>
