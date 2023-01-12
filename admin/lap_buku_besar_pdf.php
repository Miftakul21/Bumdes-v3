<?php 
require_once "../setting/koneksi.php";
require_once "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// komponen
$kode = $_GET['akun'];
$unit = $_GET['unit'];
$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];

$per1 = date_format(date_create($periode1), "d-m-Y");
$per2 = date_format(date_create($periode2), "d-m-Y");

// nama unit
$sql1 = "SELECT * FROM tb_unit WHERE id_unit = '$unit'";
$query1 = mysqli_query($mysqli, $sql1);
$data1 = mysqli_fetch_array($query1);

$sql2 = "";
if($kode == "Semua") {
    $sql2 = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE id_unit = '$unit' 
            AND (tanggal BETWEEN '$periode1' AND '$periode2')";
} else {   
    $sql2 = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE id_unit = '$unit' AND 
            kode_akun = '$kode' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
}

// nama akun
$nama = $_GET['nama_akun'];

$query2 = mysqli_query($mysqli, $sql2);
// Heading
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Buku Besar ".$data1['nama_unit']."</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .= "<center><span>Jenis Akun : ".$nama."</span></center>";
$html .= "<br>";

// nama filed tabel
$html .= "<table border='1' width='100%'>
        <tr>
            <th style='padding: 4px;'>No Transaksi</th>
            <th style='padding: 4px;'>Tanggal</th>
            <th style='padding: 4px;'>Keterangan Transaksi</th>
            <th style='padding: 4px;'>Debet</th>
            <th style='padding: 4px;'>Kredit</th>
            <th style='padding: 4px;'>Saldo</th>
        </tr>
";

$saldo = 0;
while($data2 = mysqli_fetch_array($query2)){
    $saldo += $data2['debet'];
    $saldo -= $data2['kredit'];
    $tanggal = date_format(date_create($data2['tanggal']), 'd-m-Y');

    $html .= "<tr>
            <td style='padding: 4px;'>".$data2['id_transaksi']."</td>
            <td style='padding: 4px;'>".$tanggal."</td>
            <td style='padding: 4px;'>".$data2['keterangan_transaksi']."</td>
            <td style='padding: 4px;'>".number_format($data2['debet'],0)."</td>
            <td style='padding: 4px;'>".number_format($data2['kredit'],0)."</td>
            <td style='padding: 4px;'>".number_format($saldo,0)."</td>
    </tr>";
}

$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));
?>