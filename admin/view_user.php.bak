<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID param in the URL exists
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

// Update status
if (isset($_GET['status']) ) {
    $stmt = $pdo->prepare('UPDATE users SET status = ? WHERE id = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
	header('Location: users.php');
    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg) VALUES (?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
	header('Location: users.php');
	
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ? ORDER BY created DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Ticket')?>

<div class="content view">
	<h2><?=htmlspecialchars($ticket['username'], ENT_QUOTES)?> 
	
	<span class="<?=$ticket['status']?>">(<?=$ticket['status']?>)</span></h2>


    <div class="ticket">
       
	   
	   
   
	  
        <form action="view_user.php" method="post">
		<label for="password">Password</label>
		<input type="text" name="password" id="password" value="<?php echo ($ticket['password']) ?>">
            
			<input type="hidden" name="id" id="id" value="<?php echo ($ticket['id']) ?>" >
			<input type="submit" value="Update">
        </form>
	
<div class="btns">
		
		<?php	
				if ($ticket['status']=="active")
		{
			?>
			 <a href="view_user.php?id=<?=$_GET['id']?>&status=deactive" class="btn red">De-activate User</a>
		<?php
		}
		else
		{
			?>
			<a href="view_user.php?id=<?=$_GET['id']?>&status=active" class="btn">Activate User</a>
		<?php
		}
		
		?>
	
	
	
	
		
       
        
    </div>
    </div>

</div>

<?=template_footer()?>
