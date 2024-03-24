<?php
	require "../includes/env.php";

	$phone = $_GET['phone'];

	$stmt = $pdo->prepare("select * from entries where from_number like ? order by ts asc");
	$stmt->execute(["%$phone"]);

	$dates = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$date = date('Y-m-d', $row['ts']);
		if(empty($dates[$date])) $dates[$date] = ['entries'=>[], 'avg'=>$row['rating']];
		$dates[$date]['entries'][] = $row;
		$dates[$date]['avg'] = ($dates[$date]['avg'] + $row['rating']) / 2;
	}

?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mood Sense - Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="./css/calendar.css" rel="stylesheet">
  </head>
  <body>
	<div></div>
    <script>const DATA = <?php echo json_encode($dates, JSON_PRETTY_PRINT); ?></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="./js/calendar.js"></script>
	<script src="./js/index.js"></script>
  </body>
</html>
