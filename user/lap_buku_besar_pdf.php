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
            <th>No Transaksi</th>
            <th>Tanggal</th>
            <th>Keterangan Transaksi</th>
            <th>Debet</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
";

$saldo = 0;
while($data2 = mysqli_fetch_array($query2)){
    $saldo += $data2['debet'];
    $saldo -= $data2['kredit'];
    $tanggal = date_format(date_create($data2['tanggal']), 'd-m-Y');

    $html .= "<tr>
            <td>".$data2['id_transaksi']."</td>
            <td>".$tanggal."</td>
            <td>".$data2['keterangan_transaksi']."</td>
            <td>".number_format($data2['debet'],0)."</td>
            <td>".number_format($data2['kredit'],0)."</td>
            <td>".number_format($saldo,0)."</td>
    </tr>";
}

$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));
?>