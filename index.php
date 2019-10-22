<?php
// Load Config
require_once("inc/config.php");
// Load Functions
require_once("inc/functions.php");
?>
<!doctype html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="David Kovac">
		<title>Mitarbeitersystem - We Vape together!</title>
		<meta name="description" content="Mitarbeitersystem">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap-treeview.css">
		<link rel="stylesheet" href="css/bootstrap-datepicker.css">
		<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon">
		<link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
		<link rel="stylesheet" href="css/standard.css">
	</head>
	<body>
		<?php
		// User is logged in.
		if(checkLogin()) {
			require_once("inc/page/navi.php");
		}
		?>
		<!-- Jumbotron -->
		<div class="jumbotron d-flex align-items-center min-vh-100">
		<!-- Container -->
		<div class="container">
			<!-- Content -->
			<div class="row">
				<?php
				// Set User to logout.
				checkLogout();
				?>
				<div class="col-md-12">
					<?php
					// Is User not logged in?
					if(!checkLogin()) {
					?>
						<div class="col-md-6 offset-md-3">
							<div class="card">
								<div class="card-body">
									<div class="text-center">
										<a href=""><img src="img/dplogo.png" width="200" height="175" alt="Dampferpyramide" title="Dampferpyramide" class="img-responsive"></a>
									</div>
									<h3 class="mt-3 text-center">Mitarbeitersystem</h3>
									<br>
									<div id="checkLoginError"></div>
									<form method="POST" name="login" id="loginForm">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" placeholder="Benutzer" minlength="1" maxlength="32" class="form-control" id="username" name="username">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></span>
												</div>
												<input type="password" placeholder="Kennwort" minlength="1" maxlength="32" class="form-control" id="password" name="password">
											</div>
										</div>
										<button type="submit" class="btn btn-block btn-primary">Anmelden</button>
									</form>
								</div>
							</div>
						</div>
					<?php
					} else {
						require_once("inc/includer.php");
					}
					?>
				</div>
			</div>
			<!-- Footer -->
			<div class="row footer">
				<div class="col-md-12">
				<div class="col-md-6 mt-4 mb-4 text-center text-white offset-md-3">
					<small><?php echo $Server->version; ?> &copy; <?php echo date("Y"); ?> <a href="https://www.blackhack.at/" target="_blank">Black Hack</a> &centerdot; <a href="https://www.dampferpyramide.at/" target="_blank">Dampferpyramide</a> &centerdot; Alle Rechte vorbehalten.</small>
				</div>
				</div>
			</div>
		</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap-treeview.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/bootstrap-datepicker.de.js"></script>
		<script src="js/functions.js"></script>
	</body>
</html>
