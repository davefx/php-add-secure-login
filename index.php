<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>JSON / PHP Unserializer</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">JSON / PHP Unserializer</a>
</nav>
<div class="container pt-5">
	<form method="post" class="clearfix">
		<div class="form-group">
			<textarea name="input" class="form-control"
			          rows="10"><?= htmlentities( $_POST['input'] ?? '' ) ?></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-primary float-right" type="submit">Submit</button>
		</div>
	</form>
	<div class="clearfix">
		<?php
		if ( ! empty( trim( $_POST['input'] ?? '' ) ) ) {
			$input = trim( $_POST['input'] );
			?>
			<hr/>
			<h3>Result</h3>
			<pre><?php
				$found_results = false;

				// Try JSON decoding
				$structure = json_decode( $input );
				if ( json_last_error() == JSON_ERROR_NONE ) {
					// JSON
					echo json_encode( $structure, JSON_PRETTY_PRINT );
					$found_results = true;
				} else {
					// Let's try unserialize
					$structure = unserialize( $input, [ true ] );
					if ( $structure !== false ) {
						print_r( $structure );
						$found_results = true;
					}
				}
				if ( ! $found_results ) {
					echo "No valid serialized / JSON string was found";
				}
				?>
	</pre>
		<?php } ?>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
<?php

