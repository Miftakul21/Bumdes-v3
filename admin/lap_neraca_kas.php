<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Neraca</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">Informasi Laporan Neraca</h3>
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
        <form role="form" id="quickForm" action="?hal=lap_neraca_kas" method="post">
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
        <?php if(isset($_POST['periode1'])){ ?>
          <h3>Aktifa</h3>
          <table class="table table-bordered table-hover">
            <tr>
              <th colspan="4">Aktifa Lancar</th>
            </tr>
          <?php
          $debetall=0;
          $queryz      = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN tb_akun USING (kode_akun) WHERE 
                        tb_akun.`kode_akun` LIKE '1-1%' AND (tb_kas.`tanggal` BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun, nama_akun";

          $_SESSION['laporan']['sql1']=$queryz;
          $resultz     = $mysqli->query($queryz);
          $num_resultz = $resultz->num_rows;
          if ($num_resultz > 0) {

            while ($dataz = mysqli_fetch_assoc($resultz)) {
              $debetall+=$dataz['debet'];
              ?>
              <tr>
                <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
                <td width="20%"><?php echo number_format($dataz['debet'],0); ?></td>
              </tr>
          <?php }} ?>
            <tr>
              <th colspan="2">Total</th>
              <th><?=number_format(($debetall),0)?></th>
            </tr>
          <tr>
            <th colspan="4">Aktifa Tetap</th>
          </tr>
          <?php
          $debetall=0;
          $queryz      = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN tb_akun USING (kode_akun) WHERE 
                        tb_akun.`kode_akun` LIKE '1-2%' AND (tb_kas.`tanggal` BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun, nama_akun;";
          $_SESSION['laporan']['sql2']=$queryz;

          $resultz     = $mysqli->query($queryz);
          $num_resultz = $resultz->num_rows;
          if ($num_resultz > 0) {
            while ($dataz = mysqli_fetch_assoc($resultz)) {
              $debetall+=$dataz['debet'];
              ?>
              <tr>
                <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
                <td width="20%"><?php echo number_format($dataz['debet'],0); ?></td>
              </tr>
          <?php }} ?>
            <tr>
              <th colspan="2">Total</th>
              <th><?=number_format(($debetall),0)?></th>
            </tr>
        </tbody>
      </table>

      <h3>Pasiva</h3>
      <table class="table table-bordered table-hover">
        <?php
        $debetall=0;
        $queryz      = "SELECT (SUM(debet) - SUM(kredit)) AS debet, kode_akun, nama_akun FROM tb_kas JOIN tb_akun USING (kode_akun) WHERE 
                        tb_akun.`kode_akun` LIKE '2%' AND (tb_kas.`tanggal` BETWEEN '$periode1' AND '$periode2') GROUP BY kode_akun, nama_akun";
        
        $_SESSION['laporan']['sql3']=$queryz;
        $resultz     = $mysqli->query($queryz);
        $num_resultz = $resultz->num_rows;
        if ($num_resultz > 0) {
          while ($dataz = mysqli_fetch_assoc($resultz)) {
            $debetall+=$dataz['debet'];
            ?>
            <tr>
              <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
              <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
              <td width="18%"><?php echo number_format($dataz['debet'],0); ?></td>
            </tr>
        <?php }} ?>
          <tr>
            <th colspan="2">Total Pasifa</th>
            <th><?=number_format(($debetall),0)?></th>
          </tr>
      </tbody>
    </table>
  <?php } ?>

  <?php 
    if(isset($_POST['periode1'])){
        $periode1 = $_POST['periode1'];
        $periode2 = $_POST['periode2'];
    ?>
        <a href="lap_neraca_kas_pdf.php?periode1=<?= $periode1 ?>&periode2=<?= $periode2 ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
    <?php } ?>

</div>
</div>
</div>
</div>
</section>

