<?php
require_once '../setting/koneksi.php';
$query = mysqli_query($mysqli, "SELECT id_index FROM tb_index GROUP BY id_index DESC LIMIT 1 ");
$query_id_index = mysqli_fetch_array($query);
$kode_otomatis = (int) $query_id_index['id_index'] + 1;

?>
<section class="content" style="margin-top: 10px;">
<?php 
  if(isset($_SESSION['gagal'])) {
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?= $_SESSION['gagal']; ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php 
  unset($_SESSION['gagal']);
  }
?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Sumber Dana</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/ind/store.php" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Kode Sumber Dana</label>
                <input type="hidden" name="id_index" value="<?= @$kode_otomatis; ?>">
                <input type="text" class="form-control" value="<?= @$kode_otomatis; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="nama">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="<?=@$keterangan?>" placeholder="Inputkan Keterangan" required="">
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Simpan</button>
              <a href="?hal=ind" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>