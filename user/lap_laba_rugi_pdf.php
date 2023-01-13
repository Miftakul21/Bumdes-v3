<?php
require_once "../setting/koneksi.php";
require_once "../dompdf/vendor/autoload.php";
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// komponen
$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];
$unit = $_GET['unit'];

$per1 = date_format(date_create($periode1), 'd-m-Y');
$per2 = date_format(date_create($periode2), 'd-m-Y');

// nama unit
$sql1 = "SELECT * FROM tb_unit WHERE id_unit = '$unit'";
$query1 = mysqli_query($mysqli,$sql1);
$data1 = mysqli_fetch_array($query1);

// Heading / Judul
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Laba Rugi ".$data1['nama_unit']."</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .="<br>";

// field name table 1
$sql1   = "SELECT * FROM tb_transaksi AS a JOIN tb_kegiatan AS b  ON a.`id_kegiatan` = b.`id_kegiatan` JOIN tb_akun 
            AS c ON a.`kode_akun` = c.`kode_akun` WHERE c.`kode_akun` LIKE '4-11%' AND (a.`tanggal` BETWEEN '$periode1' 
            AND '$periode2') AND b.`id_unit` = '$unit'";
$query1 = mysqli_query($mysqli, $sql1);

$html .= "<h5>Pendapatan</h5>";

$pendapatan = 0;
$temp1 = 0;

$html .="<table border='1' width='100%'>";
while($data1 = mysqli_fetch_array($query1)){
    $temp1 += $data1['debet'];
    $temp1 += $data1['kredit'];

    $pendapatan = $pendapatan + $temp1;

    $html .="
        <tr>
            <td>".$data1['kode_akun']."</td>
            <td>".$data1['nama_akun']."</td>
            <td>".$data1['keterangan_transaksi']."</td>
            <td>".number_format($temp1,0)."</td>
        </tr>";
}
$html .= "<th colspan='3' align='left'>Total Pendapatan</th>
        <th align='left'>".number_format($pendapatan,0)."</th>
        </table>";

$html .= "<br>";
$sql2   = "SELECT * FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.`id_kegiatan` = b.`id_kegiatan` JOIN tb_akun 
            AS c ON a.`kode_akun` = c.`kode_akun` WHERE c.`kode_akun` LIKE '5-11%' AND (a.`tanggal` BETWEEN '$periode1' 
            AND '$periode2') AND b.`id_unit` = '$unit'";
$query2 = mysqli_query($mysqli, $sql2);

$html .= "<h5>Pengeluaran</h5>";

$pengeluaran = 0;
$temp2 = 0;

$html .="<table border='1' width='100%'>";
while($data2 = mysqli_fetch_array($query2)){
    $temp2 += $data2['debet'];
    $temp2 += $data2['kredit'];

    $pengeluaran = $pengeluaran + $temp2;

    $html .="
        <tr>
            <td>".$data2['kode_akun']."</td>
            <td>".$data2['nama_akun']."</td>
            <td>".$data2['keterangan_transaksi']."</td>
            <td>".number_format($temp1,0)."</td>
        </tr>";
}
$html .= "<tr>
            <th colspan='3' align='left'>Total Pendapatan</th>
            <th align='left'>".number_format($pengeluaran,0)."</th>
        </tr>
        <tr>
            <th colspan='3' align='left'>Laba Rugi Bersih</th>
            <th align='left'>".number_format($pendapatan-$pengeluaran,0)."</th>
        </tr>
        </table>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));
?>