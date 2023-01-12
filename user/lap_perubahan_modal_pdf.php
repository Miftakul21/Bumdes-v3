<?php
require_once '../setting/koneksi.php';
require_once '../setting/crud.php';
require_once '../dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$unit = $_GET['unit'];
$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];

$per1 = date_format(date_create($periode1), 'd-m-Y');
$per2 = date_format(date_create($periode2), 'd-m-Y');

// nama unit
$sql = "SELECT * FROM tb_unit WHERE id_unit = '$unit'";
$query = mysqli_query($mysqli,$sql);
$data = mysqli_fetch_array($query);

$modal=caridata($mysqli,"SELECT SUM(kredit) FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE(tanggal BETWEEN '$periode1' AND '$periode2') AND id_unit='$unit' AND kode_akun='3-111'");
$prive=caridata($mysqli,"SELECT SUM(debet) FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE (tanggal BETWEEN '$periode1' AND '$periode2') AND id_unit='$unit' AND kode_akun='3-211'");            
$pendapatan=caridata($mysqli,"SELECT SUM(kredit) FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE (tanggal BETWEEN '$periode1' AND '$periode2') AND id_unit='$unit' AND kode_akun='4-111'");            
$bebangaji=caridata($mysqli,"SELECT SUM(debet) FROM tb_transaksi JOIN tb_kegiatan USING(id_kegiatan) WHERE (tanggal BETWEEN '$periode1' AND '$periode2') AND id_unit='$unit' AND kode_akun LIKE '5%'");
            
$labarugi=$pendapatan-$bebangaji;
$modalakhir=$modal-$prive+$labarugi;

$modal = $modal != NULL ? $modal : 0;
$prive = $prive != NULL ? $prive : 0;

// Heding / Judul
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Perubahan Modal ".$data['nama_unit']."</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .="<br>";

$html .= "<table border='1' width='100%'>
        <tr>
            <th width='50%' style='text-align: left; padding: 5px;'>Modal Setor</th>
            <th style='text-align: left; padding: 5px;'>".number_format($modal,0)."</th>
        </tr>
        <tr>
            <th width='50%' style='text-align: left; padding: 5px;'>Prive</th>
            <th style='text-align: left; padding: 5px;'>".number_format($prive,0)."</th>
        </tr>
        <tr >
            <th width='50%' style='text-align: left; padding: 5px;'>Laba / Rugi Bersih</th>
            <th style='text-align: left; padding: 5px;'>".number_format($labarugi,0)."</th>
        </tr>
        <tr>
            <th width='50%' style='text-align: left; padding: 5px;'>Modal Akhir</th>
            <th style='text-align: left; padding: 5px;'>".number_format($modalakhir,0)."</th>
        </tr>
        </table><br>
"; 

$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test2.php', array('Attachment'=>0));
?>