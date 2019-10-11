<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom py-0">
	<a class="navbar-brand" href="">Mitarbeitersystem</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbar-toggle">
		<!-- Left Navigation -->
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item<?php if($_GET["include"] == null) { echo " active"; } ?>">
				<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Dashboard <span class="sr-only">(current)</span></a>
			</li>
            <li class="nav-item<?php if($_GET["include"] == "kis") { echo " active"; } ?>">
				<a class="nav-link" href="index.php?include=kis"><i class="fas fa-desktop"></i> KIS</a>
			</li>
			<li class="nav-item<?php if($_GET["include"] == "returns") { echo " active"; } ?>">
				<a class="nav-link" href="index.php?include=returns"><i class="fas fa-tasks"></i> Retouren</a>
			</li>
			<li class="nav-item<?php if($_GET["include"] == "bookings") { echo " active"; } ?>">
				<a class="nav-link" href="index.php?include=bookings"><i class="fas fa-ticket-alt"></i> Reservierungen</a>
			</li>
			<li class="nav-item<?php if($_GET["include"] == "mixtable") { echo " active"; } ?>">
				<a class="nav-link" href="index.php?include=mixtable"><i class="fas fa-table"></i> Mischtabelle</span></a>
			</li>
		</ul>
		<!-- Right Navigation -->
		<ul class="navbar-nav mt-2 mt-lg-0">
			<!-- Account -->
			<li class="nav-item dropdown<?php if($_GET["include"] == "settings") { echo " active"; } ?>">
				<a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-menu-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user"></i> <?php echo getUserData("username"); ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbar-dropdown-menu-link">
					<a class="dropdown-item" href="javascript:void(0);" onclick="checkLogout();"><i class="fas fa-sign-out-alt"></i> Abmelden</a>
				</div>
			</li>
			<!-- Social Media -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-menu-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fab fa-medium-m"></i> Social Media
				</a>
				<div class="dropdown-menu" aria-labelledby="navbar-dropdown-menu-link">
					<h6 class="dropdown-header">Black Hack</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="https://twitter.com/blackhackflavor/" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
					<a class="dropdown-item dropdown-item-deactived" href="#"><i class="fab fa-youtube"></i> Youtube</a>
					<a class="dropdown-item dropdown-item-deactived" href="#"><i class="fab fa-google-plus"></i> Google+</a>
					<a class="dropdown-item" href="https://www.facebook.com/blackhackworldwide/" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
					<a class="dropdown-item" href="https://www.instagram.com/blackhackworldwide/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
					<div class="dropdown-divider"></div>
					<h6 class="dropdown-header">Dampferpyramide</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="https://twitter.com/dampferpyramide/" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
					<a class="dropdown-item dropdown-item-deactived" href="#"><i class="fab fa-youtube"></i> Youtube</a>
					<a class="dropdown-item dropdown-item-deactived" href="#"><i class="fab fa-google-plus"></i> Google+</a>
					<a class="dropdown-item" href="https://www.facebook.com/dampferpyramide/" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
					<a class="dropdown-item" href="https://www.instagram.com/dampferpyramide/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
				</div>
			</li>
			<!-- Additional Links -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-menu-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-external-link-alt"></i> Externe Links
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-menu-link">
					<a class="dropdown-item" href="http://dampferpyramide.info/" target="_blank"><i class="fas fa-link"></i> Infoseite</a>
					<a class="dropdown-item" href="https://www.blackhack.at/" target="_blank"><i class="fas fa-link"></i> Black Hack</a>
					<a class="dropdown-item" href="https://www.dampferpyramide.at/" target="_blank"><i class="fas fa-link"></i> Dampferpyramide</a>
					<a class="dropdown-item" href="http://www.mitarbeiter.dampferpyramide.at/" target="_blank"><i class="fas fa-link"></i> Mitarbeitersystem</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
