<?php
$username="";
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_index join tb_transaksi using(id_index) join tb_akun using(kode_akun) join tb_kegiatan using(id_kegiatan)","id_jurnal='$kode'"));
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
            <h3 class="card-title">Ubah Data Transaksi</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="transaksi_proses.php" method="post">

            <div class="card-body">

              <input type="hidden" name="id_jurnal" value="<?=$id_jurnal;?>">

              <div class="form-group row">
                <label for="nama" class="col-sm-2">No Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control col-sm-5" value="<?=@$id_transaksi?>" readonly>
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-2">Tanggal Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control col-sm-5" value="<?=@tgl_indo($tanggal_transaksi)?>" readonly>
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-2">Index</label>
                <select class="form-control select2 col-sm-5" name="id_index">
                 <?php
                 $query="SELECT * from tb_index";
                 $result=$mysqli->query($query);
                 $num_result=$result->num_rows;
                 if ($num_result > 0 ) { 
                  $no=0;
                  while ($data=mysqli_fetch_assoc($result)) { ?>
                    <option value="<?=$data['id_index']?>" <?=isselect($data['id_index'],$id_index)?>><?=$data['id_index'].' '.$data['keterangan']?></option>
                  <?php }
                }
                ?>
              </select>
            </div>

            <div class="form-group row">
              <label for="nama" class="col-sm-2">Akun</label>
              <select class="form-control select2 col-sm-5" name="kode_akun">
               <?php
               $query="SELECT * from tb_akun";
               $result=$mysqli->query($query);
               $num_result=$result->num_rows;
               if ($num_result > 0 ) { 
                $no=0;
                while ($data=mysqli_fetch_assoc($result)) { ?>
                  <option value="<?=$data['kode_akun']?>" <?=isselect($data['kode_akun'],$kode_akun)?>><?=$data['kode_akun'].' '.$data['nama_akun']?></option>
                <?php }
              }
              ?>
            </select>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-2">Keterangan</label>
            <input type="text" name="keterangan" class="form-control col-sm-5" value="<?=@$keterangan?>" required>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-2">Jenis Usaha</label>
            <select class="form-control select2 col-sm-5" name="id_kegiatan">
              <?php
              $query="SELECT * from tb_kegiatan where id_unit='$id_unit'";
              $result=$mysqli->query($query);
              $num_result=$result->num_rows;
              if ($num_result > 0 ) { 
                $no=0;
                while ($data=mysqli_fetch_assoc($result)) { ?>
                  <option value="<?=$data['id_kegiatan']?>" <?=isselect($data['id_kegiatan'],$id_kegiatan)?>><?=$data['nama_kegiatan']?></option>
                <?php }
              }
              ?>
            </select>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-2">Debit</label>
            <input type="number" name="debet" class="form-control col-sm-5" value="<?=@$debet?>" required>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-2">Kredit</label>
            <input type="number" name="kredit" class="form-control col-sm-5" value="<?=@$kredit?>" required>
          </div>


        </div>

        <!-- /.card-body -->
        <div class="card-footer">
          <input type="submit" name="ubah" 
          class="btn btn-primary offset-2" value="Simpan">
          <a href="?hal=transaksi_data" class="btn btn-default">
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