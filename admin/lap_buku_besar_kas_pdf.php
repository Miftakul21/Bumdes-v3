<?php 
require_once "../setting/koneksi.php";
require_once "../dompdf/vendor/autoload.php";
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$kode_akun = $_GET['kode_akun'];
$periode1 = date_format(date_create($_GET['periode1']), "d-m-Y");
$periode2 = date_format(date_create($_GET['periode2']), "d-m-Y");

$per1 = $_GET['periode1'];
$per2 = $_GET['periode2'];
$nama_akun = $_GET['nama_akun'];

$sql = "";
if($kode_akun == "semua") {
    $sql = "SELECT a.*, b.nama_akun FROM tb_kas AS a JOIN tb_akun AS b ON a.kode_akun = b.kode_akun WHERE (a.tanggal BETWEEN '$per1' AND '$per2')";
} else {
    $sql = "SELECT a.*, b.nama_akun FROM tb_kas AS a JOIN tb_akun AS b ON a.kode_akun = b.kode_akun WHERE a.kode_akun = '$kode_akun' AND (a.tanggal BETWEEN '$per1' AND '$per2')";    
}

$query = mysqli_query($mysqli, $sql);

$html = "<center><span style='font-size:1.5rem; font-weight: bold;'>Laporan Buku Kas Desa</span><center>";
$html .= "<center>Periode ".$periode1." S/d ".$periode2."</center>";
$html .= "<center>Jenis Akun : ".$nama_akun."</center><br>";

// nama field tabel
$html .= "<table border='1' width='100%'>
        <tr>
            <th>No Transaksi</th>
            <th>Tanggal</th>
            <th>Keterangan Transaksi</th>
            <th>Debet</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>";

$saldo = 0;
while($data1 = mysqli_fetch_array($query)) {
    $saldo += $data1['debet'];
    $saldo -= $data1['kredit'];
    $tanggal = date_format(date_create($data1['tanggal']),'d-m-Y');
    $html .= "
            <tr>
                <td>".$data1['id_transaksi']."</td>
                <td>".$tanggal."</td>
                <td>".$data1['keterangan']."</td>
                <td>".$data1['debet']."</td>
                <td>".$data1['kredit']."</td>
                <td>".$saldo."</td>
            </tr>
    ";
}

$html .= "</table>";
$html .="</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test.pdf', array('Attachment'=>0));
?>