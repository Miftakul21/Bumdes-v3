<?php
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_unit","id_unit='$kode'"));
}else{
  $nama_unit="";
}
?>
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data Unit Usaha</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/unit/update.php" method="post">
            <div class="card-body">
              <input type="hidden" name="kode" value="<?= @$id_unit; ?>">
              <div class="form-group">
                <label for="nama">Nama Unit</label>
                <input type="text" name="nama_unit" class="form-control" value="<?= @$nama_unit?>" required="">
              </div>
            </div>

            <div class="card-footer">
              <button class="btn btn-primary">Ubah</button>
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