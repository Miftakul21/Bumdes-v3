<?php
$tgl=date('ymd');
$id_transaksi=KodeOtomatis($mysqli,"tb_transaksi","id_transaksi","T$tgl-",8,3);
$id_unit=$_SESSION['id'];


if(isset($_GET['get'])){
  $tanggal=$_SESSION['tanggal'];
  $keterangan=$_SESSION['keterangan'];
  $id_kegiatan=$_SESSION['kegiatan'];

}else{
  $tanggal='';
  $keterangan='';
  $id_kegiatan='';
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
            <h3 class="card-title">Jurnal Transaksi [Nama Usaha]</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="transaksi_proses.php" method="post">

            <div class="card-body">

              <div class="form-group row">
                <label for="nama" class="col-sm-4">No Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control col-sm-8" value="<?=@$id_transaksi?>" placeholder="No Transaksi" readonly>
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-4">Tanggal</label>
                <input type="date" name="tanggal" class="form-control col-sm-8" value="<?=@$tanggal?>" max="<?=date('Y-m-d')?>" placeholder="Inputkan Tanggal" required="">
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-4">Jenis Usaha</label>
                <select class="form-control select2 col-sm-8" name="id_kegiatan" required="">
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
                <label for="nama" class="col-sm-4">Keterangan</label>
                <input type="text" name="keterangan" class="form-control col-sm-8" value="<?=@$keterangan?>" placeholder="Inputkan Keterangan" required="">
              </div>

              <hr>
              <table class="table table-bordered table-hover">
                <tr id="input">
                  <th> Kode Akun</th>
                  <th> Index</th>
                  <th> Debet</th>
                  <th> Kredit</th>
                  <th>#</th>
                </tr>
                <tr>
                  <th>
                    <select class="form-control select2" name="id_akun">
                     <?php
                     $query="SELECT * from tb_akun";
                     $result=$mysqli->query($query);
                     $num_result=$result->num_rows;
                     if ($num_result > 0 ) { 
                      $no=0;
                      while ($data=mysqli_fetch_assoc($result)) { ?>
                        <option value="<?=$data['kode_akun']?>"><?=$data['kode_akun'].' '.$data['nama_akun']?></option>
                      <?php }
                    }
                    ?>
                  </select>
                </th>
                <th>
                  <select class="form-control select2" name="id_index">
                   <?php
                   $query="SELECT * from tb_index";
                   $result=$mysqli->query($query);
                   $num_result=$result->num_rows;
                   if ($num_result > 0 ) { 
                    $no=0;
                    while ($data=mysqli_fetch_assoc($result)) { ?>
                      <option value="<?=$data['id_index']?>"><?=$data['id_index'].' '.$data['keterangan']?></option>
                    <?php }
                  }
                  ?>
                </select>
              </th>
              <th><input type="number" class="form-control" name="debet" value="0" min="0"></th>
              <th><input type="number" class="form-control" name="kredit" value="0" min="0"></th>
              <th><input type="submit" name="tambah" class="btn btn-primary" value="Tambah"></th>
            </tr>
            <tbody>
              <?php
              $debitall=0;
              $kreditall=0;
              if (isset($_SESSION['transaksi'])){
              foreach ($_SESSION['transaksi'] as $key => $value) {
                ?>
                <tr>
                  <td><?=$value['0']; ?></td>
                  <td><?=$value['1']; ?></td>
                  <td><?=number_format($value['2'],0);$debitall+=$value['2']; ?></td>
                  <td><?=number_format($value['3'],0);$kreditall+=$value['3']; ?></td>
                </td>

                <td width="15%">

                  <a class="btn btn-danger" title="Hapus Data" href="transaksi_proses.php?hapus=<?=$key; ?>"
                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                  </td>
                </tr>
              <?php } } ?>
            </tbody>

            <tr> 
              <th colspan="2">Total</th>
              <th><?=number_format($debitall,0)?></th>
              <th><?=number_format($kreditall,0)?></th>
              <th> <a class="btn btn-danger" title="Hapus Semua" href="transaksi_proses.php?hapusall=1; ?>"
                onclick="return confirm('Apakah anda yakin akan menghapus semua transaksi ?')">Clear</a></th>
              </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="simpan" 
              class="btn btn-primary" value="Simpan">
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