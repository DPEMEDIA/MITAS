<?php
include("config.php");
// =================================================
$Response = (object) array(
	'error' => false,
	'grund' => 'none',
	'revert' => false,
);

// RETURN
if($_POST["state"] != "" && !empty($_POST["firstname"]) && !empty($_POST["surname"])
	&& !empty($_POST["bonnr"])	&& !empty($_POST["bondate"])
	&& !empty($_POST["product"]) && !empty($_POST["comment"])) {



		if($_POST["noemail"] == false && $_POST["nophone"] == false) {

				if(!empty($_POST["email"]) && !empty($_POST["telefon"])) {
					$Response->revert = true;
				} else {
					$Response->error = true;
					$Response->grund = 'empty emtel';
				}


		} else {
			if($_POST["noemail"] == false && $_POST["nophone"] == true) {
				if(!empty($_POST["email"])) {
					$Response->revert = true;
				} else {
					$Response->error = true;
					$Response->grund = 'empty email';
				}
			}

			if($_POST["noemail"] == true && $_POST["nophone"] == false) {
				if(!empty($_POST["telefon"])) {
					$Response->revert = true;
				} else {
					$Response->error = true;
					$Response->grund = 'empty telefon';
				}
			}

			if($_POST["noemail"] == true && $_POST["nophone"] == true) {
				$Response->revert = true;
			}
		}



} else {
	$Response->error = true;
	$Response->grund = 'empty';
}


// GET RETURNS
if(!empty($_POST["getReturnId"])) {
// $Response->getRowReturn = true;
$row = MysqlArray(MysqlSelect("SELECT * FROM ms_returns WHERE returnid = '".MysqlEscape($_POST["getReturnId"])."'"));
$rowUser = MysqlArray(MysqlSelect("SELECT * FROM ms_users WHERE userid = '".MysqlEscape($row["userid"])."'"));
?>
<!-- EDIT RETURN - MODAL -->
<div class="modal fade" id="ttt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-edit"></i> Retour bearbeiten</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="POST" name="return" id="returnForm">
<div class="modal-body">
<div id="checkReturnError"></div>
<p><b>Infos</b></p>
<div class="row">
<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<label class="input-group-text" for="status"><i class="fas fa-info-circle"></i></label>
</div>
<select class="custom-select" id="status">
<option <?php if(empty($row["status"])) { echo "selected='selected'"; } ?> disabled>Status</option>
<option disabled>==================</option>
<option value="Offen" <?php if($row["status"] == "Offen") { echo "selected='selected'"; } ?>>Offen</option>
<option value="Ausgetauscht" <?php if($row["status"] == "Ausgetauscht") { echo "selected='selected'"; } ?>>Ausgetauscht</option>
<option value="Abgeschlossen" <?php if($row["status"] == "Abgeschlossen") { echo "selected='selected'"; } ?>>Abgeschlossen</option>
<option value="In Bearbeitung" <?php if($row["status"] == "In Bearbeitung") { echo "selected='selected'"; } ?>>In Bearbeitung</option>
<option value="Kein Rückmeldung" <?php if($row["status"] == "Kein Rückmeldung") { echo "selected='selected'"; } ?>>Kein Rückmeldung</option>
<option disabled>==================</option>
</select>
</div>
</div>
<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-calendar"></i></span>
</div>
<span class="form-control"><?php echo date("d.m.Y", strtotime($row["dateofreturn"])); ?></span>
</div>
</div>
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-user-circle"></i></span>
</div>
<span class="form-control"><?php if($rowUser["username"] != "Admin") { echo $rowUser["firstname"]." ".$rowUser["lastname"]; } else { echo "Administrator"; } ?></span>
</div>
</div>
</div>
<p><b>Kunde</b></p>
<!-- BEGIN -->
<div class="row">
<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-user"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["firstname"]; ?>" placeholder="Vorname" aria-label="Vorname" maxlength="24" id="firstname" name="firstname">
</div>


</div>
<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="far fa-user"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["lastname"]; ?>" placeholder="Nachname" aria-label="Nachname" maxlength="24" id="lastname" name="lastname">
</div>

</div>
<!-- END -->

<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-at"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["email"]; ?>" placeholder="E-Mail" aria-label="E-Mail" maxlength="64" id="email" name="email">
</div>

</div>
<div class="form-group col-md-3">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-phone"></i></span>
</div>
<input type="tel" class="form-control" value="<?php echo $row["telefon"]; ?>" placeholder="+43" aria-label="Telefon" maxlength="16" id="telefon" name="telefon">
</div>

</div>
<!-- END -->
</div>

<div class="row">
<div id="checkAddReturnFirstname"></div>
<div id="checkAddReturnSurname"></div>
<div id="checkAddReturnEmail"></div>
</div>

<p><b>Artikel</b></p>
<!-- BEGIN -->
<div class="row">
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-list-ol"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["bonnumber"]; ?>" placeholder="BON-Nr." aria-label="BON-Nr." maxlength="8" id="bonnr" name="bonnr">
</div>

<div id="checkAddReturnBonnr"></div>

</div>
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo date("d.m.Y", strtotime($row["bondate"])); ?>" placeholder="TT.MM.JJJJ" aria-label="BON-Datum" maxlength="10" data-provide="datepicker" data-date-language="de" id="bondate" name="bondate">
</div>

<div id="checkAddReturnBondate"></div>

</div>

<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-box"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["product"]; ?>" placeholder="Artikel" aria-label="Artikel" maxlength="50" id="product" name="product">
</div>

<div id="checkAddReturnProduct"></div>

</div>
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-comment"></i></span>
</div>
<input type="text" class="form-control" value="<?php echo $row["comment"]; ?>" placeholder="Kommentar" aria-label="Kommentar" maxlength="50" id="comment" name="comment">
</div>

<div id="checkAddReturnComment"></div>

</div>
</div>
<div class="modal-footer" style="display:block !important;">
<div class="btn-group d-flex" role="group" aria-label="Retour anlegen">
<button type="submit" class="btn btn-success w-100">Retour bearbeiten</button>
<button type="reset" class="btn btn-danger w-100">Zurücksetzen</button>
</div>
</div>

</form>

</div>
</div>
</div>
<?php
}

if(!$_POST["getReturnId"])
	// echo base64_encode(json_encode($Response));
	echo json_encode($Response);
// =================================================
?>
