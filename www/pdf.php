<?php
	require_once('tcpdf/examples/tcpdf_include.php');
	$vorname = $_GET['vorname'];
	$nachname = $_GET['nachname'];
	
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('SYD - GCFR');
	$pdf->SetTitle('Arbeitsvertrag '.$_GET['vorname'].' '.$_GET['nachname'].'');
	
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	$pdf->setFont('times', 'BI', 14);
	
	$pdf->AddPage();
	
	$html = <<<EOF
<style>
	div.text_center {
		font-family: times;
		font-size: 16pt;
		text-align: center;
	}
</style>
<div class="text_center"><img src="GCFRLogo.png" width="250px" style="align: center;"/><br />
Arbeitsvertrag<br />
zwischen dem<br />
<br />
<b>Gulfcoast County Fire Department</b><br />
ADRESSE<br />
(nachfolgend "GCFR" genannt)<br />
<br />
und<br />
<b>$nachname, $vorname</b><br />
(nachfolgend "Trainee" genannt)<br />
<br />
<b>wird folgender Arbeitsvertrag geschlossen:</b><br />
</div>
EOF;

	$pdf->writeHTML($html, true, false, true, false, '');
	
	$pdf->AddPage();
	
	$html = <<<EOF
<style>
	div.text {
		font-family: helvetica;
		font-size: 12pt;
		text-align: left;
	}
	
	h1 {
		color: navy;
		font-family: times;
		font-size: 18pt;
		text-decoration: underline;
	}
</style>
<h1>§1 Gegenstand des Vertrages</h1><br />
<div class="text">Gegenstand dieses Vertrages ist ein unbefristetes Vollzeitarbeitsverhältnis ohne Tarifbindung.<br /></div>
<br />
<h1>§2 Beginn des Arbeitsverhältnisses</h1><br />
<div class="text">Das Arbeitsverhältnis beginnt am. 0000-00-00 (jjjj-mm-dd). Es wird auf unbestimmte Zeit geschlossen.<br /></div>
<br />
<h1>§3 Probezeit</h1><br />
<ul>
	<li><div class="text"><b>3.1</b> Die erste Woche (7 Tage) des Arbeitsverhältnisses gelten als Probezeit.</div></li>
	<li><div class="text"><b>3.2</b> Während der Probezeit kann das Arbeitsverhältnis von jeder Vertragspartei ohne Angaben von Gründen ohne gesetzliche Kündigungsfrist schriftlich gekündigt werden.</div></li>
</ul><br />
<br />
<br />
EOF;
	
	$pdf->writeHTML($html, true, false, true, false, '');
	//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
	//$pdf->Write(0, $html, '', 0, 'C', true, 0, false, false, 0);
	
	$pdf->Output('Arbeitsvertrag '.$_GET['vorname'].'-'.$_GET['nachname'].'.pdf', 'I');
?>