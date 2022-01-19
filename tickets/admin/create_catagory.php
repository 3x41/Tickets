<?php
include '../inc/functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['catagory'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['catagory'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO catagory (catagory) VALUES (?)');
        $stmt->execute([ $_POST['catagory']]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        //header('Location: users.php?id=' . $pdo->lastInsertId());
		header('Location: catagory.php');
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
	<div class="btns">
	<a href="javascript:window.history.back();" class="btn" >Back</a>
	</div>
	        
	<h2>Create Catagory</h2>
    <form action="create_catagory.php" method="post">
        <label for="Username">Catagory</label>
        <input type="text" name="catagory" placeholder="Catagory" id="catagory" required>
        <input type="hidden" name="status" value="active" id="status">
        <input type="submit" value="Create Catagory">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
