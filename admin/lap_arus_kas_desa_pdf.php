<?php 
require_once '../setting/koneksi.php';
require_once '../dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
$periode1 = $_GET['periode1'];
$periode2 = $_GET['periode2'];

$per1 = date_format(date_create($_GET['periode1']), "d-m-Y");
$per2 = date_format(date_create($_GET['periode2']), "d-m-Y");

$dompdf = new Dompdf();

// Heading
$html = "<center><span style='font-size: 1.5rem; font-weight: bold;'>Laporan Arus Kas Desa Minggirsari</span></center>";
$html .= "<center><span>Periode ".$per1." S/d ".$per2."</span></center><br>";

// Loop Field Name
$sql1 = "SELECT * from tb_index where id_index !=0 order by keterangan asc";
$query1 = mysqli_query($mysqli, $sql1);

while($data1 = mysqli_fetch_array($query1)){
    $html .= "<table border='1' width='100%'>
            <tr>
                <th style='text-align: left; padding: 10px;'>".$data1['keterangan']."</th>
                <th style='padding: 10px;'>Debet</th>
                <th style='padding: 10px;'>Kredit</th>
                <th style='padding: 10px;'>#</th>
            </tr>>
        ";
    $id_index = $data1['id_index'];
    $sql2 = "SELECT a.* FROM tb_kas AS a JOIN tb_index AS b ON a.`sumber` = b.`id_index` WHERE a.sumber = '$id_index' 
            AND (a.`tanggal` BETWEEN '$periode1' AND '$periode2')";
    $query2 = mysqli_query($mysqli, $sql2);

    $debetall = 0;
    $kreditall = 0;
    while($data2 = mysqli_fetch_array($query2)){
        $debetall += $data2['debet']; 
        $kreditall += $data2['kredit']; 
        $html .= "<tr>
            <td style='padding: 5px;'>".$data2['keterangan']."</td>       
            <td style='padding: 5px;'>".number_format($data2['debet'],0)."</td>
            <td style='padding: 5px;'>".number_format($data2['kredit'],0)."</td>
        </tr>
        ";
    }
    $html .= "
        <th style='padding: 5px;' colspan='3'>Total</th>
        <th style='padding: 5px;'>".number_format($debetall - $kreditall,0)."</th>
    ";
    $html .="</table>";
}

$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test2.php', array('Attachment'=>0));
?>