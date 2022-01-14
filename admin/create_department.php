<?php
include '../inc/functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['department'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['department'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO department (department) VALUES (?)');
        $stmt->execute([ $_POST['department']]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        //header('Location: users.php?id=' . $pdo->lastInsertId());
		header('Location: department.php');
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
	<div class="btns">
	<a href="javascript:window.history.back();" class="btn" >Back</a>
	</div>
	
	<h2>Create department</h2>
    <form action="create_department.php" method="post">
        <label for="Username">department</label>
        <input type="text" name="department" placeholder="department" id="department" required>
        <input type="hidden" name="status" value="active" id="status">
        <input type="submit" value="Create department">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
