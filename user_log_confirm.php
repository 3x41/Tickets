<?php
include 'inc/functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_GET['id'])) {
    // Validation checks... make sure the POST data is not empty
	
    $id = $_GET['id'];
}





?>

<?=login_header('Create Ticket')?>

<div class="content create">
	<h2>Your Ticket has been created</h2>
    <p>You will be contacted when the ticket is either being looked into, or when it has been resolved. </p>
	<H3>
	Your ticket number is 
	</H3>
	<H2>
	<?php echo ($id); ?>
</H2>
<p>If you need to contact us about your issue, if you can, please let us know this ticket number so that we can find your request quicker.</p>
</div>

<?=template_footer()?>
