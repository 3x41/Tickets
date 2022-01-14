<?php
include '../inc/functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID param in the URL exists
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = $pdo->prepare('SELECT * FROM location WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

// Update status
if (isset($_GET['status']) ) {
	
	if ($_GET['status']=="delete"){
		//echo ("DELETED");
		$stmt = $pdo->prepare('DELETE FROM location WHERE id = ?');
		$stmt->execute([ $_GET['id'] ]);
		header('Location: location.php');
		exit;
	}
	
}



$stmt = $pdo->prepare('SELECT * FROM location WHERE id = ? ORDER BY created DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Ticket')?>

<div class="content view">
	
	
	<div class="btns">
		<a href="javascript:window.history.back();" class="btn" >Back</a>
		
	<a href="view_location.php?id=<?=$_GET['id']?>&status=delete" class="btn red">Delete</a>
	</div>
    
    
	<h2>Ticket Location</h2>

	
	
	
	<h2><?=htmlspecialchars($ticket['location'], ENT_QUOTES)?> 
	</h2>


  

</div>

<?=template_footer()?>
