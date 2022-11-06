<?php 
require_once "../setting/koneksi.php";

$id_anggota = $_GET['id'];
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"tb_anggota_pinjam","id='$kode'"));
}else{
    // $nama_unit="";
}

$query_data = mysqli_query($mysqli,"SELECT a.id, b.nominal_pinjaman, b.jangka_pinjaman FROM tb_anggota_pinjam AS a JOIN tb_angsuran_pinjam AS b ON a.id = b.id_pinjaman WHERE a.id = '$id_anggota'");
$data = mysqli_fetch_assoc($query_data);

?>

<section class="content" style="margin-top: 10px;">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Pinjaman</h3>
            </div>
            <!-- form start -->
            <form role="form" id="quickForm" action="operasi_crud/anggota_pinjam/update.php" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Kode<span class="text-danger">*</span></label>
                        <input type="hidden" name="id" value="<?= @$id; ?>">
                        <input type="text" name="kode" class="form-control" value="<?= @$kode; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama<span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="<?= @$nama; ?>"  required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Dukuh<span class="text-danger">*</span></label>
                        <input type="text" name="dukuh" class="form-control" value="<?= @$dukuh; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Alamat<span class="text-danger">*</span></label>
                        <input type="text" name="alamat" class="form-control" value="<?= @$alamat ?>" required="">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="RT">RT<span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control" value="<?= @$rt; ?>" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="rw">RW<span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control" value="<?= @$rw; ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nominal_pinajm">Nominal Pinajaman<span class="text-danger">*</span></label>
                        <input type="number" name="nominal_pinjaman" class="form-control" value="<?= $data['nominal_pinjaman']; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="jangka_pinjaman">Jangka Pinjaman<span class="text-danger">*</span></label>
                        <input type="number" name="jangka_pinjaman" class="form-control" value="<?= $data['jangka_pinjaman']; ?>" required="" min="1" max="12">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ubah</button>
                    <a href="?hal=pinjaman" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</section>