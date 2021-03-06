<?php

$ProgramVersion = "Version 0.8a";
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
		<link href="../inc/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Ticketing System</h1>
            <a href="index.php?vtickets=unassigned"><i class="fas fa-clipboard-list"></i>Tickets</a>

			<a href="config.php"><i class="fas fa-cog"></i>Config</a>

			<a href="search.php"><i class="fas fa-search"></i>Search</a>
			<a href="reports.php"><i class="fas fa-info"></i>Reports</a>

			<a href="../login.php"><i class="fas fa-door-open"></i>Log Out</a>
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
		<link href="inc/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Ticketing System</h1>
    		<a href="user_log_ticket.php"><i class="fas fa-clipboard-list"></i>Create Ticket</a>
            <a href="login.php"><i class="fas fa-user"></i>Login</a>
    	</div>
    </nav>
EOT;
}

// Template footer
function template_footer() {
echo <<<EOT
    <p>&nbsp;</p>
    <nav class="navtop">
    <div>
    <p style="color:white;">

    Ticketing System -
EOT;
GLOBAL $ProgramVersion;
echo (" ".$ProgramVersion);


echo <<<EOT

</p>
      </div>
	</nav>
	</body>
</html>
EOT;
}
?>
