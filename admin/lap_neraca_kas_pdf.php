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
$html = "<center>Laporan Necara Kas Bumdes</center>";
$html .= "<center>Periode ".$per1." S/d ".$per2."</center>";
$html .= "<br>";


// Tabel 1 Aktiva
// - Aktiva Lancar
$html .= "<table border='1' width='100%'>
        <tr>
            <th colspan='3' style='text-align: left;'><span style='font-weight: bold;'>Aktiva Lancar</span></th>
        </tr>
";

$debetall1 = 0;
while($data1 = mysqli_fetch_array($query1)) {
    $debetall1 += $data1['debet'];
    $cek = isset($debetall1) ? $debetall1 : 0;

    $html .= "
        <tr>
            <td width='10%'>".$data1['kode_akun']."</td>
            <td width='50%'>".$data1['nama_akun']."</td>
            <td width='30%'>".number_format($data1['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2'>Total</th>
            <th style='text-align:left;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

// - Aktiva Tetap
$html .= "<table border='1' width='100%'>
        <tr>
            <th colspan='3' style='text-align: left;'><span style='font-weight: bold;'>Aktiva Tetap</span></th>
        </tr>
";

$debetall2 = 0;
while($data2 = mysqli_fetch_array($query2)) {
    $debetall2 += $data2['debet'];
    $cek = isset($debetall2) ? $debetall2 : 0;

    $html .= "
        <tr>
            <td width='10%'>".$data2['kode_akun']."</td>
            <td width='50%'>".$data2['nama_akun']."</td>
            <td width='20%'>".number_format($data2['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2'>Total</th>
            <th style='text-align:left;'>".number_format($cek,0)."</th>
        </tr>
    ";
}

$html .= "</table>";
$html .= "<br>";

// - Pasiva
$html .= "<table border='1' width='100%'>
        <tr>
            <th colspan='3' style='text-align: left;'><span style='font-weight: bold;'>Pasiva</span></th>
        </tr>
";

$debetall3 = 0;
while($data3 = mysqli_fetch_array($query3)) {
    $debetall3 += $data3['debet'];
    $cek = isset($debetall13) ? $debetall3 : 0;

    $html .= "
        <tr>
            <td width='10%'>".$data3['kode_akun']."</td>
            <td width='50%'>".$data3['nama_akun']."</td>
            <td width='20%'>".number_format($data3['debet'],0)."</td>
        </tr>
        <tr>
            <th colspan='2'>Total</th>
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