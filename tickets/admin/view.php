<?php
include '../inc/functions.php';


$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
  //echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: ../login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}




// priority

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


$Redirect = "No";

// Update assigned
if (isset($_POST['assigned'])) {



	$ll = "UPDATE `tickets` SET `assigned` = '".$_POST['assigned']."', `location` = '".$_POST['location']."', `source` = '".$_POST['source']."', `department` = '".$_POST['department']."', `catagory` = '".$_POST['catagory']."', `priority` = '".$_POST['priority']."' WHERE `tickets`.`id` =".$_POST['id'];
	//echo ($ll);

	$stmt = $pdo->prepare($ll);
    $stmt->execute();
//	header('Location: index.php?vtickets=mytickets');
  $Redirect = "Yes";
  //  exit;

}

// Update status
if (isset($_GET['status']) && in_array($_GET['status'], array('open', 'closed', 'resolved', 'hold'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET status = ?,resolved=CURDATE() WHERE id = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
	header('Location: index.php?vtickets=mytickets');
  $Redirect = "Yes";

	//UPDATE tickets SET status="open",resolved=CURDATE() WHERE id=1

//    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg, assigned) VALUES (?, ?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'], $_POST['assigned'] ]);
    //header('Location: view.php?id=' . $_GET['id']);
    $Redirect = "Yes";

//	header('Location: index.php?vtickets=mytickets');

  //  exit;
}
if  ($Redirect == "Yes"){

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


// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM location');
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);





// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM source');
$stmt->execute();
$sources = $stmt->fetchAll(PDO::FETCH_ASSOC);

// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM department');
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM catagory');
$stmt->execute();
$catagorys = $stmt->fetchAll(PDO::FETCH_ASSOC);





// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM priority');
$stmt->execute();
$prioritys = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?=template_header('Ticket')?>






<div class="content view">

	<div class="btns">

		<a href="index.php?vtickets=mytickets" class="btn" >Back</a>
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



  	<input type="hidden" name="assigned" id="assigned" value="<?php echo($username); ?>">



            <textarea name="msg" id="msg" placeholder="Enter your comment..."></textarea>




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












		<label for="email">Location</label>
		<select name="location" id="location">
			<option></option>
		<?php
		foreach($locations as $loc):

			if ($ticket['location']==$loc['location'])
			{
				echo ('<option selected>'.$loc['location'].'</option>');
			}
			else
			{
			echo ('<option>'.$loc['location'].'</option>');
			}

        endforeach;
		?>
		</select>



		<label for="email">Source</label>
		<select name="source" id="source">
			<option></option>
		<?php
		foreach($sources as $source):

			if ($ticket['source']==$source['type'])
			{
				echo ('<option selected>'.$source['type'].'</option>');
			}
			else
			{
			echo ('<option>'.$source['type'].'</option>');
			}

        endforeach;
		?>
		</select>


		<label for="email">Department</label>
		<select name="department" id="department">
			<option></option>
		<?php
		foreach($departments as $department):

			if ($ticket['department']==$department['department'])
			{
				echo ('<option selected>'.$department['department'].'</option>');
			}
			else
			{
			echo ('<option>'.$department['department'].'</option>');
			}

        endforeach;
		?>
		</select>



		<label for="email">Catagory</label>
		<select name="catagory" id="catagory">
			<option></option>
		<?php
		foreach($catagorys as $catagory):

			if ($ticket['catagory']==$catagory['catagory'])
			{
				echo ('<option selected>'.$catagory['catagory'].'</option>');
			}
			else
			{
			echo ('<option>'.$catagory['catagory'].'</option>');
			}

        endforeach;
		?>
		</select>





    <label for="email">Priority</label>
    <select name="priority" id="priority">
      <option></option>
    <?php
    foreach($prioritys as $priority):

      if ($ticket['priority']==$priority['priority'])
      {
        echo ('<option selected>'.$priority['priority'].'</option>');
      }
      else
      {
      echo ('<option>'.$priority['priority'].'</option>');
      }

        endforeach;
    ?>
    </select>



		<input type="hidden" name="id" id="id" value="<?php echo($_GET['id']); ?>">
<input type="submit" value="Update Ticket">
        </form>

        <div class="btns">

          <a href="index.php?vtickets=mytickets" class="btn" >Back</a>

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
