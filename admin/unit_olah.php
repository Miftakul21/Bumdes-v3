<?php
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_unit","id_unit='$kode'"));
}else{
  $nama_unit="";
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
            <h3 class="card-title">Olah Data Unit Usaha</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="unit_proses.php" method="post">

            <div class="card-body">

              <input type="hidden" name="kode" value="<?=$id_unit;?>">

              <div class="form-group">
                <label for="nama">Nama Unit</label>
                <input type="text" name="nama_unit" class="form-control" value="<?=@$nama_unit?>" placeholder="Inputkan Nama Unit" required="">
              </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="<?=isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan">
              <a href="?hal=unit" class="btn btn-default">
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