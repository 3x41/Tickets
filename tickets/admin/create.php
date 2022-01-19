<?php
include '../inc/functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['title'], $_POST['email'], $_POST['msg'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['title']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please provide a valid email address!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO tickets (title, email, msg, assigned) VALUES (?, ?, ?, ?)');
        $stmt->execute([ $_POST['title'], $_POST['email'], $_POST['msg'], $_POST['assigned'] ]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        header('Location: view.php?id=' . $pdo->lastInsertId());
		//header('Location: index.php');
    }
}

$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM users WHERE status="active"');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
  //echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: ../login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}
?>

<?=template_header('Create Ticket')?>
<?php if ($msg): ?>
<p><?=$msg?></p>
<?php endif; ?>
<div class="content create">
	<h2>Create Ticket</h2>
    <form action="create.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title" required>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email Address" id="email">

		<label for="email">Assign to User</label>
				<select name="assigned" id="assigned">
					<option></option>
		<?php
		foreach($users as $user):

			if ($username==$user['username'])
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



		<!--
		<label for="title">File Attachment (Not working)</label>

		<input type="file" name="attachment" placeholder="File" id="file">
        -->

        <label for="msg">Message</label>
        <textarea name="msg" placeholder="Enter your message here..." id="msg" required></textarea>
        <input type="submit" value="Create Ticket">
    </form>

</div>

<?=template_footer()?>
