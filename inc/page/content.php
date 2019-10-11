<!-- Welcome -->
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-info"></i> We Vape together!
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier wird eine Willlkommensnachricht angezeigt."></i></span>
			</div>
			<div class="card-body">
				<p class="card-text">
					<?php welcome(); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<!-- Store -->
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-store"></i> Filiale
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier wird deine Filiale angezeigt."></i></span>
			</div>
			<div class="card-body">
				<p class="card-text">
					<h1 class="text-center">
					<?php
					$getStore = MysqlArray(MysqlSelect("SELECT * FROM `ms_stores` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."'"));
					echo $getStore["name"];
					?>
					</h1>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<!-- Date -->
	<div class="col-md-6 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-calendar-alt"></i> Datum
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier wird das Datum angezeigt."></i></span>
			</div>
			<div class="card-body">
				<p class="card-text">
					<h1 class="text-center"><?php echo strftime("%A").", ".date("d").". ". strftime("%B")." ".date("Y"); ?></h1>
				</p>
			</div>
		</div>
	</div>
	<!-- Time -->
	<div class="col-md-6 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-clock"></i> Uhrzeit
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier wird die aktuelle Uhrzeit angezeigt."></i></span>
			</div>
			<div class="card-body">
				<p class="card-text">
					<h1 id="clock" class="text-center"></h1>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<!-- Returns -->
	<div class="col-md-6 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-tasks"></i> Retouren
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier werden die Retouren deiner Filiale angezeigt."></i></span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-dashboard table-bordered table-striped mb-0">
						<thead>
							<tr>
								<th scope="col">Retouren</th>
								<th scope="col">Anzahl</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Insg.</th>
								<td>
								<?php
								$getTotalReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."'"));
								echo $getTotalReturns["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Offen</th>
								<td>
								<?php
								$getOpenReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Offen'"));
								echo $getOpenReturns["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Ausgetauscht</th>
								<td>
								<?php
								$getReplaceReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Ausgetauscht'"));
								echo $getReplaceReturns["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">In Bearbeitung</th>
								<td>
								<?php
								$getProgressReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'In Bearbeitung'"));
								echo $getProgressReturns["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Abgeschlossen</th>
								<td>
								<?php
								$getSuccessReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Abgeschlossen'"));
								echo $getSuccessReturns["sum"];
								?>
								</td>
							</tr>
							<tr>
							<th scope="row">Keine Rückmeldung</th>
								<td>
								<?php
								$getNoRespondReturns = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Keine Rückmeldung'"));
								echo $getNoRespondReturns["sum"];
								?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Booking -->
	<div class="col-md-6 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-ticket-alt"></i> Reservierungen
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier werden deine Reservierung deiner Filiale angezeigt."></i></span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-dashboard table-bordered table-striped mb-0">
						<thead>
							<tr>
							<th scope="col">Reservierungen</th>
							<th scope="col">Anzahl</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Insg.</th>
								<td>
								<?php
								$getTotalBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."'"));
								echo $getTotalBooking["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Offen</th>
								<td>
								<?php
								$getOpenBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Offen'"));
								echo $getOpenBooking["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Benachrichtigt</th>
								<td>
								<?php
								$getReplaceBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Ausgetauscht'"));
								echo $getReplaceBooking["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Wiederkehrend</th>
								<td>
								<?php
								$getSuccessBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Wiederkehrend'"));
								echo $getSuccessBooking["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Abgeschlossen</th>
								<td>
								<?php
								$getProgressBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'In Bearbeitung'"));
								echo $getProgressBooking["sum"];
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">Keine Rückmeldung</th>
								<td>
								<?php
								$getSuccessBooking = MysqlArray(MysqlSelect("SELECT COUNT(*) AS `sum` FROM `ms_booking` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' AND `status` = 'Abgeschlossen'"));
								echo $getSuccessBooking["sum"];
								?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<!-- Account Informations -->
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-user"></i> Kontoinformationen
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier werden Informationen deines Kontos angezeigt."></i></span>
			</div>
			<div class="card-body">
				<?php
				$getUserInfo = MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'");
				if(MysqlNumRow($getUserInfo)) {
				?>
				<div class="table-responsive">
					<table class="table table-dashboard table-bordered table-striped mb-0">
						<thead>
							<tr>
								<th scope="col">Bezeichnung</th>
								<th scope="col">Daten</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Letzte Anmeldung</th>
								<td><?php echo strftime("%d.%m.%Y, %H:%M:%S", strtotime(getUserData("lastlogin"))); ?></td>
							</tr>
							<tr>
								<th scope="row">Loginversuche</th>
								<td><?php echo getUserData("loginattempts"); ?></td>
							</tr>
							<tr>
								<th scope="row">Retouren</th>
								<td><?php echo getUserData("returns"); ?></td>
							</tr>
							<tr>
								<th scope="row">Reservierungen</th>
								<td><?php echo getUserData("booking"); ?></td>
							</tr>
							<tr>
								<th scope="row">IP Adresse</th>
								<td><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
							</tr>
							<tr>
								<th scope="row">Browser</th>
								<td><?php echo $_SERVER["HTTP_USER_AGENT"]; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php
				} else {
				?>
				<b>Informationen nicht verfügbar.</b>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>