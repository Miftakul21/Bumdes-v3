<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Laba Rugi <?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_GET['id']."'")?></h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary"> Informasi Laba Rugi</h3>
          <div class="card-tools">
          </div>
        </div>

        <div class="card-body">
          <?php
          $id_unit=$_GET['id'];
            if(isset($_POST['par1'])){
            $par1=$_POST['par1'];
            $par2=$_POST['par2'];
          }else{
            $par1="";
            $par2="";
          }
        ?>
        <form role="form" id="quickForm" action="?hal=lap_laba_rugi&id=<?=$id_unit?>" method="post">
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
          <h3>Pendapatan</h3>
          <table class="table table-bordered table-hover">
            <?php
            $kreditall = 0;
            $pendapatan = 0;
            $query       = "SELECT * FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.id_kegiatan = b.id_kegiatan JOIN tb_akun 
                            AS c ON a.kode_akun = c.kode_akun WHERE c.kode_akun LIKE '4-111' AND (a.tanggal BETWEEN '$par1' AND '$par2') 
                            AND b.id_unit = '$id_unit'"; 
            $resultz     = $mysqli->query($query);
            $num_resultz = $resultz->num_rows;
            if ($num_resultz > 0) {

              while ($dataz = mysqli_fetch_assoc($resultz)) {
                      $kreditall += $dataz['debet'];
                      $kreditall += $dataz['kredit'];
                      $pendapatan =  $pendapatan + $kreditall;
              ?>
                  <tr>
                    <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                    <td width="20%"><?php echo $dataz['nama_akun']; ?></td>
                    <td width="40%"><?php echo $dataz['keterangan_transaksi']; ?></td>
                    <td width="20%"><?php echo number_format($kreditall,0); ?></td>
                  </tr>
              <?php }} ?>
              <th colspan="3">Total Pendapatan</th>
              <th><?=number_format($pendapatan,0)?></th>
            </tbody>
          </table>

          <h3>Pengeluaran</h3>
          <table class="table table-bordered table-hover">
          <?php
          $debetall=0;
          $pengeluaran = 0;
          
          $queryz      = "SELECT * FROM tb_transaksi AS a JOIN tb_kegiatan AS b ON a.`id_kegiatan` = b.`id_kegiatan` JOIN tb_akun 
                          AS c ON a.`kode_akun` = c.`kode_akun` WHERE c.`kode_akun` LIKE '5-11%' AND (a.`tanggal` BETWEEN '$par1' 
                          AND '$par2') AND b.`id_unit` = '$id_unit'";
          $resultz     = $mysqli->query($queryz);
          $num_resultz = $resultz->num_rows;
          if ($num_resultz > 0) {
            while ($dataz = mysqli_fetch_assoc($resultz)) {
              $debetall+=$dataz['debet'];
              $debetall+=$dataz['kredit'];

              $pengeluaran = $pengeluaran + $debetall;
            ?>
              <tr>
                <td width="10%"><?php echo $dataz['kode_akun']; ?></td>
                <td width="20%"><?php echo $dataz['nama_akun']; ?></td>
                <td width="40%"><?php echo $dataz['keterangan_transaksi']; ?></td>
                <td width="20%"><?php echo number_format($debetall,0); ?></td>
              </tr>
            <?php }} ?>
            <tr>
              <th colspan="3">Total Pengeluaran</th>
              <th><?=number_format($pengeluaran,0)?></th>
            </tr>
            <tr>
              <th colspan="3">Laba Rugi Bersih</th>
              <th><?=number_format($pendapatan-$pengeluaran,0)?></th>
            </tr>
          </tbody>
        </table>
      <?php } ?>

    <?php if(isset($_POST['par1'])){
        $unit = $id_unit;
        $per1 = $_POST['par1'];
        $per2 = $_POST['par2'];
    ?>
      <a href="lap_laba_rugi_pdf.php?unit=<?= $unit ?>&periode1=<?= $per1 ?>&periode2=<?= $per2 ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
    <?php } ?>
  </div>
</div>
</div>
</div>
</section>

