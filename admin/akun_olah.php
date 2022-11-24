<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <?php 
      if(isset($_SESSION['gagal'])){ 
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?= $_SESSION['success']; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php 
      unset($_SESSION['gagal']);
      }
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Akun</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/daftar_akun/store.php" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Kode Akun</label>
                <input type="text" name="kode_akun" class="form-control" value="<?=@$kode_akun?>" placeholder="Masukkan Kode Akun" required="" <?=isset($_GET['id'])?'readonly':'';?>>
              </div>
              <div class="form-group">
                <label for="nama">Nama Akun</label>
                <input type="text" name="nama_akun" class="form-control" value="<?=@$nama_akun?>" placeholder="Masukkan Nama Akun" required="">
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Simpan</button>
              <a href="?hal=akun" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>