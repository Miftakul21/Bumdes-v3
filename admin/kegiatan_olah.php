<?php
$kegiatanname="";
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_kegiatan","id_kegiatan='$kode'"));
}
?>

<!-- Main content -->
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Olah Data Kegiatan Unit</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="kegiatan_proses.php" method="post">

            <div class="card-body">

              <input type="hidden" name="id_kegiatan" value="<?=$id_kegiatan;?>">

              <div class="form-group">
                <label for="nama">Unit Usaha</label>
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
                <label for="nama">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" value="<?=@$nama_kegiatan?>" placeholder="Inputkan Nama kegiatan" required="">
              </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="<?=isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan">
              <a href="?hal=kegiatan" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
                      <!-- /.content -->