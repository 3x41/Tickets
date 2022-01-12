<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['username'], $_POST['password'], $_POST['status'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO users (username, password, status) VALUES (?, ?, ?)');
        $stmt->execute([ $_POST['username'], $_POST['password'], $_POST['status'] ]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        //header('Location: users.php?id=' . $pdo->lastInsertId());
		header('Location: users.php');
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
	<h2>Create User</h2>
    <form action="create_user.php" method="post">
        <label for="Username">Username</label>
        <input type="text" name="username" placeholder="Username" id="username" required>
        <label for="password">Password</label>
        <input type="text" name="password" placeholder="Password" id="password">
	<input type="hidden" name="status" value="active" id="status">
        <input type="submit" value="Create User">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
