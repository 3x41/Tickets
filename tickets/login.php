<?php
$msg = '';
setcookie("Tickets", "", time() - 3600,"/");
include 'inc/functions.php';


if (!isset($_POST['username']) && !isset($_POST['password'])) {
    //echo ("no username");
	//exit('No ID specified!');
}
else
{
	$username = $_POST['username'];
$password = $_POST['password'];
	// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = "'.$username.'" and password="'.$password.'" and status="active"');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) > 0)
{
	echo ("Allow Access");
	
	$cookie_name = "Tickets";
$cookie_value = $_POST['username'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

header('Location: admin/index.php');
}


}

?>

<?=login_header('Tickets')?>

<div class="content home">

	<h2>Login</h2>



<div class="content create">

    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">
		
        <input type="submit" value="Login">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


	
	
	

</div>

<?=template_footer()?>
