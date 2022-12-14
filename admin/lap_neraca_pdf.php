<?php 
require_once "../setting/koneksi.php";
require_once "../dompdf/vendor/autoload.php";
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];
$unit = $_GET['unit'];

$per1 = date_format(date_create($periode1), 'd-m-Y');
$per2 = date_format(date_create($periode2), 'd-m-Y');

// Aktiva Lancar
$sql1 = "SELECT (SUM(debet)-SUM(kredit)) AS debet,kode_akun,nama_akun FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_akun USING(kode_akun) 
        WHERE tb_akun.kode_akun LIKE '1-1%' AND id_unit='9' AND (tanggal BETWEEN '2022-01-01' AND '2022-12-01') GROUP BY kode_akun,nama_akun";
$query1 = mysqli_query($mysqli, $sql1);

// Aktiva Tetap
$sql2 = "SELECT (SUM(debet)-SUM(kredit)) AS debet,kode_akun,nama_akun FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_akun USING(kode_akun)
        WHERE tb_akun.kode_akun LIKE '1-2%' AND id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun,nama_akun"; 
$query2 = mysqli_query($mysqli, $sql2);

// Pasiva
$sql3 = "SELECT (SUM(debet)-SUM(kredit)) AS debet,kode_akun,nama_akun FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_akun USING(kode_akun) 
        WHERE tb_akun.kode_akun LIKE '2%' AND id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun,nama_akun";
$query3 = mysqli_query($mysqli, $sql3);

// nama unit
$sql = "SELECT * FROM tb_unit WHERE id_unit = '$unit'";
$query = mysqli_query($mysqli,$sql);
$data = mysqli_fetch_array($query);

// Heding / Judul
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Neraca ".$data['nama_unit']."</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .="<br>";

// Tabel 1 Aktiva
$html .= "<h4 style='font-weight: bold;'>Aktiva Lancar</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th>Kode Akun<</th>
        <th>Nama Akun<</th>
        <th>#<</th>
    </tr>
";
$debetall1 = 0;
while($data1 = mysqli_fetch_array($query1)){
    $debetall1 += $data1['debet'];
    $cek = isset($debetall1) ? $debetall1 : 0;

    $html .= "
        <tr>
            <td width='20%'>".$data1['kode_akun']."</td>
            <td width='50%'>".$data1['nama_akun']."</td>
            <td width='30%'>".number_format($data1['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left;'>Total</th>
            <th style='text-align:left;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";


// - Aktiva Tetap
$html .= "<h4 style='font-weight: bold;'>Aktiva Tetap</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th>Kode Akun<</th>
        <th>Nama Akun<</th>
        <th>#<</th>
    </tr>
";

$debetall2 = 0;
while($data2 = mysqli_fetch_array($query2)) {
    $debetall2 += $data2['debet'];
    $cek = isset($debetall2) ? $debetall2 : 0;

    $html .= "
        <tr>
            <td width='20%'>".$data2['kode_akun']."</td>
            <td width='50%'>".$data2['nama_akun']."</td>
            <td width='30%'>".number_format($data2['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left;'>Total</th>
            <th style='text-align:left;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

// - Pasiva
$html .= "<h4 style='font-weight: bold;'>Pasiva</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th>Kode Akun<</th>
        <th>Nama Akun<</th>
        <th>#<</th>
    </tr>
";

$debetall3 = 0;
while($data3 = mysqli_fetch_array($query3)) {
    $debetall3 += $data3['debet'];
    $cek = isset($debetall13) ? $debetall3 : 0;

    $html .= "
        <tr>
            <td width='20%'>".$data3['kode_akun']."</td>
            <td width='50%'>".$data3['nama_akun']."</td>
            <td width='30%'>".number_format($data3['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left;'>Total</th>
            <th style='text-align: left;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test2.php', array('Attachment'=>0));
?>