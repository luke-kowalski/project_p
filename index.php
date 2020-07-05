<?php
    require_once 'include/dbh.inc.php';
    $db_connection = @new mysqli($host, $db_user, $db_password, $db_name);
  
    if ($db_connection->connect_error) {
        die('Connect Error: ' . $db_connection->connect_error);
        exit();
    }
?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="css/main.css">
<title>Kontrola Grubego</title>
</head>
<body>

<div class="container">

	<div class="row">
		<div class="col-sm-3">
			<div class="ticket_all">
				<p>Wszystkie zgłoszenia</p>

					<?php
						$sql_get_data_ticket_all = "SELECT COUNT(id) as all_ticket FROM ticket";
						$sql_result_ticket_all = mysqli_query($db_connection,$sql_get_data_ticket_all);
						$row = mysqli_fetch_array($sql_result_ticket_all);
						echo '<h1 class="counter">'.$row['all_ticket'].'</h1>';
					?>			

			</div>	
		</div>
		
		<div class="col-sm-3">	
			<div class="ticket_unread">
				<p>Nieprzeczytane zgłoszenia</p>

					<?php
						$sql_get_data_ticket_unread = "SELECT COUNT(id) as ticket_unread FROM ticket where unread =1";
						$sql_result_ticket_unread = mysqli_query($db_connection,$sql_get_data_ticket_unread);
						$row = mysqli_fetch_array($sql_result_ticket_unread);
							echo '<h1 class="counter">'.$row['ticket_unread'].'</h1>';
					?>			

			</div>
		</div>
		
		<div class="col-sm-3">	
			<div class="ticket_in_progress">
				<p>Zgłoszenia w trakcie</p>

					<?php
						$sql_get_data_ticket_in_progress = "SELECT COUNT(id) as ticket_in_progress FROM ticket where unread <> 1 and closed <> 1";
						$sql_result_ticket_in_progress = mysqli_query($db_connection,$sql_get_data_ticket_in_progress);
						$row = mysqli_fetch_array($sql_result_ticket_in_progress);
							echo '<h1 class="counter">'.$row['ticket_in_progress'].'</h1>';
					?>			

			</div>
		</div>

		<div class="col-sm-3">
			<div class="ticket_closed">
				<p>Zamknięte zgłoszenia</p>

					<?php
						$sql_get_data_ticket_closed = "SELECT COUNT(id) as ticket_closed FROM ticket where closed =1";
						$sql_result_ticket_closed = mysqli_query($db_connection,$sql_get_data_ticket_closed);
						$row = mysqli_fetch_array($sql_result_ticket_closed);
						echo '<h1 class="counter">'.$row['ticket_closed'].'</h1>';
					?>		

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<div class="ticket_all">
				<button class="accordion">
					<p>Wszystkie zgłoszenia</p>
					<?php
						$sql_get_data_ticket_all = "SELECT COUNT(id) as all_ticket FROM ticket";
						$sql_result_ticket_all = mysqli_query($db_connection,$sql_get_data_ticket_all);
						$row = mysqli_fetch_array($sql_result_ticket_all);
						echo '<h1 class="counter">'.$row['all_ticket'].'</h1>';
					?>
				</button>		
				<div class="panel">
					<?php
						$sql_get_data_ticket_all = "SELECT ticket_number FROM ticket";
						$sql_result_ticket_all = mysqli_query($db_connection,$sql_get_data_ticket_all);
						$row = mysqli_fetch_array($sql_result_ticket_all);
						while ($row = mysqli_fetch_array($sql_result_ticket_all))
						{
						echo '<p>'.$row['ticket_number'].'</p>';
						}
					?>
				</div>		
			</div>	
		</div>
	</div>

</div>

<script src="js/jquery.counterup.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script>
	jQuery(document).ready(function( $ )
	{
		$('.counter').counterUp({
   		delay: 10,
    	time: 750
		});
	});
</script>

<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
		panel.style.maxHeight = null;
		} else {
		panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
	}
</script>



</body>
</html>