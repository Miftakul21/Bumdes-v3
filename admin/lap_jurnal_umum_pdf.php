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
$usaha=$_SESSION['laporan']['usaha'];
$sql=$_SESSION['laporan']['sql'];

$header='<h1 align="center" style="margin:0px">'.$judul.'</h1>';
$header=$header.'<h4 align="center" style="margin:0px"> Unit : '.$unit.' </h4>';
$header=$header.'<h4 align="center" style="margin:0px"> Jenis Usaha : '.$usaha.' </h4>';
$periode='<p align="center" style="margin:0px"> Periode : '.$periode.'</p><h1>';

$isi='<table class="table table-bordered table-hover">
	    <thead>
	      <tr>
	        <th>No Transaksi</th>
	        <th>Tanggal</th>
	        <th>Usaha</th>
	        <th>Keterangan</th>
	        <th>Kode Akun</th>
	        <th>Index</th>
	        <th>Debet</th>
	        <th>Kredit</th>
	        <th>Saldo</th>
	      </tr>
	    </thead>
    <tbody>';

      $saldo=0;
	  $query      = $sql;
	  $result     = $mysqli->query($query);
	  $num_result = $result->num_rows;
	  if ($num_result > 0) {

	    while ($data = mysqli_fetch_assoc($result)) {
	      extract($data);
	      $saldo+=$debet;
	      $saldo-=$kredit;

	      	$isi=$isi.'<tr>';
	       	$isi=$isi.'<td>'.$id_transaksi.'</td>';
	        $isi=$isi.'<td>'.tgl_indo($tanggal).'</td>';
	        $isi=$isi.'<td>'.$nama_kegiatan.'</td>';
	        $isi=$isi.'<td>'.$keterangan.'</td>';
	        $isi=$isi.'<td>'.$kode_akun.'</td>';
	        $isi=$isi.'<td>'.$id_index.'</td>';
	        $isi=$isi.'<td>'.number_format($debet,0).'</td>';
	        $isi=$isi.'<td>'.number_format($kredit,0).'</td>';
	        $isi=$isi.'<th>'.number_format($saldo,0).'</th>';
	      	$isi=$isi.'</tr>';
	    }
	}

$isi=$isi.'</tbody></table>';

//echo $style.$header.$periode.$isi;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($style.$header.$periode.$isi);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$filename = "Laporan_Jurnal_Umum_".date("Y-m-d_H-i-s");
$dompdf->stream($filename);
?>