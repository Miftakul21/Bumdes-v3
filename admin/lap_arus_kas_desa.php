<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Arus Kas Bumdes Minggirsari</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">Informasi Arus Kas Desa</h3>
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
        <?php
            if(isset($_POST['periode1'])){
              $periode1=$_POST['periode1'];
              $periode2=$_POST['periode2'];
            }else{
              $periode1="";
              $periode2="";
            }
        ?>
        <form role="form" id="quickForm" action="?hal=lap_arus_kas_desa" method="post">
          <div class="form-group row">
            <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
            <input type="date" name="periode1" class="form-control col-2" value="<?=@$periode1?>" required="">
            <span class="col-1 m-2">S/d</span>
            <input type="date" name="periode2" class="form-control col-2" value="<?=@$periode2?>" required="">
            <div class="col-4">
              <input type="submit" name="proses" class="btn btn-primary" style="float: right" value="Proses">
            </div>
          </div>
        </form>
        <hr>
        <?php if(isset($_POST['periode1'])){
          $query      = "SELECT * from tb_index where id_index !=0 order by keterangan asc";
          $result     = $mysqli->query($query);
          $num_result = $result->num_rows;
          if ($num_result > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
              extract($data);
              ?>
              <table id="" class="table table-bordered table-hover mb-3">
                <thead>
                  <tr>
                    <th width="40%"><?=$keterangan?></th>
                    <th width="20%">Debet</th>
                    <th width="20%">Kredit</th>
                    <th width="20%">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $debetall=0;
                  $kreditall=0;
                  $queryz      = "SELECT a.* FROM tb_kas AS a JOIN tb_index AS b ON a.`sumber` = b.`id_index` WHERE a.sumber = '$id_index' AND (a.`tanggal` BETWEEN '$periode1' AND '$periode2')";
                  $resultz     = $mysqli->query($queryz);
                  $num_resultz = $result->num_rows;
                  if ($num_result > 0) {
                    while ($dataz = mysqli_fetch_assoc($resultz)) {
                      $debetall+=$dataz['debet'];
                      $kreditall+=$dataz['kredit'];
                      ?>
                      <tr>
                        <td><?php echo $dataz['keterangan']; ?></td>
                        <td><?php echo number_format($dataz['debet'],0); ?></td>
                        <td><?php echo number_format($dataz['kredit'],0); ?></td>
                      </tr>
                    <?php }} ?>
                    <th colspan="3">Total Keseluruhan :</th>
                    <th>Rp. <?=number_format(($debetall-$kreditall),0)?></th>
                  </tbody>
                </table>
              <?php } } } ?>

              <?php 
                /*
                if(isset($_POST['par1'])){
                $_SESSION['laporan']['judul']="Laporan Arus Kas";
                $_SESSION['laporan']['periode'] =tgl_indo($_POST['par1'])." S/d ".tgl_indo($_POST['par2']);
                $_SESSION['laporan']['sql']=$query;
                $_SESSION['laporan']['sql1']=" and id_unit='$id_unit' and (tanggal between '".$_POST['par1']."' and '".$_POST['par2']."')";
                $_SESSION['laporan']['unit']=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_SESSION['id']."'");
                */
              ?>
                <!-- <a href="lap_arus_kas_pdf.php" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a> -->
              <?php 
                // } 
            ?>
            </div>
          </div>
        </div>
      </div>
</section>
