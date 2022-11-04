<?php
require_once '../setting/koneksi.php';
$username="";
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"tb_user","id_user='$kode'"));
}
?>
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data User</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/user/update.php" method="post">
            <div class="card-body">
              <input type="hidden" name="id_user" value="<?= @$id_user;?>">
              <div class="form-group">
                <label for="nama">Nama<span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="<?= @$nama; ?>" required="">
              </div>

              <div class="form-group">
                <label for="nama">Username<span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" value="<?= @$username; ?>" required="">
              </div>

              <div class="form-group">
                <label for="nama">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" value="<?= substr($password, 0, 8); ?>" required="">
              </div>

              <!-- Level User -->
              <div class="form-group">
                <label for="nama">Role User<span class="text-danger">*</span></label>
                <select class="form-control select2" name="level_user">
                  <option value="Kepala Desa" <?=isselect("Kepala Desa",@$level_admin)?>>Kepala Desa</option>
                  <option value="Bendahara" <?=isselect("Bendahara",@$level_admin);?>>Bendahara</option>
                  <option value="Sekertaris" <?=isselect("Sekertaris",@$level_admin)?>>Sekertaris</option>
                  <option value="Ketua" <?=isselect("Ketua",@$level_admin)?>>Ketua</option>
                </select>
              </div>

              <!-- Jika Ada Yang Megang UMKM -->
              <div class="form-group">
                <label for="nama">Usaha Unit<span class="text-danger">*</span></label>
                <select class="form-control select2" name="id_unit">
                    <option value="-" <?=isselect('-', @$id_unit)?>>-</option>
                <?php 
                  $query = mysqli_query($mysqli, 'SELECT * FROM tb_unit GROUP BY id_unit ASC');
                  foreach($query as $u){                
                ?>
                    <option value="<?= $u['id_unit'] ?>" <?=isselect($u['id_unit'], @$id_unit)?>><?= $u['nama_unit'] ?></option>
                <?php 
                  }
                ?>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Ubah</button>
              <a href="?hal=user" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>