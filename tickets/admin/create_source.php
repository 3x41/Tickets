<?php
include '../inc/functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['type'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['type'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO source (type) VALUES (?)');
        $stmt->execute([ $_POST['type']]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        //header('Location: users.php?id=' . $pdo->lastInsertId());
		header('Location: source.php');
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
	<div class="btns">
	<a href="javascript:window.history.back();" class="btn" >Back</a>
	</div>
	
	<h2>Create Source</h2>
    <form action="create_source.php" method="post">
        <label for="Username">Type</label>
        <input type="text" name="type" placeholder="Type" id="type" required>
        <input type="hidden" name="status" value="active" id="status">
        <input type="submit" value="Create Source">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
