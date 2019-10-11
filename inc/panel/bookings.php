<!-- BOOKING -->
<div class="row">
<div class="col-md-12 mt-4">
<div class="card">
<div class="card-header bg-main">
<i class="fas fa-list"></i> Übersicht der Reservierungen
</div>
<div class="card-body">
<?php
$getReturns = MysqlSelect("SELECT * FROM `ms_booking` WHERE `storeid` = '1' ORDER BY `bookingid` ASC LIMIT 25");
if(MysqlNumRow($getReturns))
{
?>
<div class="table-responsive table-list">
<table class="table table-bordered table-hover table-striped mb-0">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">Datum</th>
<th scope="col">Vorname</th>
<th scope="col">Nachname</th>
<th scope="col">E-Mail</th>
<th scope="col">Telefon</th>
<th scope="col">Artikel</th>
<th scope="col">Status</th>
</tr>
</thead>
<tbody>
<?php
$getReturns = MysqlSelect("SELECT * FROM `ms_booking` WHERE `storeid` = '1' ORDER BY `bookingid` ASC LIMIT 25");
while($getReturnsData = MysqlAssoc($getReturns))
{
?>
<tr onclick="window.location='index.php'">
<th scope="row"><?php echo $getReturnsData["bookingid"]; ?></th>
<td><?php echo date("d.m.Y", strtotime($getReturnsData["date"])); ?></td>
<td><?php echo $getReturnsData["firstname"]; ?></td>
<td><?php echo $getReturnsData["lastname"]; ?></td>
<td><?php echo $getReturnsData["email"]; ?></td>
<td><?php echo $getReturnsData["telefon"]; ?></td>
<td><?php echo $getReturnsData["product"]; ?></td>
<td><?php echo $getReturnsData["status"]; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<?php
}
else
{
?>
<b>Keine Einträge vorhanden.</b>
<?php
}
?>
</div>
</div>
</div>
</div>