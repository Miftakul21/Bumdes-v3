<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Transaksi Keuangan [<?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_GET['id']."'")?>]</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">Data Transaksi </h3>
          <div class="card-tools">
          </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <?php
          $id_unit=$_GET['id'];
          if(isset($_POST['par1'])){


            $par1=$_POST['par1'];
            $par2=$_POST['par2'];
            $id_akun=$_POST['id_akun'];

            if($_POST['id_akun']!='semua')
              $where="where id_unit='$id_unit' and (tanggal between '$par1' and '$par2') and kode_akun='$id_akun'";
            else
              $where="where id_unit='$id_unit' and (tanggal between '$par1' and '$par2')";

        }else{
          $par1="";
          $par2="";
          $id_akun="";

          $where="where id_unit='$id_unit'";
        }
        ?>
        <form role="form" id="quickForm" action="?hal=transaksi_data&id=<?=$id_unit?>" method="post">
          <div class="form-group row">
            <label for="nama" class="col-1 m-2">Akun</label>
            <select class="form-control select2 col-3" name="id_akun">
              <option value="semua">Semua</option>
              <?php
              $query="SELECT * from tb_akun";
              $result=$mysqli->query($query);
              $num_result=$result->num_rows;
              if ($num_result > 0 ) { 
                $no=0;
                while ($data=mysqli_fetch_assoc($result)) { ?>
                  <option value="<?=$data['kode_akun']?>" <?=isselect(@$id_akun,$data['kode_akun'])?>><?=$data['kode_akun'].' '.$data['nama_akun']?></option>
                <?php }
              }
              ?>
            </select>
            <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
            <input type="date" name="par1" class="form-control col-2" value="<?=@$par1?>" required="">
            <input type="date" name="par2" class="form-control col-2" value="<?=@$par2?>" required="">
            <div class="col-1">
              <input type="submit" name="proses" class="btn btn-primary" style="float: right" value="Proses">
            </div>
          </div>
        </form>

        <hr>

        <table id="example3" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No Transaksi</th>
              <th>Tanggal</th>
              <th>Keterangan Transaksi</th>
              <th>Debet</th>
              <th>Kredit</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $saldo=0;
            $query      = "SELECT * from tb_transaksi $where";
            $result     = $mysqli->query($query);
            $num_result = $result->num_rows;
            if ($num_result > 0) {
              $no = 0;
              while ($data = mysqli_fetch_assoc($result)) {
                extract($data);
                $saldo+=$debet;
                $saldo-=$kredit;
                ?>
                <tr>
                  <td><?php echo $id_transaksi; ?></td>
                  <td><?php echo tgl_indo($tanggal); ?></td>
                  <td><?php echo $keterangan; ?></td>
                  <td><?php echo number_format($debet,0); ?></td>
                  <td><?php echo number_format($kredit,0); ?></td>
                  <th><?php echo number_format($saldo,0); ?></th>
                </tr>
              <?php }}?>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

