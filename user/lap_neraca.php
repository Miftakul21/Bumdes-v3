<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Neraca <?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_SESSION['id']."'")?></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary"> Informasi Laporan Neraca</h3>
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
        <?php
          $id_unit=$_SESSION['id'];
          if(isset($_POST['par1'])){
              $par1=$_POST['par1'];
              $par2=$_POST['par2'];
          }else{
              $par1="";
              $par2="";
          }
        ?>
        <form role="form" id="quickForm" action="?hal=lap_neraca&id=<?=$id_unit?>" method="post">
          <div class="form-group row">
            <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
            <input type="date" name="par1" class="form-control col-2" value="<?=@$par1?>" required="">
            <span class="col-1 m-2">S/d</span>
            <input type="date" name="par2" class="form-control col-2" value="<?=@$par2?>" required="">
            <div class="col-4">
              <input type="submit" name="proses" class="btn btn-primary" style="float: right" value="Proses">
            </div>
          </div>
        </form>
        <hr>
        <?php if(isset($_POST['par1'])){ ?>
          <h3>Aktifa</h3>
          <table class="table table-bordered table-hover">
          <tr>
            <th colspan="4">Aktifa Lancar</th>
          </tr>
          <?php
            $aktifa_lancar = 0;
            $temp1 = 0;
            $queryz1      = "SELECT *, SUM(a.`debet`) AS Debet, SUM(a.`kredit`) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan
                            JOIN tb_akun AS c ON a.kode_akun = c.kode_akun WHERE c.kode_akun LIKE '1-1%' AND b.id_unit = '$id_unit' AND (a.tanggal BETWEEN 
                            '$par1' AND '$par2') GROUP BY c.kode_akun, c.nama_akun";

            $resultz1     = $mysqli->query($queryz1);
            $num_resultz = $resultz1->num_rows;
            if ($num_resultz > 0) {
              while ($dataz = mysqli_fetch_assoc($resultz1)) {
                  $temp1 += $dataz['Debet'];
                  $temp1 += $dataz['Kredit'];

                  $aktifa_lancar = $aktifa_lancar + $temp1;
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
            $queryz2      = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan 
                            JOIN tb_akun AS c ON a.kode_akun = c.kode_akun LIKE '1-2%' AND b.id_unit = '$id_unit' AND (a.tanggal BETWEEN '$par1' AND '$par2') 
                            GROUP BY c.kode_akun, c.nama_akun";

            $resultz2     = $mysqli->query($queryz2);
            $num_resultz = $resultz2->num_rows;
            if ($num_resultz > 0) {
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
          $temp3 = 0;
          $passiva = 0;
          $queryz3      = "SELECT *, SUM(a.debet) AS Debet, SUM(a.kredit) AS Kredit FROM tb_transaksi AS a JOIN tb_kegiatan AS b 
                          ON a.id_kegiatan = b.id_kegiatan JOIN tb_akun AS c ON a.kode_akun = c.kode_akun LIKE '2%' AND b.id_unit = '$id_unit' 
                          AND (a.tanggal BETWEEN '$par1' AND '$par2') GROUP BY c.kode_akun, c.nama_akun";

          $resultz3     = $mysqli->query($queryz3);
          $num_resultz = $resultz3->num_rows;
          if ($num_resultz > 0) {
            while ($dataz = mysqli_fetch_assoc($resultz3)) {
              $temp3 += $dataz['Debet'];
              $temp3 += $dataz['Kredit'];

              $passiva = $passiva + $temp3;
        ?>
          <tr>
              <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
              <td width="50%"><?php echo $dataz['nama_akun']; ?></td>
              <td width="20%"><?php echo number_format($temp3,0); ?></td>
          </tr>
        <?php }} ?>
          <tr>
            <th colspan="2">Total Pasifa</th>
            <th><?=number_format($passiva,0)?></th>
          </tr>
        </tbody>
    </table>
  <?php } ?>
  <?php if(isset($_POST['par1'])){
      $unit = $_SESSION['id'];
      $periode1 = $_POST['par1'];
      $periode2 = $_POST['par2'];
    ?>
    <a href="lap_neraca_pdf.php?unit=<?= $unit ?>&periode1=<?= $periode1 ?>&periode2=<?= $periode2 ?>" target="_blank" style="float: right;margin-top: 10px;" 
    class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
  <?php } ?>
</div>
</div>
</div>
</div>
</section>

