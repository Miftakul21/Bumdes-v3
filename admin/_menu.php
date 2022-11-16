<li class="nav-item">
	<a href="?hal=beranda" class="nav-link text-light">
		<i class="nav-icon fas fa-home"></i>
		<p> Dashboard </p>
	</a>
</li>

<?php if($_SESSION['level_user']=='Admin' || $_SESSION['level_user']=='Bendahara'){ ?>
	<li class="nav-item">
		<hr class="bg-gradient-light">
	</li>


	<div class="sidebar-heading text-white">Data Master</div>
    <li class="nav-item">
		<a class="nav-link text-light" href="?hal=akun">
			<i class="fa fa-book nav-icon"></i>
			<p>Data Akun</p>
		</a>
    </li>

    <li class="nav-item">
		<!-- nanti diganti halaman ind ke sumber_arus -->
		<a class="nav-link text-light" href="?hal=ind">
			<i class="fa fa-certificate nav-icon"></i>
			<p>Data sumber arus</p>
		</a>
    </li>
	
    <li class="nav-item">
		<a class="nav-link text-light" href="?hal=unit" >
			<i class="fa fa-bars nav-icon"></i>
			<p>Data Unit</p>
		</a>
    </li>

    <li class="nav-item">
		<a class="nav-link text-light" href="?hal=kegiatan">
			<i class="fa fa-plus nav-icon"></i>
			<p>Data Usaha Unit</p>
		</a>
    </li>
    <li class="nav-item">
		<a class="nav-link text-light" href="?hal=user">
			<i class="fa fa-user-circle nav-icon"></i>
			<p>Data User</p>
		</a>
    </li>
	<li class="nav-item">
		<hr class="bg-gradient-light">
	</li>
	<div class="sidebar-heading text-white">Data Bumdes</div>
	<!-- Keuangan Desa -->
	<li class="nav-item">
		<a href="#" class="nav-link text-light">
			<i class="fas fa-solid fa-landmark nav-icon"></i>
			<p> Data Kas Desa <i class="fas fa-angle-left right"></i></p>
		</a>
		<ul class="nav nav-treeview">
			<li class="nav-item">
				<a href="?hal=kas" class="nav-link text-light">
					<i class="fas fa-solid fa-file-invoice-dollar nav-icon"></i>
					<p>Transaksi Kas</p>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a href="?hal=lap_jurnal_umum_kas" class="nav-link text-light">
					<i class="fa fa-book nav-icon"></i>
					<p>Jurnal Umum</p>
				</a>
			</li> -->
			<li class="nav-item">
				<a href="?hal=lap_buku_besar_kas" class="nav-link text-light">
					<i class="fa fa-bookmark nav-icon"></i>
					<p>Buku Besar</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="?hal=lap_arus_kas_desa" class="nav-link text-light">
					<i class="fa fa-angle-double-right nav-icon"></i>
					<p>Arus Kas</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="?hal=lap_neraca_kas" class="nav-link text-light"> 
					<i class="fa fa-balance-scale nav-icon"></i>
					<p>Neraca</p>
				</a>
			</li>
		</ul>
    </li>
	<!-- Keuangan Pinjaman -->
	<li class="nav-item">
		<a href="#" class="nav-link text-light">
			<i class="fas fa-solid fa-user-tag nav-icon"></i>
			<p>
			Data Pinjaman
			<i class="fas fa-angle-left right"></i>
			</p>
		</a>
		<ul class="nav nav-treeview">
			<li class="nav-item">
			<a href="?hal=pinjaman" class="nav-link text-light">
				<i class="fas fa-solid fa-file-invoice-dollar nav-icon"></i>
				<p>Transaksi Pinjaman</p>
			</a>
			</li>
			<li class="nav-item">
			<a href="?=hal=laporan_pinjaman" class="nav-link text-light">
				<i class="fa fa-book nav-icon"></i>
				<p>Laporan</p>
			</a>
			</li>
		</ul>
    </li>
<?php } ?>

<li class="nav-item">
	<hr class="bg-light">
</li>

<div class="sidebar-heading text-white">Data Unit</div>
<?php
$query="SELECT * from tb_unit";
$result=$mysqli->query($query);
$num_result=$result->num_rows;
if ($num_result > 0 ) { 
	while ($data=mysqli_fetch_assoc($result)) {
		extract($data);  ?>
		<li class="nav-item has-treeview"> <!--menu-open-->
			<a href="#" class="nav-link text-light"> <!-- active -->
				<i class="nav-icon fas fa-list"></i>
				<p>
					Unit : <?=$nama_unit;?>
					<i class="fas fa-angle-left right"></i>
				</p>
			</a>
			<ul class="nav nav-treeview text-light">
				<li class="nav-item">
					<a href="?hal=lap_jurnal_umum&id=<?=$id_unit;?>" class="nav-link text-light">
						<i class="fa fa-bookmark nav-icon"></i>
						<p>Jurnal Umum</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="?hal=lap_buku_besar&id=<?=$id_unit;?>" class="nav-link text-light"> <!-- active -->
						<i class="fa fa-book nav-icon"></i>
						<p>Buku Besar</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="?hal=lap_arus_kas&id=<?=$id_unit;?>" class="nav-link text-light"> <!-- active -->
						<i class="fa fa-angle-double-right nav-icon"></i>
						<p>Arus Kas</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="?hal=lap_laba_rugi&id=<?=$id_unit;?>" class="nav-link text-light"> <!-- active -->
						<i class="fa fa-credit-card nav-icon"></i>
						<p>Laba Rugi</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="?hal=lap_perubahan_modal&id=<?=$id_unit;?>" class="nav-link text-light"> <!-- active -->
						<i class="fa fa-low-vision nav-icon"></i>
						<p>Perubahan Modal</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="?hal=lap_neraca&id=<?=$id_unit;?>" class="nav-link text-light"> <!-- active -->
						<i class="fa fa-balance-scale nav-icon"></i>
						<p>Neraca</p>
					</a>
				</li>
			</ul>
		</li>
		<?php } } ?>
