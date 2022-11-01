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

$modal=$_SESSION['laporan']['modal'];
$prive=$_SESSION['laporan']['prive'];
$labarugi=$_SESSION['laporan']['labarugi'];
$modalakhir=$_SESSION['laporan']['modalakhir'];


$header='<h1 align="center" style="margin:0px">'.$judul.'</h1>';
$header=$header.'<h4 align="center" style="margin:0px"> Unit : '.$unit.' </h4>';
$periode='<p align="center" style="margin:0px"> Periode : '.$periode.'</p><h1>';

$isi='';
$isi=$isi.'<table id="" class="table table-bordered table-hover">';
$isi=$isi.'<tbody>';
$isi=$isi.'<tr>';
$isi=$isi.'<th width="50%"> Modal di setor </th>';
$isi=$isi.'<th>'.number_format($modal,0).'</th>';
$isi=$isi.'</tr>';
$isi=$isi.'<tr>';
$isi=$isi.'<th width="50%"> Prive </th>';
$isi=$isi.'<th>'.number_format($prive,0).'</th>';
$isi=$isi.'</tr>';
$isi=$isi.'<tr>';
$isi=$isi.'<th width="50%"> Laba / Rugi Bersih </th>';
$isi=$isi.'<th>'.number_format($labarugi,0).'</th>';
$isi=$isi.'</tr>';
$isi=$isi.'<tr>';
$isi=$isi.'<th width="50%"> Modal Akhir </th>';
$isi=$isi.'<th>'.number_format($modalakhir,0).'</th>';
$isi=$isi.'</tr>';
$isi=$isi.'</tbody>';
$isi=$isi.'</table>';


//echo $style.$header.$periode.$isi;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($style.$header.$periode.$isi);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$filename = "Laporan_Perubaan_modal".date("Y-m-d_H-i-s");
$dompdf->stream($filename);
?>