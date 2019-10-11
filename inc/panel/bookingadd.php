<!-- BOOKING ADD -->
<section class="forminput">
<div class="row">
<div class="col-md-12 mt-4">
<div class="card">
<div class="card-header bg-main">
<i class="fas fa-plus-square"></i> Reservierung anlegen
</div>
<div class="card-body">
<form action="index.php" method="POST">
<p><b>Infos</b></p>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<label class="input-group-text" for="status">Status</label>
</div>
<select class="custom-select" id="status">
<option selected>Auswahl</option>
<option>=========================</option>
<option value="Offen">Offen</option>
<option value="Wiederkehrend">Wiederkehrend</option>
<option>=========================</option>
</select>
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Datum</span>
</div>
<span class="form-control"><?php echo date("d.m.Y"); ?></span>
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Verkäufer</span>
</div>
<span class="form-control">...</span>
</div>
</div>
<p><b>Kunde</b></p>
<!-- BEGIN -->
<div class="row">
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Vorname</span>
</div>
<input type="text" class="form-control" placeholder="..." aria-label="Vorname" maxlength="32">
</div>
</div>
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Nachname</span>
</div>
<input type="text" class="form-control" placeholder="..." aria-label="Nachname" maxlength="32">
</div>
</div>
<!-- END -->
</div>
<!-- BEGIN -->
<div class="row">
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">E-Mail</span>
</div>
<input type="text" class="form-control" placeholder="..." aria-label="E-Mail" maxlength="32">
</div>
</div>
<div class="form-group col-md-6">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Telefon</span>
</div>
<input type="tel" class="form-control" placeholder="..." aria-label="Telefon" maxlength="32">
</div>
</div>
<!-- END -->
</div>
<p><b>Artikel</b></p>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Artikel</span>
</div>
<input type="text" class="form-control" placeholder="...." aria-label="Artikel" maxlength="50">
</div>
</div>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Kommentar</span>
</div>
<input type="text" class="form-control" placeholder="..." aria-label="Kommentar" maxlength="50">
</div>
</div>
<div class="btn-group d-flex" role="group" aria-label="Reservierung anlegen">
<button type="submit" class="btn btn-success w-100">Reservierung anlegen</button>
<button type="reset" class="btn btn-danger w-100">Abbrechen</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>