<?php
require_once '../setting/koneksi.php';
$bulan=date('m');
$tahun=date('Y');
$id_unit=$_SESSION['id'];


$transaksibulanini=caridata($mysqli,"SELECT count(*) from tb_transaksi  join tb_kegiatan using(id_kegiatan) where id_unit='$id_unit' and month(tanggal)='$bulan' and year(tanggal)='$tahun'");

$pendapatan = mysqli_query($mysqli,"SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan 
						AS b ON a.id_kegiatan = b.id_kegiatan JOIN tb_unit AS c ON b.id_unit = c.id_unit WHERE MONTH(tanggal) = '$bulan'
						AND YEAR(tanggal) = '$tahun' AND a.`kode_akun` LIKE '4-111%' AND c.id_unit = '$id_unit'");
$data1 = mysqli_fetch_array($pendapatan);
$debet1 = isset($data1['Debet']) ? $data1['Debet'] : 0;
$kredit1 = isset($data1['Kredit']) ? $data1['Kredit'] : 0;
$total_pendapatan = $debet1 + $kredit1;

$pengeluaran =  mysqli_query($mysqli, "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan 
						AS b ON a.id_kegiatan = b.id_kegiatan JOIN tb_unit AS c ON b.id_unit = c.id_unit WHERE MONTH(tanggal) = '$bulan'
						AND YEAR(tanggal) = '$tahun' AND  a.`kode_akun` LIKE '5-1%' AND c.id_unit = 
						'$id_unit'");
$data2 = mysqli_fetch_array($pengeluaran);
$debet2 = isset($data2['Debet']) ? $data2['Debet'] : 0;
$kredit2 = isset($data2['Kredit']) ? $data2['Kredit'] : 0;
$total_pengeluaran = $debet2 + $kredit2;

$laba = $total_pendapatan - $total_pengeluaran;

?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h3 class="m-0 text-dark">Selamat Datang, <?=$_SESSION['nama'];?> </h3>
			</div>
		</div>
	</div>
</div>
<!-- /.content-header -->
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3><?php echo $transaksibulanini; ?></h3>
					<p>Transaksi Bulan Ini</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
				<a href="?hal=transaksi_data" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-warning">
				<div class="inner">
					<h3><?php echo number_format($total_pendapatan,0)?></h3>
					<p>Pendapatan Bulan Ini</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
				<a href="?hal=transaksi_data" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-primary">
				<div class="inner">
					<h3><?php echo number_format($total_pengeluaran,0)?></h3>
					<p>Pengeluaran Bulan Ini</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
				<a href="?hal=transaksi_data" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
				<h3><?php echo number_format($laba,0)?></h3>

					<p>Laba Rugi Bulan ini</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
				<a href="?hal=transaksi_data" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>