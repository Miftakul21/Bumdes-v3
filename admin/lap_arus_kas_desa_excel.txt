<?php 
require_once "../vendor/autoload.php";
require_once "../setting/koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

$spreadsheet = new Spreadsheet();

$periode1 = date_format(date_create($_GET['periode1']), "d-m-Y");
$periode2 = date_format(date_create($_GET['periode2']), "d-m-Y");

$per1 = $_GET['periode1'];
$per2 = $_GET['periode2'];

// Style Spreadsheet
$border = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THICK,
            'color' => ['rgb' => '000000']
        ],
    ],
];

$bold = [
    'font' => [
        'bold' => true
    ],
];


// atur jenis font 
$spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName("Arial")
            ->setSize(16);

// Judul / Heading
$spreadsheet->getActiveSheet()
            ->setCellValue("A1", "Laporan Arus Kas Desa Minggirsari");
$spreadsheet->getActiveSheet()->mergeCells("A1:D1"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
            ->setCellValue("A2", "Periode ".$periode1." S/d ".$periode2);
$spreadsheet->getActiveSheet()->mergeCells("A2:D2"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
            ->setCellValue("A3", "Informasi Arus Kas Desa");
$spreadsheet->getActiveSheet()->mergeCells("A3:D3"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A3")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Content 
// 1. Setting Field
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
// $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);


// Loop Isi Sumber / tb_index
$query_sumber = mysqli_query($mysqli, "SELECT * FROM tb_index WHERE id_index != 0 ORDER BY keterangan ASC");

$baris1 = 5;
$baris2 = 6;
while($ket = mysqli_fetch_array($query_sumber)) {
    $id_index = $ket['id_index'];
    $sql = "SELECT a.debet, a.keterangan as ket, a.debet, a.kredit FROM tb_kas AS a JOIN tb_index AS b ON a.`sumber` = b.`id_index` WHERE a.sumber = '$id_index' AND (a.`tanggal` BETWEEN '$per1' AND '$per2')";
    $query = mysqli_query($mysqli, $sql);
    while($dataz = mysqli_fetch_array($query)){
    
    // Nama Field
    $spreadsheet->getActiveSheet()
        ->setCellValue("A".$baris1, "Arus Kas Test")
        ->setCellValue("B".$baris1, "Debet")
        ->setCellValue("C".$baris1, "Kredit")
        ->setCellValue("D".$baris1, "Total");

    // Atur Ukuran Font Field
    $spreadsheet->getActiveSheet()->getStyle("A".$baris1.":C".$baris1)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle("A".$baris1.":C".$baris1)->applyFromArray($bold);
    $spreadsheet->getActiveSheet()->getStyle("A".$baris1.":C".$baris1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle("A".$baris1.":C".$baris1)->applyFromArray($border);


        // Isi Tabel
        $spreadsheet->getActiveSheet()
                    ->setCellValue("A".$baris2, "Test 1")
                    ->setCellValue("B".$baris2, "Test 2")
                    ->setCellValue("C".$baris2, "Test 3")
                    ->setCellValue("D".$baris2, "Test 4");
        //             ->setCellValue("B".$baris1++, number_format($dataz['debet'],0))
        //             ->setCellValue("C".$baris1++, number_format($dataz['kredit'],0));

        $spreadsheet->getActiveSheet()->getStyle("A".$baris2.":C".$baris2)->applyFromArray($border);

        $baris2++;
    }
    $baris1++;
}

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"test.xlsx\"");

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save("php://output");
?>