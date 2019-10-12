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
		<link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-treeview.css">
		<link rel="stylesheet" href="css/bootstrap-datepicker.css">
		<link rel="stylesheet" href="css/standard.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	</head>
	<body>
		<?php
		// User is logged in.
		if(checkLogin()) {
			require_once("inc/page/navi.php");
		}
		?>
		<!-- Content -->
		<div class="container h-100">
			<div class="row h-100 justify-content-md-center">
				<?php
				// Set User to logout.
				checkLogout();
				?>
				<div class="col-md-12 my-auto">
					<?php
					// Is User not logged in?
					if(!checkLogin()) {
					?>
					<div class="row justify-content-md-center">
						<div class="col-md-6 mt-4">
							<div class="card">
								<div class="card-body">
									<div class="text-center">
										<a href=""><img src="img/dplogo.png" width="200" height="175" alt="Dampferpyramide" title="Dampferpyramide" class="img-responsive"></a>
									</div>
									<h3 class="mt-3 text-center">Mitarbeitersystem</h3>
									<br>
									<div id="checkLoginError"></div>
									<form method="POST" name="login" id="loginForm" class="needs-validation" novalidate>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" placeholder="Benutzer" maxlength="16" class="form-control" id="username" name="username" required>
												<div class="valid-feedback"><i class="fas fa-check-circle"></i> Benutzer</div>
												<div class="invalid-feedback"><i class="fa fa-times-circle"></i> Benutzer</div>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></span>
												</div>
												<input type="password" placeholder="Kennwort" maxlength="16" class="form-control" id="password" name="password" required>
												<div class="valid-feedback"><i class="fas fa-check-circle"></i> Kennwort</div>
												<div class="invalid-feedback"><i class="fa fa-times-circle"></i> Kennwort</div>
											</div>
										</div>
										<button type="submit" class="btn btn-block btn-primary">Anmelden</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
					} else {
						require_once("inc/includer.php");
					}
					?>
					<!-- Footer -->
					<div class="row footer justify-content-md-center">
						<div class="col-md-6 mt-4 mb-4 text-center text-white">
							<?php echo $Server->version; ?> &copy; <?php echo date("Y"); ?> <a href="https://www.blackhack.at/" target="_blank">Black Hack</a> &centerdot; <a href="https://www.dampferpyramide.at/" target="_blank">Dampferpyramide</a> &centerdot; Alle Rechte vorbehalten.
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.bundle.js"></script>
        <script src="js/bootstrap-treeview.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/bootstrap-datepicker.de.js"></script>
		<script src="js/functions.js"></script>
	</body>
</html>
