<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Transaksi Keuangan [<?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_SESSION['id']."'")?>]</h1>
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
          unset($_SESSION['transaksi']);
          $id_unit=$_SESSION['id'];
          if(isset($_POST['par1'])){


            $par1=$_POST['par1'];
            $par2=$_POST['par2'];
            $id_akun=$_POST['id_akun'];
            $id_kegiatan=$_POST['id_kegiatan'];

            if($_POST['id_akun']!='semua')
              $where="where tb_kegiatan.id_unit='$id_unit' and (tanggal between '$par1' and '$par2') and kode_akun='$id_akun' and id_kegiatan='$id_kegiatan'";
            else
             $where="where tb_kegiatan.id_unit='$id_unit' and (tanggal between '$par1' and '$par2') and id_kegiatan='$id_kegiatan'";

         }else{
          $par1="";
          $par2="";
          $id_akun="";
          $id_kegiatan="";


          $where="where id_unit='$id_unit'";
        }
        ?>
        <form role="form" id="quickForm" action="?hal=transaksi_data" method="post">
          <div class="form-group row">
            <label for="nama" class="col-2 m-2">Akun</label>
            <select class="form-control select2 col-sm-3" name="id_akun">
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

            <label for="nama" class="col-2 m-2">Unit Usaha</label>
            <select class="form-control select2 col-3" name="id_kegiatan">
              <?php
              $query="SELECT * from tb_kegiatan where id_unit='$id_unit'";
              $result=$mysqli->query($query);
              $num_result=$result->num_rows;
              if ($num_result > 0 ) { 
                $no=0;
                while ($data=mysqli_fetch_assoc($result)) { ?>
                  <option value="<?=$data['id_kegiatan']?>" <?=isselect(@$id_kegiatan,$data['id_kegiatan'])?>><?=$data['nama_kegiatan']?></option>
                <?php }
              }
              ?>
            </select>
          </div>

          <div class="form-group row">

            <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
            <input type="date" name="par1" class="form-control col-2" max="<?=date('Y-m-d');?>" value="<?=@$par1?>" required="">
            <span class="col-1 m-2" style="align:center;"> S/d </span>
            <input type="date" name="par2" class="form-control col-2" max="<?=date('Y-m-d');?>" value="<?=@$par2?>" required="">
            <div class="col-2">
              <input type="submit" name="proses" class="btn btn-primary" style="float: left" value="Proses">
              <a href="?hal=transaksi_data"  style="float: right" class="btn btn-success">Reset</a>
            </div>
          </div>
        </form>

        <hr>

        <table id="example3" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No Transaksi</th>
              <th>Tanggal</th>
              <th>Usaha</th>
              <th>Keterangan</th>
              <th>Debet</th>
              <th>Kredit</th>
              <th>Saldo</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $saldo=0;
            $query      = "SELECT * from tb_transaksi join tb_kegiatan using(id_kegiatan) $where";
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
                  <td><?php echo $nama_kegiatan; ?></td>
                  <td><?php echo $keterangan; ?></td>
                  <td><?php echo number_format($debet,0); ?></td>
                  <td><?php echo number_format($kredit,0); ?></td>
                  <th><?php echo number_format($saldo,0); ?></th>
                  <td width="15%">

                    <a href="?hal=transaksi_edit&id=<?php echo $id_jurnal; ?>"
                      class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i> </a>

                      <a class="btn btn-danger" title="Hapus Data" href="transaksi_proses.php?hapusdb=<?php echo $id_jurnal; ?>"
                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                      </td>
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

