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
$html = "<center>Laporan Arus Kas Desa Minggirsari</center>";
$html .= "<center>Periode ".$per1." S/d ".$per2."</center>";

// Loop Field Name
$sql1 = "SELECT * from tb_index where id_index !=0 order by keterangan asc";
$query1 = mysqli_query($mysqli, $sql1);

while($data1 = mysqli_fetch_array($query1)){
    $html .= "<table border='1' width='100%'>
            <tr>
                <th style='text-align: left;'>".$data1['keterangan']."</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>#</th>
            </tr>
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
            <td>".$data2['keterangan']."</td>       
            <td>".number_format($data2['debet'],0)."</td>
            <td>".number_format($data2['kredit'],0)."</td>
        </tr>
        ";
    }
    $html .= "
        <th colspan='3'>Total</th>
        <th>".number_format($debetall - $kreditall,0)."</th>
    ";
    $html .="</table>";
}

$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('test2.php', array('Attachment'=>0));


?>