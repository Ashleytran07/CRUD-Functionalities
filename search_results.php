<?php

$host = "303.itpwebdev.com";
$user = "ashleytt_db_user2";
$pass = "uscitp2023";
$db = "ashleytt_dvd_db";

	// Establish MySQL Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	$mysqli->set_charset('utf8');

	// Retrieve all genres from the DB.
	$sql = "SELECT dvd_titles.title AS title, genres.genre AS genre, ratings.rating AS rating, labels.label AS label,
			formats.format AS format, sounds.sound AS sound, release_date, dvd_title_id
				FROM dvd_titles
				LEFT JOIN genres
					ON dvd_titles.genre_id = genres.genre_id
				LEFT JOIN ratings
					ON dvd_titles.rating_id = ratings.rating_id
				LEFT JOIN labels
					ON dvd_titles.label_id = labels.label_id
				LEFT JOIN formats
				ON dvd_titles.format_id = formats.format_id
				LEFT JOIN sounds
				ON dvd_titles.sound_id = sounds.sound_id

				WHERE 1 = 1";
	// echo "<pre>";
	// var_dump($_GET);
	// echo "</pre>";

	if ( isset($_GET['title']) && trim($_GET['title']) != '' ) {
		$dvd_title = $_GET['title'];
		$sql = $sql . " AND dvd_titles.title LIKE '%$dvd_title%'";
	}

	if ( isset( $_GET['genre_id'] ) && trim( $_GET['genre_id'] ) != '' ) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND dvd_titles.genre_id = $genre_id";
	}

	if ( isset( $_GET['rating_id'] ) && trim( $_GET['rating_id'] ) != '' ) {
		$rating_id = $_GET['rating_id'];
		$sql = $sql . " AND dvd_titles.rating_id = $rating_id";
	}

	if ( isset( $_GET['label_id'] ) && trim( $_GET['label_id'] ) != '' ) {
		$label_id = $_GET['label_id'];
		$sql = $sql . " AND dvd_titles.label_id = $label_id";
	}
	
	if ( isset( $_GET['format_id'] ) && trim( $_GET['format_id'] ) != '' ) {
		$format_id = $_GET['format_id'];
		$sql = $sql . " AND dvd_titles.format_id = $format_id";
	}

	if ( isset( $_GET['sound_id'] ) && trim( $_GET['sound_id'] ) != '' ) {
		$sound_id = $_GET['sound_id'];
		$sql = $sql . " AND dvd_titles.sound_id = $sound_id";
	}


	//end sql
	$sql = $sql . ";";


	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}



	// Close MySQL Connection.
	$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

			Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results->fetch_assoc() ) : ?>
								<tr>
									<td>
										<a href="delete.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>&dvd_title=<?php echo $row['title']; ?>" 
										class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this DVD?');">
											Delete
										</a>
									</td>

									<td>
									<a href="details.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>">
										<?php echo $row['title']; ?>
									</a>
									</td>
									<td><?php echo $row['release_date']; ?></td>
									<td><?php echo $row['genre']; ?></td>
									<td><?php echo $row['rating']; ?></td>
								</tr>
							<?php endwhile; ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>