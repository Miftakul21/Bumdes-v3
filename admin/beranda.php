<?php 
$bulan1 = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
$tahun = date('Y');
$bln = date('m');

for($bulan = 1; $bulan<13; $bulan++){
	$query = mysqli_query($mysqli, "SELECT *, SUM(debet) AS debet, SUM(kredit) AS kredit FROM tb_kas WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND kode_akun LIKE '4%'");
	$row = mysqli_fetch_array($query);
	$debet1[] = isset($row['debet']) ? $row['debet'] : 0;
	$kredit1[] = isset($row['kredit']) ? $row['kredit'] : 0; 
	$hasil1[] = $debet1 + $kredit1;

}

for($bulan2 = 1; $bulan2<13; $bulan2++){
	$query = mysqli_query($mysqli, "SELECT *, SUM(debet) AS debet, SUM(kredit) AS kredit FROM tb_kas WHERE MONTH(tanggal) = '$bulan2' AND YEAR(tanggal) = '$tahun' AND (kode_akun LIKE '3-2%' OR kode_akun LIKE '5-1%')");
	$row = mysqli_fetch_array($query);
	$debet2 = isset($row['debet']) ? $row['debet'] : 0;
	$kredit2 =  isset($row['kredit']) ? $row['kredit'] : 0;
	$hasil2[] = $debet2 + $kredit2;
}

// unit 
$queryz = mysqli_query($mysqli, "SELECT * FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan 
						JOIN tb_unit AS c ON b.id_unit = c.id_unit GROUP BY c.id_unit ASC");
// Penghasilan
$queryz2 = mysqli_query($mysqli, "SELECT *, SUM(debet) AS penghasilan1, SUM(kredit) AS penghasilan2 FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan JOIN tb_unit AS c ON b.id_unit = c.id_unit GROUP BY c.id_unit ASC");

// Data Desa
$total_pendapatan_desa = mysqli_query($mysqli, "SELECT SUM(debet) AS total_pendapatan1, SUM(kredit) AS total_pendapatan2 FROM tb_kas WHERE MONTH(tanggal) = '$bln' AND kode_akun LIKE '4%'");
$data1 = mysqli_fetch_array($total_pendapatan_desa);
$hasil3 = isset($data1['total_pendapatan1']) ? $data1['total_pendapatan1'] : 0;
$hasil4 = isset($data1['total_pendapatan2']) ? $data1['total_pendapatan2'] : 0;
$result1 = $hasil3 + $hasil4;

$total_pengeluaran_desa = mysqli_query($mysqli, "SELECT SUM(debet) AS total_pengeluaran1, SUM(kredit) AS total_pengeluaran2 FROM tb_kas WHERE MONTH(tanggal) = '$bln' AND (kode_akun LIKE '3-2%' OR kode_akun LIKE '5-1%')");
$data2 = mysqli_fetch_array($total_pengeluaran_desa);
$hasil5 = isset($data2['total_pengeluaran1']) ? $data2['total_pengeluaran2'] : 0;
$hasil6 = isset($data2['total_pengeluaran2']) ? $data2['total_pengeluaran2'] : 0;
$result2 = $hasil5 + $hasil6;
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h3 class="m-0 text-dark">Selamat Datang, <?=$_SESSION['nama'];?> </h3>
			</div>
		</div>
	</div>
</div>

<?php if($_SESSION['level_user']=='Kepala Desa'){ ?>
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-6">
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_index")?></h3>
						<p>Unit Usaha</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="?hal=unit" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_index")?></h3>
						<p>Data Sumber Dana</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="?hal=ind" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>Rp. <?= number_format($result1,0); ?></h3>
						<p>Pendapatan Desa Perbulan</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>Rp. <?= number_format($result2,0); ?></h3>
						<p>Pengeluaran Desa Perbulan</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>

		<div class="container-fluid">
		<div class="row">
			<div class="col-8">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<div class="d-flex justify-content-between">
							<h6 id="test" class="m-0 font-weight-bold ">Grafik Keuangan Desa</h6>
						</div>
					</div>
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myAreaChart"></canvas>
						</div>
					</div>
				</div>
			</div>

		<div class="col-4">
			<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">Pendapatan Unit</h6>
			</div>
			<div class="card-body">
				<div class="chart-pie">
					<canvas id="myPieChart"></canvas>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>

<?php }else{ ?>
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-6">
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_unit")?></h3>
						<p>Unit Usaha</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_index")?></h3>
						<p>Data Sumber Dana</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_akun")?></h3>
						<p>Data Akun</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-6">
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?=JumlahData($mysqli,"tb_user")?></h3>
						<p>Data User</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>

	<div class="container-fluid">
		<div class="row">
			<div class="col-8">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<div class="d-flex justify-content-between">
							<h6 id="test" class="m-0 font-weight-bold ">Grafik Keuangan Desa</h6>
						</div>
					</div>
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myAreaChart"></canvas>
						</div>
					</div>
				</div>
			</div>

		<div class="col-4">
			<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">Pendapatan Unit</h6>
			</div>
			<div class="card-body">
				<div class="chart-pie">
					<canvas id="myPieChart"></canvas>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>

	<?php } ?>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		let ctx = document.getElementById('myAreaChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($bulan1); ?>,
				datasets: [
					{
						label: 'Pendapatan Desa',
						data: <?php echo json_encode($hasil1) ?>,
						borderWidth: 1
					},
					{
						label: 'Pengeluaran Desa',
						data: <?php echo json_encode($hasil2) ?>,
						borderWidth: 1
					},					
				]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
				responsive: true
			}
		});
		
		let ctx2 = document.getElementById('myPieChart').getContext('2d');
		let myChart2 = new Chart(ctx2, {
			type:'pie',
			data: {
				labels: [<?php  while($dataz3 = mysqli_fetch_array($queryz)) { echo '"'.$dataz3['nama_unit'].'",'; } ?>],
				datasets: [
					{
						label: 'Pendapatan Unit Usaha',
						data: [
								<?php  
									while($dataz4 = mysqli_fetch_array($queryz2)) { 
										$data_penghasilan_unit = $dataz4['penghasilan1'] + $dataz4['penghasilan2'];
										$result3 = isset($data_penghasilan_unit) ? $data_penghasilan_unit : 0;
										echo '"'.$result3.'",';
									}
								?> 
							],
						backgroundColor: [
							'#29B0D0',
							'#2A516E',
							'#F07124',
							'#CBE0E3',
							'#979193'
						]

					}
				]
			},
			options: {responsive: true}
		});
	</script>