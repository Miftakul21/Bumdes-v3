<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Jurnal Umum <?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_SESSION['id']."'")?></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">Data Jurnal Umum </h3>
        </div>
        <div class="card-body">
          <?php
          $id_unit=$_SESSION['id'];
          $where = '';
          
          if(isset($_POST['par1'])){

            @$par1=$_POST['par1'];
            @$par2=$_POST['par2'];
            @$id_kegiatan=$_POST['id_kegiatan'];

            if($_POST['id_kegiatan']=='Semua')
              $where="WHERE tb_unit.`id_unit` = '$id_unit' AND (tb_transaksi.tanggal between '$par1' AND '$par2')";
            else
              $where="WHERE tb_transaksi.`id_kegiatan` = '$id_kegiatan' AND tb_unit.`id_unit` 
                      AND (tb_transaksi.tanggal between '$par1' AND '$par2')";

          }else{
            $par1="";
            $par2="";
            $id_kegiatan="";
            $where = "WHERE tb_unit.`id_unit` = '$id_unit'";
          }
          ?>
          <form role="form" id="quickForm" action="?hal=lap_jurnal_umum&id=<?=$id_unit?>" method="post">
            <div class="form-group row">
              <label for="nama" class="col-1 m-2">Usaha</label>
              <select class="form-control select2 col-3" name="id_kegiatan">
                <option value="Semua">Semua Usaha</option>
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
                <th>Usaha</th>
                <th>Keterangan</th>
                <th>Kode Akun</th>
                <th>Sumber Dana</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $saldo=0;
              // $query      = "SELECT * from tb_transaksi join tb_kegiatan using(id_kegiatan) join tb_index using (id_index) $where";
              $query = "SELECT * FROM tb_transaksi JOIN tb_kegiatan ON tb_transaksi.`id_kegiatan` = tb_kegiatan.`id_kegiatan` 
                        JOIN tb_unit ON tb_kegiatan.`id_unit` = tb_unit.`id_unit` JOIN tb_index ON tb_transaksi.`id_index` = 
                        tb_index.`id_index`".$where;
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
                    <td><?php echo $keterangan_transaksi; ?></td>
                    <td><?php echo $kode_akun; ?></td>
                    <td><?php echo $keterangan; ?></td>
                    <td><?php echo number_format($debet,0); ?></td>
                    <td><?php echo number_format($kredit,0); ?></td>
                    <th><?php echo number_format($saldo,0); ?></th>
                  </tr>
                <?php }}?>
              </table>
              <?php if(isset($_POST['par1'])){
                $par1 = $_POST['par1'];
                $par2 = $_POST['par2'];

                $id_kegiatan = $_POST['id_kegiatan'];
                $unit=$_SESSION['id'];
              ?>
                <a href="lap_jurnal_umum_pdf.php?id_kegiatan=<?= $id_kegiatan; ?>&periode1=<?= $par1 ?>&periode2=<?= $par2?>&unit=<?= $unit ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>

