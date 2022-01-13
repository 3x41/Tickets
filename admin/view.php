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

// Update assigned
if (isset($_POST['assigned'])) {
    
 
	
	$ll = "UPDATE `tickets` SET `assigned` = '".$_POST['assigned']."' WHERE `tickets`.`id` =".$_POST['id'];
	//echo ($ll);

	$stmt = $pdo->prepare($ll);
    $stmt->execute();
	//exit;
	header('Location: index.php?vtickets=mytickets');
    
}

// Update status
if (isset($_GET['status']) && in_array($_GET['status'], array('open', 'closed', 'resolved', 'hold'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET status = ?,resolved=CURDATE() WHERE id = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
	header('Location: index.php?vtickets=mytickets');
	
	//UPDATE tickets SET status="open",resolved=CURDATE() WHERE id=1
	
    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg, assigned) VALUES (?, ?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'], $_POST['assigned'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
	header('Location: index.php?vtickets=mytickets');
	
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM tickets_comments WHERE ticket_id = ?');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM users WHERE status="active"');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>

<?=template_header('Ticket')?>

  
  
  
  
  
<div class="content view">
	
	<div class="btns">
		
		<a href="javascript:window.history.back();" class="btn" >Back</a>

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
	
	
	
	<h2><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?> 
	
	<span class="<?=$ticket['status']?>">(<?=$ticket['status']?>)</span></h2>
	<h1>Ticket Number <?php echo("#".$ticket['id']) ?>

	<?php
		if ($ticket['assigned']==null)
		{
			echo (" (Currently not assigned)");
		}
		else
		{
		echo(" (Assigned to ".$ticket['assigned'].")");
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
                <span><?=date('F dS, G:ia', strtotime($comment['created']));  echo (" (".$comment['assigned'].")");?></span>
                <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
            </p>
        </div>
        <?php endforeach; ?>
        <form action="" method="post">
		
		
		
		
		<input type="hidden" name="id" id="id" value="<?php echo($_GET['id']); ?>">
		<input type="hidden" name="assigned" id="assigned" value="<?php echo($username); ?>">
		
		
		
            <textarea name="msg" placeholder="Enter your comment..."></textarea>
            <input type="submit" value="Update Ticket">
			
        </form>
	
		
		
	
	<form action="" method="post">
		
		<label for="email">Assign Ticket to User</label>
		<select name="assigned" id="assigned">
			<option></option>
		<?php 
		foreach($users as $user): 
			
			if ($ticket['assigned']==$user['username'])
			{
				echo ('<option selected>'.$user['username'].'</option>');
			}
			else
			{
			echo ('<option>'.$user['username'].'</option>');
			}
			
        endforeach; 
		?>
		</select>
		
		
		
		<input type="hidden" name="id" id="id" value="<?php echo($_GET['id']); ?>">
            <input type="submit" value="Assign">
			
        </form>
	
		
        
		
  
    </div>

</div>

<?=template_footer()?>
