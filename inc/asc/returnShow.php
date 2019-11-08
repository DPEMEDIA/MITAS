<?php
include("config.php");
include("functions.php");
// =================================================
$row = MysqlArray(MysqlSelect("SELECT * FROM ms_returns WHERE returnid = '".MysqlEscape($_POST["getReturnId"])."'"));
?>
<div class="modal fade" id="ttt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body mb-0 p-0">
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="inc/asc/returnForm.php?retour=<?php echo $row["returnid"]; ?>" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</div>
