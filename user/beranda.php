<?php
$bulan=date('m');
$tahun=date('Y');
$id_unit=$_SESSION['id'];

$transaksibulanini=caridata($mysqli,"SELECT count(*) from tb_transaksi  join tb_kegiatan using(id_kegiatan) where id_unit='$id_unit' and month(tanggal)='$bulan' and year(tanggal)='$tahun'");

$pendapatan=caridata($mysqli,"SELECT sum(kredit) from tb_transaksi join tb_akun using(kode_akun) join tb_kegiatan using(id_kegiatan) where tb_akun.kode_akun like '4%' and id_unit='$id_unit' and month(tanggal)='$bulan' and year(tanggal)='$tahun'");

$pengeluaran=caridata($mysqli,"SELECT sum(debet) from tb_transaksi join tb_akun using(kode_akun) join tb_kegiatan using(id_kegiatan) where tb_akun.kode_akun like '5%' and id_unit='$id_unit' and month(tanggal)='$bulan' and year(tanggal)='$tahun'");

$laba=$pendapatan-$pengeluaran;

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
					<h3><?php echo number_format($pendapatan,0)?></h3>
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
					<h3><?php echo number_format($pengeluaran,0)?></h3>
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