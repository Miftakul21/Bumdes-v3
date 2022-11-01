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
$sql=$_SESSION['laporan']['sql'];
$sql1=$_SESSION['laporan']['sql1'];


$header='<h1 align="center" style="margin:0px">'.$judul.'</h1>';
$header=$header.'<h4 align="center" style="margin:0px"> Unit : '.$unit.' </h4>';
$periode='<p align="center" style="margin:0px"> Periode : '.$periode.'</p><h1>';
$isi='';
$query      = $sql;
$result     = $mysqli->query($query);
$num_result = $result->num_rows;
if ($num_result > 0) {
while ($data = mysqli_fetch_assoc($result)) {
  extract($data);

$isi=$isi.'<table class="table table-bordered table-hover">
	    <thead>
	      <tr>
	        <th width="40%">'.$keterangan.'</th>
            <th width="20%">Debet</th>
            <th width="20%">Kredit</th>
            <th>#</th>
	      </tr>
	    </thead>
    <tbody>';
      $debetall=0;
      $kreditall=0;
	  $query1     = "SELECT * from tb_transaksi join tb_kegiatan using(id_kegiatan) where id_index =".$id_index.$sql1;
	  $resultz     = $mysqli->query($query1);
	  $num_resultz = $resultz->num_rows;
	  if ($num_resultz > 0) {

	    while ($dataz = mysqli_fetch_assoc($resultz)) {
	    	$debetall+=$dataz['debet'];
            $kreditall+=$dataz['kredit'];
	      	
	      	$isi=$isi.'<tr>';
	       	$isi=$isi.'<td>'.$dataz['keterangan'].'</td>';
	        $isi=$isi.'<td>'.number_format($dataz['debet'],0).'</td>';
	        $isi=$isi.'<td>'.number_format($dataz['kredit'],0).'</td>';
	      	$isi=$isi.'</tr>';
	    }
	}
	$isi=$isi.'<th colspan="3"></th>';
	$isi=$isi.' <th>'.number_format(($debetall-$kreditall),0).'</th>';

	$isi=$isi.'</tbody></table>';
	}
}

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