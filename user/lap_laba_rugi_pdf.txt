<?php
//error_reporting(0);
session_start();
// include autoloader
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

require_once '../dompdf/autoload.inc.php';
require_once '../dompdf/style.php';

use Dompdf\Dompdf;

$style=f_bootsrap();
$judul=$_SESSION['laporan']['judul'];
$periode=$_SESSION['laporan']['periode'];
$unit=$_SESSION['laporan']['unit'];
$sql1=$_SESSION['laporan']['sql1'];
$sql2=$_SESSION['laporan']['sql2'];


$header='<h1 align="center" style="margin:0px">'.$judul.'</h1>';
$header=$header.'<h4 align="center" style="margin:0px"> Unit : '.$unit.' </h4>';
$periode='<p align="center" style="margin:0px"> Periode : '.$periode.'</p><h1>';
$isi='';

$isi=$isi.'<h3>Pendapatan</h3><table class="table table-bordered table-hover">';

$kreditall=0;
$query      = $sql1;

$resultz     = $mysqli->query($query);
$num_resultz = $resultz->num_rows;
if ($num_resultz > 0) {

	while ($dataz = mysqli_fetch_assoc($resultz)) {
		$kreditall+=$dataz['kredit'];
		$isi=$isi.'<tr><td width="10%">'.$dataz['kode_akun'].'</td>';
		$isi=$isi.'<td width="50%">'.$dataz['nama_akun'].'</td>';
		$isi=$isi.'<td width="20%">'.number_format($dataz['kredit'],0).'</td></tr>';
	}}
	$isi=$isi.'<th colspan="3">Total Pendapatan</th>';
	$isi=$isi.'<th>'.number_format(($kreditall),0).'</th>';
	$isi=$isi.'</tbody></table>';

	$isi=$isi.'<h3>Pengeluaran</h3><table class="table table-bordered table-hover">';

	$debetall=0;
	$queryz      = $sql2;
	$resultz     = $mysqli->query($queryz);
	$num_resultz = $resultz->num_rows;
	if ($num_resultz > 0) {

		while ($dataz = mysqli_fetch_assoc($resultz)) {
			$debetall+=$dataz['debet'];
			$isi=$isi.'<tr><td width="10%">'.$dataz['kode_akun'].'</td>';
			$isi=$isi.'<td width="50%">'.$dataz['nama_akun'].'</td>';
			$isi=$isi.'<td width="20%">'.number_format($dataz['debet'],0).'</td></tr>';
		}}
		$isi=$isi.'<tr><th colspan="3">Total Pengeluaran</th>';
		$isi=$isi.'<th>'.number_format(($debetall),0).'</th></tr>';
		$isi=$isi.'<tr><th colspan="3">Laba Rugi Berish</th>';
		$isi=$isi.'<th>'.number_format(($kreditall-$debetall),0).'</th></tr>';
		$isi=$isi.'</tbody></table>';

//		echo $style.$header.$periode.$isi;

// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($style.$header.$periode.$isi);

// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
		$dompdf->render();

// Output the generated PDF to Browser
		$filename = "Laporan_Laba_Rugi_".date("Y-m-d_H-i-s");
$dompdf->stream($filename);
		?>