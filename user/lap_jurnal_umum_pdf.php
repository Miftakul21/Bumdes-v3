<?php 
require_once "../setting/koneksi.php";
require_once "../setting/fungsi.php";
require_once "../dompdf/vendor/autoload.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

// Komponen
$unit = $_GET['unit'];
$id_kegiatan = $_GET['id_kegiatan'];

$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];
$per1 = date_format(date_create($_GET['periode1']), "d-m-Y");
$per2 = date_format(date_create($_GET['periode2']), "d-m-Y");

$query1 = mysqli_query($mysqli, "SELECT * FROM tb_unit WHERE id_unit = '$unit'");
$data1 = mysqli_fetch_array($query1);

// Heading
$html = "<center><span style='font-size:1.5rem; font-weight: bold;'>Laporan Jurnal Umum ".$data1['nama_unit']."</span></center>";
$html .= "<center>Periode ".$per1." S/d ".$per2."</center>";
$html .= "<br>";

$sql = "";

if($id_kegiatan == 'Semua') {
    $sql = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING (id_kegiatan) JOIN tb_index USING (id_index)
            WHERE id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
} else {
    $sql = "SELECT * FROM tb_transaksi JOIN tb_kegiatan USING (id_kegiatan) JOIN tb_index USING (id_index) 
            WHERE id_kegiatan='$id_kegiatan' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
}

// Nama Field Tabel
$html .= "<table border='1' width='100%'>
        <tr>
            <th style='padding: 4px;'>No Transaksi</th>
            <th style='padding: 4px;'>Tanggal</th>
            <th style='padding: 4px;'>Usaha</th>
            <th style='padding: 4px;'>Keterangan</th>
            <th style='padding: 4px;'>Kode_akun</th>
            <th style='padding: 4px;'>Sumber Dana</th>
            <th style='padding: 4px;'>Debet</th>
            <th style='padding: 4px;'>Kredit</th>
            <th style='padding: 4px;'>Saldo</th>
        </tr>
";

$query2 = mysqli_query($mysqli, $sql);

$saldo = 0;
while($data2 = mysqli_fetch_array($query2)){
    $saldo += $data2['debet'];
    $saldo -= $data2['kredit'];
    $tanggal = date_format(date_create($data2['tanggal']), "d-m-Y");

    $html .= "
        <tr>
            <td style='padding: 5px;'>".$data2['id_transaksi']."</td>
            <td style='padding: 5px;'>".$tanggal."</td>
            <td style='padding: 5px;'>".$data2['nama_kegiatan']."</td>
            <td style='padding: 5px;'>".$data2['keterangan_transaksi']."</td>
            <td style='padding: 5px;'>".$data2['kode_akun']."</td>
            <td style='padding: 5px;'>".$data2['keterangan']."</td>
            <td style='padding: 5px;'>".number_format($data2['debet'],0)."</td>
            <td style='padding: 5px;'>".number_format($data2['kredit'],0)."</td>
            <td style='padding: 5px;'>".number_format($saldo,0)."</td>
        </tr>
    ";
}
$html .= "</table>"; 

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));

?>