<?php

if ( !isset($_POST['dvd_title']) || trim($_POST['dvd_title']) == ''){
	$error = "Please fill out all required fields.";
}else {

	$host = "303.itpwebdev.com";
	$user = "ashleytt_db_user2";
	$pass = "uscitp2023";
	$db = "ashleytt_dvd_db";

	// DB Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$dvd_title = $_POST['title'];
	$genre_id = $_POST['genre_id'];
	$format_id = $_POST['format_id'];
	$sound_id = $_POST['sound_id'];
	$label_id = $_POST['label_id'];
	$rating_id = $_POST['rating_id'];


	// $bytes = 1 OR null
	if ( isset($_POST['award']) && trim($_POST['award']) != '' ) {
		$award = $_POST['award'];
	} else {
		$award = "null";
	}

	$sql = "INSERT INTO dvd_titles (title, genre_id, label_id, sound_id, format_id, rating_id, award)
					VALUES ('$track_name', $media_type_id, $genre_id, $milliseconds, $price, $album_id, $composer, $bytes);";

	// echo "<hr>$sql<hr>";

	$results = $mysqli->query($sql);

	if (!$results) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}


	// Close MySQL Connection.
	$mysqli->close();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<!-- <div class="text-danger font-italic">Adding DVD was unsuccessful</div>

				<div class="text-success"><span class="font-italic">Display Title Here</span> was successfully added.</div> -->

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger">
						<!-- Show Error Messages Here. -->
						<?php echo $error; ?>
					</div>

					<?php else : ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $dvd_title; ?></span> was successfully added.
					</div>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Go to Search Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>