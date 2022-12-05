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
$sql1 = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_akun USING(kode_akun) WHERE tb_akun.kode_akun LIKE '4%' AND id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
$query1 = mysqli_query($mysqli, $sql1);

$html .= "<h5>Pendapatan</h5>";

$kreditall = 0;
while($data1 = mysqli_fetch_array($query1)){
    $kreditall += $data1['kredit'];
    $html .= "<table border='1' width='100%'>
        <tr>
            <td width='10%'>".$data1['kode_akun']."</td>
            <td width='60%'>".$data1['nama_akun']."</td>
            <td width='30%'>".number_format($data1['kode_akun'],0)."</td>
        </tr>
        <tr>
            <th colspan='3' style='text-align: left;'>Total Pendapatan</th>
            <th>".number_format($kreditall,0)."</th>
        </tr>
    ";
}

$html .= "</table><br>";

$sql2 = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_akun USING(kode_akun) WHERE tb_akun.kode_akun LIKE '5%' AND id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
$query2 = mysqli_query($mysqli, $sql2);

$html .= "<h5>Pengeluaran</h5>";
$debetall = 0;
while($data2 = mysqli_fetch_array($query2)){
    $debetall += $data1['debet'];
    $html .= "<table border='1' width='100%'>
        <tr>
            <td width='10%'>".$data1['kode_akun']."</td>
            <td width='60%'>".$data1['nama_akun']."</td>
            <td width='30%'>".number_format($data1['kode_akun'],0)."</td>
        </tr>
        <tr>
            <th colspan='3' style='text-align: left;'>Total Pengeluaran</th>
            <th>".number_format($debetall,0)."</th>
        </tr>
        <tr>
            <th colspan='3' style='text-align: left;'>Laba Rugi Bersih</th>
            <th>".number_format($kreditall-$debetall,0)."</th>
        </tr>
    ";
}

$html .= "</table><br>";

$html .="</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));
?>