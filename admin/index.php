<?php
include '../inc/functions.php';


$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
  //echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}


// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();

if(isset($_GET['vtickets'])) 
{
	//echo ($_GET['vtickets']."...".$username);
	if($_GET['vtickets']=="mytickets")
	{
		$ll = 'SELECT * FROM `tickets` WHERE `assigned` = "'.$username.'" AND `status` = "open" OR `assigned` = "'.$username.'" AND `status` = "hold"'; 
		
	}
	if($_GET['vtickets']=="unassigned")
	{
		$ll = 'SELECT * FROM `tickets` WHERE `assigned` is null OR `assigned` = ""; ';
		//SELECT * FROM `tickets` WHERE (`assigned` is null AND status = "open" OR status = "hold") OR (`assigned` = "" AND status = "open" OR status = "hold"); 
		
	}
	if($_GET['vtickets']=="allopen")
	{
		$ll = 'SELECT * FROM tickets WHERE status = "open" OR status = "hold"';
	}

}
else
{
	
$ll = 'SELECT * FROM tickets WHERE status = "open" OR status = "hold"';
}	



$stmt = $pdo->prepare($ll);
// MySQL query that retrieves  all the tickets from the databse
//$stmt = $pdo->prepare('SELECT * FROM tickets WHERE status = "open" OR status = "hold" ORDER BY created DESC');
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Get count values

		$myticket_count = 'SELECT COUNT(id) AS TotalCount FROM tickets WHERE `assigned` = "'.$username.'" AND `status` = "open" OR `assigned` = "'.$username.'" AND `status` = "hold"';
		$stmt_myticket = $pdo->prepare($myticket_count);
		$stmt_myticket->execute();
		$myticket_count = $stmt_myticket->fetchAll(PDO::FETCH_ASSOC);

		$unassigned_count = 'SELECT COUNT(id) AS TotalCount FROM `tickets` WHERE `assigned` is null OR `assigned` = "";';
		$stmt_unassigned = $pdo->prepare($unassigned_count);
		$stmt_unassigned->execute();
		$unassigned_count = $stmt_unassigned->fetchAll(PDO::FETCH_ASSOC);

		$open_count = 'SELECT COUNT(id) AS TotalCount FROM tickets WHERE status = "open" OR status = "hold"';
		$stmt_open = $pdo->prepare($open_count);
		$stmt_open->execute();
		$open_count = $stmt_open->fetchAll(PDO::FETCH_ASSOC);




?>

<?=template_header('Tickets')?>

<div class="content home">

	

	<div class="btns">
		<a href="create.php" class="btn blue">Create</a>
		
		
		<a href="index.php?vtickets=mytickets" class="btn">My Tickets (
		<?php
			foreach ($myticket_count as $count):
				echo ($count['TotalCount']);
			endforeach;
		?>
		
		)</a>
		<a href="index.php?vtickets=unassigned" class="btn">Unassigned (
		
		
		<?php
			foreach ($unassigned_count as $count):
				echo ($count['TotalCount']);
			endforeach;
		?>
		
		
		)</a>
		<a href="index.php?vtickets=allopen" class="btn">All Open (
		<?php
			foreach ($open_count as $count):
				echo ($count['TotalCount']);
			endforeach;
		?>		
		
		
		
		)</a>
	</div>
	
	
	
	<h2>Tickets</h2>

	<p>Welcome <?php echo($username); ?><hr></p>
	
	
	

	<div class="tickets-list">
		<?php foreach ($tickets as $ticket): ?>
		<a href="view.php?id=<?=$ticket['id']?>" class="ticket">
			<span class="con">
				<?php if ($ticket['status'] == 'open'): ?>
				<i class="fas fa-clipboard-list fa-2x"></i>
				<?php elseif ($ticket['status'] == 'resolved'): ?>
				<i class="fas fa-check fa-2x"></i>
				<?php elseif ($ticket['status'] == 'closed'): ?>
				<i class="fas fa-times fa-2x"></i>
				<?php elseif ($ticket['status'] == 'hold'): ?>
				<i class="fas fa-pause fa-2x"></i>
				<?php endif; ?>
			</span>
			<span class="con">
			    <span class="id">Ticket #<?=htmlspecialchars($ticket['id'], ENT_QUOTES)?></span>
				<span class="title"><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?></span>
				<span class="msg"><?=htmlspecialchars($ticket['msg'], ENT_QUOTES)?></span>
			</span>
			<span class="con created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></span>
		</a>
		<?php endforeach; ?>
	</div>

</div>

<?=template_footer()?>
