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
$sql1 = "SELECT *, SUM(a.`debet`) AS Debet, SUM(a.`kredit`) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan
        JOIN tb_akun AS c ON a.kode_akun = c.kode_akun WHERE c.kode_akun LIKE '1-1%' AND b.id_unit = '$unit' AND (a.tanggal BETWEEN 
        '$periode1' AND '$periode2') GROUP BY c.kode_akun, c.nama_akun";
$query1 = mysqli_query($mysqli, $sql1);

// Aktiva Tetap
$sql2 = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan 
        JOIN tb_akun AS c ON a.kode_akun = c.kode_akun LIKE '1-2%' AND b.id_unit = '$unit' AND (a.tanggal BETWEEN '$periode1' AND '$periode2') 
        GROUP BY c.kode_akun, c.nama_akun"; 
$query2 = mysqli_query($mysqli, $sql2);

// Pasiva
$sql3 = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b 
        ON a.id_kegiatan = b.id_kegiatan JOIN tb_akun AS c ON a.kode_akun = c.kode_akun LIKE '2%' AND b.id_unit = '$unit' 
        AND (a.tanggal BETWEEN '$periode1' AND '$periode2') GROUP BY c.kode_akun, c.nama_akun";
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
        <th style='text-align:left; padding:5px;'>Kode Akun<</th>
        <th style='text-align:left; padding:5px;'>Nama Akun<</th>
        <th style='text-align:left; padding:5px;'>#<</th>
    </tr>
";

$aktifa_lancar = 0;
$temp1 = 0;
while($data1 = mysqli_fetch_array($query1)){
    $temp1 += $data1['Debet'];
    $temp1 += $data1['Kredit'];

    $aktifa_lancar = $aktifa_lancar + $temp1;

    $html .= "
        <tr>
            <td width='20%' style='padding:5px;'>".$data1['kode_akun']."</td>
            <td width='50%' style='padding:5px;'>".$data1['nama_akun']."</td>
            <td width='30%' style='padding:5px;'>".number_format($temp1,0)."</td>
        </tr>
    ";
}
$html .= "<tr>
            <th colspan='2' style='text-align: left; padding:5px;'>Total</th>
            <th style='text-align:left; padding:5px;'>".number_format($aktifa_lancar,0)."</th>
        </tr>
    </table>";
$html .= "<br>";


// - Aktiva Tetap
$html .= "<h4 style='font-weight: bold;'>Aktiva Tetap</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th style='text-align: left; padding:5px;'>Kode Akun<</th>
        <th style='text-align: left; padding:5px;'>Nama Akun<</th>
        <th style='text-align: left; padding:5px;'>#<</th>
    </tr>
";

$aktifa_tetap = 0;
$temp2 = 0;
while($data2 = mysqli_fetch_array($query2)) {
    $temp2 += $data2['Debet'];
    $temp2 += $data2['Kredit'];

    $aktifa_tetap = $aktifa_tetap + $temp2;    

    $html .= "
        <tr>
            <td width='20%' style='padding:5px;'>".$data2['kode_akun']."</td>
            <td width='50%' style='padding:5px;'>".$data2['nama_akun']."</td>
            <td width='30%' style='padding:5px;'>".number_format($temp2,0)."</td>
        </tr>
    ";
}
$html .= "<tr>
            <th colspan='2' style='text-align: left; padding: 5px;'>Total</th>
            <th style='text-align:left; padding: 5px;'>".number_format($aktifa_tetap,0)."</th>
        </tr>
</table>";
$html .= "<br>";

// - Pasiva
$html .= "<h4 style='font-weight: bold;'>Pasiva</h4>";
$html .= "<table border='1' width='100%'>
    <tr>
        <th style='text-align: left; padding: 5px;'>Kode Akun<</th>
        <th style='text-align: left; padding: 5px;'>Nama Akun<</th>
        <th style='text-align: left; padding: 5px;'>#<</th>
    </tr>
";

$temp3 = 0;
$passiva = 0;
while($data3 = mysqli_fetch_array($query3)) {
    $temp3 += $data3['Debet'];
    $temp3 += $data3['Kredit'];

    $passiva = $passiva + $temp3;

    $html .= "
        <tr>
            <td width='20%' style='padding: 5px;'>".$data3['kode_akun']."</td>
            <td width='50%' style='padding: 5px;'>".$data3['nama_akun']."</td>
            <td width='30%' style='padding: 5px;'>".number_format($temp3,0)."</td>
        </tr>
    ";
}

$html .= "<tr>
            <th colspan='2' style='text-align: left; padding: 5px;'>Total</th>
            <th style='text-align: left; padding: 5;'>".number_format($passiva,0)."</th>
        </tr>
</table>";
$html .= "<br>";

$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test2.php', array('Attachment'=>0));
?>