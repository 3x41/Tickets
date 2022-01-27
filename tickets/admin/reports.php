<?php
include '../inc/functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE status = "open" OR status = "hold" ORDER BY created DESC');
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);


$username = "";
$cookie_name = "Tickets";

if(!isset($_COOKIE[$cookie_name])) {
//  echo "Cookie named '" . $cookie_name . "' is not set!";
  header('Location: ../login.php');
} else {
	$username = $_COOKIE[$cookie_name];
}




$stmt = $pdo->prepare("SELECT COUNT(status) AS OpenTickets FROM `tickets` WHERE status = 'open' AND `created` > '2022-01-01' AND `created` < '2022-12-31';" );
$stmt->execute();
$OpenTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT COUNT(status) AS HoldTickets FROM `tickets` WHERE status = 'hold' AND `created` > '2022-01-01' AND `created` < '2022-12-31';" );
$stmt->execute();
$HoldTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT COUNT(status) AS ClosedTickets FROM `tickets` WHERE status = 'closed' AND `created` > '2022-01-01' AND `created` < '2022-12-31';" );
$stmt->execute();
$ClosedTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT COUNT(status) AS ResolvedTickets FROM `tickets` WHERE status = 'resolved' AND `created` > '2022-01-01' AND `created` < '2022-12-31';" );
$stmt->execute();
$ResolvedTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);


  foreach($OpenTickets as $result):
    $OpenTickets = $result['OpenTickets'];
  endforeach;
  foreach($HoldTickets as $result):
    $HoldTickets = $result['HoldTickets'];
  endforeach;
  foreach($ClosedTickets as $result):
    $ClosedTickets = $result['ClosedTickets'];
  endforeach;
  foreach($ResolvedTickets as $result):
    $ResolvedTickets = $result['ResolvedTickets'];
  endforeach;

?>

<?=template_header('Tickets')?>

<div class="content home">

	<h2>Reports</h2>


	<p>Welcome <?php echo(ucfirst($username)); ?><hr><br>More reports will be created later on and selectable in this area. </p>


  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

  <div id="myPlot2" style="width:100%;max-width:700px"></div>

  <script>
  var xArray = ["Open", "On-Hold", "Closed", "Resolved"];
  var yArray = [<?=$OpenTickets;?>, <?=$HoldTickets;?>, <?=$ClosedTickets;?>, <?=$ResolvedTickets;?>];

  var layout = {title:"Current Year Stats For Ticket Status - Year 2022"};

  var data = [{labels:xArray, values:yArray, hole:.2, type:"pie"}];

  Plotly.newPlot("myPlot2", data, layout);
  </script>


</div>


<?=template_footer()?>
