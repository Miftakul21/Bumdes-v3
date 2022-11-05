<!-- Main content -->
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Akun</h3>
          </div>
          <!-- form start -->
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

            <!-- /.card-body -->
            <div class="card-footer">
              <!-- <input type="submit" name="<?php //isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan"> -->
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