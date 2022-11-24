<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"tb_kegiatan","id_kegiatan='$kode'"));
}
?>
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <?php  
    if(isset($_SESSION['gagal'])) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><?= $_SESSION['gagal']; ?></strong>
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
            <h3 class="card-title">Data Kegiatan Unit</h3>
          </div>
          <form role="form" id="quickForm" action="operasi_crud/kegiatan/update.php" method="post">
            <div class="card-body">
              <input type="hidden" name="id_kegiatan" value="<?=$id_kegiatan;?>">
              <div class="form-group">
                <label for="nama">Unit Usaha<span class="text-danger">*</span></label>
                <select class="form-control select2" name="id_unit">
                <?php
                    $query="SELECT * from tb_unit";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        $no=0;
                        while ($data=mysqli_fetch_assoc($result)) { ?>
                        <option value="<?=$data['id_unit']?>" <?=isselect($data['id_unit'],$id_unit)?>><?=$data['nama_unit']?></option>
                        <?php }
                    }
                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nama">Nama Kegiatan<span class="text-danger">*</span></label>
                <input type="text" name="nama_kegiatan" class="form-control" value="<?=@$nama_kegiatan?>" required="">
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Simpan</button>
              <a href="?hal=kegiatan" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>