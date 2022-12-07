<?php 
require_once "../setting/koneksi.php";
require_once "../dompdf/vendor/autoload.php";
use Dompdf\Dompdf;

// Komponen header
$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];

$per1 = date_format(date_create($_GET['periode1']), "d-m-Y");
$per2 = date_format(date_create($_GET['periode2']), "d-m-Y");

// Aktiva Lancar
$sql1 = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN tb_akun 
        USING (kode_akun) WHERE tb_akun.`kode_akun` LIKE '1-1%' AND (tb_kas.`tanggal` BETWEEN '$periode1' 
        AND '$periode2') GROUP BY kode_akun, nama_akun";
$query1 = mysqli_query($mysqli, $sql1);

// Aktiva Tetap
$sql2 = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN tb_akun 
        USING (kode_akun) WHERE tb_akun.`kode_akun` LIKE '1-2%' AND (tb_kas.`tanggal` BETWEEN '$periode1' 
        AND '$periode2') GROUP BY kode_akun, nama_akun"; 
$query2 = mysqli_query($mysqli, $sql2);

// Pasiva
$sql3 = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN 
        tb_akun USING (kode_akun) WHERE tb_akun.`kode_akun` LIKE '2%' AND (tb_kas.`tanggal` 
        BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun, nama_akun";
$query3 = mysqli_query($mysqli, $sql3);

$dompdf = new Dompdf();

// Header
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Necara Kas Bumdes</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .= "<br>";

// Tabel 1 Aktiva
// - Aktiva Lancar
$html .= "<h4 style='font-weight: bold;'>Aktiva Lancar</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th style='padding:5px'>Kode Akun<</th>
        <th style='padding:5px'>Nama Akun<</th>
        <th style='padding:5px'>#<</th>
    </tr>
";

$debetall1 = 0;
while($data1 = mysqli_fetch_array($query1)) {
    $debetall1 += $data1['debet'];
    $cek = isset($debetall1) ? $debetall1 : 0;

    $html .= "
        <tr>
            <td width='20%' style='padding: 5px;'>".$data1['kode_akun']."</td>
            <td width='50%' style='padding: 5px;'>".$data1['nama_akun']."</td>
            <td width='30%' style='padding: 5px;'>".number_format($data1['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left; padding: 5px;'>Total</th>
            <th style='text-align:left; padding: 5px;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

// - Aktiva Tetap
$html .= "<h4 style='font-weight: bold;'>Aktiva Tetap</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th style='padding: 5px;'>Kode Akun<</th>
        <th style='padding: 5px;'>Nama Akun<</th>
        <th style='padding: 5px;'>#<</th>
    </tr>
";

$debetall2 = 0;
while($data2 = mysqli_fetch_array($query2)) {
    $debetall2 += $data2['debet'];
    $cek = isset($debetall2) ? $debetall2 : 0;

    $html .= "
        <tr>
            <td width='20%' style='padding: 5px;'>".$data2['kode_akun']."</td>
            <td width='50%' style='padding: 5px;'>".$data2['nama_akun']."</td>
            <td width='30%' style='padding: 5px;'>".number_format($data2['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left; padding: 5px;'>Total</th>
            <th style='text-align:left; padding: 5px;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

// - Pasiva
$html .= "<h4 style='font-weight: bold;'>Pasiva</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th style='padding: 5px;'>Kode Akun<</th>
        <th style='padding: 5px;'>Nama Akun<</th>
        <th style='padding: 5px;'>#<</th>
    </tr>
";

$debetall3 = 0;
while($data3 = mysqli_fetch_array($query3)) {
    $debetall3 += $data3['debet'];
    $cek = isset($debetall13) ? $debetall3 : 0;

    $html .= "
        <tr>
            <td width='20%' style='padding: 5px;'>".$data3['kode_akun']."</td>
            <td width='50%' style='padding: 5px;'>".$data3['nama_akun']."</td>
            <td width='30%' style='padding: 5px;'>".number_format($data3['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2' style='text-align: left; padding: 5px;'>Total</th>
            <th style='text-align: left; padding: 5px;'>".number_format($cek,0)."</th>
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