<?php 
require_once '../setting/koneksi.php';

$id_anggota = isset($_GET['id_anggota']) ? $_GET['id_anggota'] : '';
// Data Pinjaman
$query_data = mysqli_query($mysqli, "select tb_anggota_pinjam.id, tb_anggota_pinjam.nama, tb_angsuran_pinjam.* from tb_anggota_pinjam join tb_angsuran_pinjam on tb_anggota_pinjam.id = tb_angsuran_pinjam.id_pinjaman where tb_anggota_pinjam.id = '$id_anggota'");



?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <!-- Informasi detail anggota pinjaman -->
        <?php 
            foreach($query_data as $d):
        ?>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center position-relative">
                <h4 class="font-weight-normal" >Detail Pinjaman <?= $d['nama']; ?></h4>
                <a href="?hal=pinjaman" class=" btn btn-danger mr-2" style="position: absolute; right:0;"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col">
                        <h5 class="card-text">Nominal</h5>
                        <h5 class="card-text">Pokok</h5>
                        <h5 class="card-text">Jasa</h5>
                        <h5 class="card-text">Jangka Pinjaman</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">: Rp. <?= number_format($d['nominal_pinjaman'],2,',','.'); ?></h5>
                        <h5 class="card-text">: Rp. <?= number_format($d['pokok'],2,',','.'); ?></h5>
                        <h5 class="card-text">: Rp. <?= number_format($d['jasa'],2,',','.'); ?></h5>
                        <h5 class="card-text">: <?= $d['jangka_pinjaman']; ?> Bulan</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">Total Pokok dan Jasa</h5>
                        <h5 class="card-text">Sisa Pinjaman Penelusuran</h5>
                        <h5 class="card-text">Sisa Pinjaman Pokok Dan Jasa</h5>
                        <h5 class="card-text">Status</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">: Rp. <?= number_format($d['total_pokok_jasa'],0); ?></h5>
                        <h5 class="card-text">: Rp. <?= number_format($d['sisa_pinjaman_penelusuran'],0); ?></h5>
                        <h5 class="card-text">: Rp. <?= number_format($d['sisa_pinjaman_pokok_jasa'],0); ?></h5>
                        <h5 class="card-text">: Belum Lunas</h5>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<section class="content">
    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#staticBackdrop">
        Tambah Data
    </button>
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title primary">List Data Angsuran</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pokok</th>
                            <th>Jasa</th>
                            <th>Potongan</th>
                            <th>Sisa Pinjaman Akhir (Jasa)</th>
                            <th>Sisa Pinjaman Akhir (Non Jasa)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM tb_angsuran WHERE id_anggota = '$id_anggota'";
                            $result = $mysqli->query($query);
                            $num_result = $result->num_rows;
                            if($num_result > 0) {
                                $no = 1;
                                while($data=mysqli_fetch_assoc($result)) {
                                    extract($data);
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tanggal; ?></td>
                            <td>Rp. <?= number_format($pokok,0);  ?></td>
                            <td>Rp. <?= number_format($jasa,0); ?></td>
                            <td>Rp. <?= number_format($potongan_jasa,0);  ?></td>
                            <td>Rp. <?= number_format($sisa_pinjaman_penelusuran,0); ?></td>
                            <td>Rp. <?= number_format($sisa_pinjaman_non_jasa,0); ?></td>
                            <td><?= $keterangan; ?></td>
                        </tr>
                        <?php 
                                }
                            }
                        ?>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>


<!-- Live Modal Bayar Angsuran -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="operasi_crud/angsur/store.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                            <input type="hidden" name="id_anggota" value="<?= $id_anggota; ?>" required>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="pokok" class="form-label">Pokok<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="pokok" name="pokok" placeholder="contoh: 50000" required>
                        </div>
                        <div class="mb-3">
                            <label for="jasa" class="form-label">Jasa<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jasa" name="jasa" placeholder="contoh: 50000" required>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<!-- Live Modal Untuk Menambahkan Potongan -->