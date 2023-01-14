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
          
          $aktifa_lancar = 0;
          $temp1 = 0;
          $queryz1      = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_kas AS a 
                          JOIN tb_akun AS b ON a.kode_akun = b.kode_akun WHERE a.kode_akun LIKE '1-1%' 
                          AND (a.tanggal BETWEEN '$periode1' AND '$periode2') GROUP BY b.kode_akun";
          $resultz1     = $mysqli->query($queryz1);
          $num_resultz1 = $resultz1->num_rows;
          if ($num_resultz1 > 0) {
            while ($dataz = mysqli_fetch_assoc($resultz1)) {
              $temp1 += $dataz['Debet'];
              $temp1 += $dataz['Kredit'];
              $aktifa_lancar = $aktifa_lancar +  $temp1;
          ?>
              <tr>
                <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
                <td width="20%"><?php echo number_format($temp1,0); ?></td>
              </tr>
          <?php }} ?>
            <tr>
              <th colspan="2">Total</th>
              <th><?=number_format($aktifa_lancar,0)?></th>
            </tr>
          <tr>
            <th colspan="4">Aktifa Tetap</th>
          </tr>
          <?php
          $aktifa_tetap = 0;
          $temp2 = 0;
          $queryz2      = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_kas AS a JOIN 
                          tb_akun AS b ON a.kode_akun = b.kode_akun WHERE a.kode_akun LIKE '1-2%' AND 
                          (a.tanggal BETWEEN '$periode1' AND '$periode2') GROUP BY b.kode_akun, b.`nama_akun`";

          $resultz2     = $mysqli->query($queryz2);
          $num_resultz2 = $resultz2->num_rows;
          if ($num_resultz2 > 0) {
            while ($dataz = mysqli_fetch_assoc($resultz2)) {
                $temp2 += $dataz['Debet'];
                $temp2 += $dataz['Kredit'];

                $aktifa_tetap = $aktifa_tetap + $temp2;
          ?>
              <tr>
                <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
                <td width="20%"><?php echo number_format($temp2,0); ?></td>
              </tr>
          <?php }} ?>
            <tr>
              <th colspan="2">Total</th>
              <th><?=number_format($aktifa_tetap,0)?></th>
            </tr>
        </tbody>
      </table>

      <h3>Pasiva</h3>
      <table class="table table-bordered table-hover">
        <?php
        $passiva = 0;
        $temp3 = 0;
        $queryz3      = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_kas AS a JOIN tb_akun 
                        AS b ON a.kode_akun = b.kode_akun WHERE a.kode_akun LIKE '2%' AND (a.tanggal BETWEEN 
                        '$periode1' AND '$periode2') GROUP BY b.kode_akun, b.`nama_akun`";
        
        $resultz3     = $mysqli->query($queryz3);
        $num_resultz3 = $resultz3->num_rows;
        if ($num_resultz3 > 0) {
          while ($dataz = mysqli_fetch_assoc($resultz3)) {
            $temp3 += $dataz['Debet'];
            $temp3 += $dataz['Kredit'];

            $passiva = $passiva + $temp3;
        ?>
            <tr>
              <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
              <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
              <td width="18%"><?php echo number_format($temp3,0); ?></td>
            </tr>
        <?php }} ?>
          <tr>
            <th colspan="2">Total Pasifa</th>
            <th><?=number_format($passiva,0)?></th>
          </tr>
      </tbody>
    </table>
  <?php } ?>

  <?php 
    if(isset($_POST['periode1'])){
        $periode1 = $_POST['periode1'];
        $periode2 = $_POST['periode2'];
    ?>
        <a href="lap_neraca_kas_pdf.php?periode1=<?= $periode1 ?>&periode2=<?= $periode2 ?>" 
        target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
    <?php } ?>

</div>
</div>
</div>
</div>
</section>

