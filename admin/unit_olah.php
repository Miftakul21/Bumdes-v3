<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <?php 
      if(isset($_SESSION['gagal'])){
    ?>
    <?php 
      unset($_SESSION['gagal']);
      }
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Unit Usaha</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/unit/store.php" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Nama Unit</label>
                <input type="text" name="nama_unit" class="form-control" value="<?php //@$nama_unit?>" placeholder="Masukkan Nama Unit" required="">
              </div>
            </div>

            <div class="card-footer">
              <button class="btn btn-primary">Simpan</button>
              <a href="?hal=unit" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>