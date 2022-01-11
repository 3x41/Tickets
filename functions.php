<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'test';
    $DATABASE_PASS = 'test';
    $DATABASE_NAME = 'phpticket';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

// Template header, feel free to customize this
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Ticketing System</h1>
            <a href="index.php"><i class="fas fa-ticket-alt"></i>Tickets</a>
			<a href="users.php"><i class="fas fa-user"></i>Users</a>
			<a href="search.php"><i class="fas fa-search"></i>Search</a>
			<a href="reports.php"><i class="fas fa-info"></i>Reports</a>
			<a href="login.php"><i class="fas fa-door-open"></i>Log Out</a>
    	</div>
    </nav>
EOT;
}


//Login header
function login_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Ticketing System</h1>
            
    	</div>
    </nav>
EOT;
}

// Template footer
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>