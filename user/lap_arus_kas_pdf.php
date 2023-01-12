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

// nama unit
$sql1 = "SELECT * FROM tb_unit WHERE id_unit = '$unit'";
$query1 = mysqli_query($mysqli,$sql1);
$data1 = mysqli_fetch_array($query1);

// Heding / Judul
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Arus Kas ".$data1['nama_unit']."</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center>";
$html .="<br>";

// Loop Filed Name
$sql2 = "SELECT * FROM tb_index WHERE id_index !=0 ORDER BY keterangan ASC";
$query2 = mysqli_query($mysqli, $sql2);

while($data2 = mysqli_fetch_array($query2)){
    $html .= "<table border='1' width='100%'>
        <tr>
            <th style='text-align: left; padding: 10px;'>".$data2['keterangan']."</th>
            <th style='padding: 10px;'>Debet</th>
            <th style='padding: 10px;'>Kredit</th>
            <th style='padding: 10px;'>#</th>
        </tr>    
    ";

    $id_index = $data2['id_index'];
    $sql3 = "SELECT * FROM tb_transaksi JOIN tb_kegiatan using(id_kegiatan) WHERE id_index ='$id_index' AND id_unit='$unit' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
    $query3 = mysqli_query($mysqli, $sql3);

    $debetall = 0;
    $kreditall = 0;
    while($data3 = mysqli_fetch_array($query3)){
        $debetall += $data3['debet'];
        $kreditall += $data3['kredit'];
        $html .= "<tr>
            <td style='padding: 5px;'>".$data3['keterangan_transaksi']."</td>
            <td style='padding: 5px;'>".number_format($data3['debet'],0)."</td>
            <td style='padding: 5px;'>".number_format($data3['kredit'],0)."</td>
        </tr>";
    }
    $html .= "
        <th colspan='3' style='padding: 5px;'>Total</th>
        <th style='padding: 5px;'>".number_format($debetall - $kreditall,0)."</th>
    ";
    $html .="</table>";
}

$html .="</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','potrait');
$dompdf->render();
$dompdf->stream('test3.php', array('Attachment'=>0));
?>