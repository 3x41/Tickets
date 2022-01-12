<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID param in the URL exists
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

// Update status
if (isset($_GET['status']) && in_array($_GET['status'], array('open', 'closed', 'resolved', 'hold'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET status = ? WHERE id = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
	header('Location: index.php');
    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg) VALUES (?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
	header('Location: index.php');
	
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM tickets_comments WHERE ticket_id = ? ORDER BY created DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Ticket')?>

<div class="content view">
	<h2><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?> 
	
	<span class="<?=$ticket['status']?>">(<?=$ticket['status']?>)</span></h2>
	<h1>Ticket <?php echo("#".$ticket['id']) ?>

	<?php
		if ($ticket['assigned']==null)
		{
			echo (" (Currently not assigned)");
		}
		?>
</h1>

    <div class="ticket">
        <p class="created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></p>
        <p class="msg"><?=nl2br(htmlspecialchars($ticket['msg'], ENT_QUOTES))?></p>
    </div>

    

    <div class="comments">
        <?php foreach($comments as $comment): ?>
        <div class="comment">
            <div>
                <i class="fas fa-comment fa-2x"></i>
            </div>
            <p>
                <span><?=date('F dS, G:ia', strtotime($comment['created']))?></span>
                <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
            </p>
        </div>
        <?php endforeach; ?>
        <form action="" method="post">
            <textarea name="msg" placeholder="Enter your comment..."></textarea>
            <input type="submit" value="Update Ticket">
			<input type="file">
        </form>
	
<div class="btns">
		<?php
		if ($ticket['status']=="closed" || $ticket['status']=="resolved")
		{
		?>	
			<a href="view.php?id=<?=$_GET['id']?>&status=open" class="btn">Re-Open Ticket</a>
		<?php	
		}
		
		if ($ticket['status']=="hold")
		{
			?>
			<a href="view.php?id=<?=$_GET['id']?>&status=open" class="btn">Remove Hold</a>
		<?php
		}
		else
		{
			?>
			<a href="view.php?id=<?=$_GET['id']?>&status=hold" class="btn red">On Hold</a>
		<?php
		}
		
		?>
	
	
	
	
		
        <a href="view.php?id=<?=$_GET['id']?>&status=closed" class="btn red">Close Ticket</a>
        <a href="view.php?id=<?=$_GET['id']?>&status=resolved" class="btn red">Resolve Ticket</a>
    </div>
    </div>

</div>

<?=template_footer()?>
