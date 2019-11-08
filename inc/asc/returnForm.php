<?php
// Session starten
session_start();
if($_SESSION["userid"] == true)
{
	require_once('config.php');
    require_once('functions.php');
    require_once('fpdf/fpdf.php');
    require_once('fpdi/fpdi.php');

	$retour = $_GET["retour"];

	$query = MysqlSelect("SELECT * FROM `ms_returns` WHERE `returnid` = '".$retour."'");
	while($row = MysqlAssoc($query))
	{
        $userRow = MysqlArray(MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".getUserData($_SESSION["userid"])."'"));

		// FPDI
		$pdf = new Fpdi();

		// Füge eine Seite hinzu
		$pdf->AddPage();

		// Wähle die Quelle der Seite
		$pdf->setSourceFile('returnForm.pdf');

		// Importieren der Seite von der Quelle
		$tplIdx = $pdf->importPage(1);

		$pdf->useTemplate($tplIdx, 0, 0, 0, 0);

		// Die Seite mit den verschiedenen Variabellen beschreiben
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(80, 73);
		$pdf->Write(0, iconv('UTF-8', 'windows-1252', html_entity_decode($row["firstname"])));

		$pdf->SetXY(80, 82.5);
		$pdf->Write(0, $row["lastname"]);

		$pdf->SetXY(80, 92);
		$pdf->Write(0, $row["telefon"]);

		$pdf->SetXY(80, 101);
		$pdf->Write(0, utf8_decode($row["email"]));

		$pdf->SetXY(80, 131.5);
		$pdf->Write(0, $userRow["firstname"]);

		$pdf->SetXY(80, 140.5);
		$pdf->Write(0, $row["bonnumber"]);

		$pdf->SetXY(80, 149.75);
		$pdf->Write(0, utf8_decode($row["product"]));

		$pdf->SetXY(150.5, 131.5);
		$pdf->Write(0, date("d.m.Y", strtotime($row["dateofreturn"])));

		$pdf->SetXY(150.5, 140.5);
		$pdf->Write(0, date("d.m.Y", strtotime($row["bondate"])));

		$pdf->SetXY(25.5, 165.5);
		$pdf->MultiCell(158, 5, iconv('UTF-8', 'windows-1252', html_entity_decode($row["comment"])), 0);

        // REMOVE OLD
		$pdf->SetXY(80, 216.5);
		$pdf->Write(0, "NOTHING");

		$pdf->Output();
	}
}
?>
