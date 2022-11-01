<?php
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_akun","kode_akun='$kode'"));
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
            <h3 class="card-title">Olah Data Akun</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="akun_proses.php" method="post">

            <div class="card-body">

              <div class="form-group">
                <label for="nama">Kode Akun</label>
                <input type="text" name="kode_akun" class="form-control" value="<?=@$kode_akun?>" placeholder="Inputkan Kode Akun" required="" <?=isset($_GET['id'])?'readonly':'';?>>
              </div>

              <div class="form-group">
                <label for="nama">Nama Akun</label>
               <input type="text" name="nama_akun" class="form-control" value="<?=@$nama_akun?>" placeholder="Inputkan Nama Akun" required="">
              </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="<?=isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan">
              <a href="?hal=akun" class="btn btn-default">
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