<?php 
require_once "../vendor/autoload.php";
require_once "../setting/koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

$spreadsheet = new Spreadsheet();

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


// Style Spreadsheet
$border = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THICK,
            'color' => ['rgb' => '000000']
        ],
    ],
];


// atur jenis font 
$spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName("Arial")
            ->setSize(16);

// Judul / Heading
$spreadsheet->getActiveSheet()
            ->setCellValue("A1", "Laporan Buku Besar Kas");
$spreadsheet->getActiveSheet()->mergeCells("A1:E1"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
            ->setCellValue("A2", "Periode ".$periode1." S/d ".$periode2);
$spreadsheet->getActiveSheet()->mergeCells("A2:E2"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
            ->setCellValue("A3", "Jenis Akun : ".$nama_akun);
$spreadsheet->getActiveSheet()->mergeCells("A3:E3"); // merge kolom
$spreadsheet->getActiveSheet()->getStyle("A3")->getFont()->setSize(16); // Atur ukuran font
$spreadsheet->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Content 
// 1. Setting Field
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(45);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);

// 2. Nama Filed
$spreadsheet->getActiveSheet()
            ->setCellValue("A5", "No Transaksi")
            ->setCellValue("B5", "Tanggal")
            ->setCellValue("C5", "Keterangan Transaksi")
            ->setCellValue("D5", "Debet")
            ->setCellValue("E5", "Kredit")
            ->setCellValue("F5", "Saldo");

// Atur Ukuran Font Field
$spreadsheet->getActiveSheet()->getStyle("A5:F5")->getFont()->setSize(16);
$spreadsheet->getActiveSheet()->getStyle("A5:F5")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("A5:F5")->applyFromArray($border);


// 3. Isi Tabel
$baris = 6;
$saldo = 0;
while($data = mysqli_fetch_array($query)) {
    $saldo += $data['debet'];
    $saldo -= $data['kredit'];

    $spreadsheet->getActiveSheet()
                ->setCellValue("A".$baris, $data['id_transaksi'])
                ->setCellValue("B".$baris, $data['tanggal'])
                ->setCellValue("C".$baris, $data['keterangan'])
                ->setCellValue("D".$baris, number_format($data['debet'],0))
                ->setCellValue("E".$baris, number_format($data['kredit'],0))
                ->setCellValue("F".$baris, number_format($saldo,0));    

    // Style isi table
    $spreadsheet->getActiveSheet()->getStyle("A".$baris.":F".$baris)->applyFromArray($border);
    $baris++;
}

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"test.xlsx\"");

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save("php://output");
?>
