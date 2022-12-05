<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Buku Besar <?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_GET['id']."'")?></h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">Data Transaksi </h3>
        </div>
        <div class="card-body">
          <?php
          $id_unit=$_GET['id'];
          if(isset($_POST['par1'])){
            $par1=$_POST['par1'];
            $par2=$_POST['par2'];
            $id_akun=$_POST['id_akun'];

            if($_POST['id_akun']=='Semua')
              $where="where id_unit='$id_unit' and (tanggal between '$par1' and '$par2')";
            else
              $where="where id_unit='$id_unit' and (tanggal between '$par1' and '$par2') and kode_akun='$id_akun'";
          }else{
            $par1="";
            $par2="";
            $id_akun="";

            $where="where id_unit='$id_unit'";
          }
          ?>
          <form role="form" id="quickForm" action="?hal=lap_buku_besar&id=<?=$id_unit?>" method="post">
            <div class="form-group row">
              <label for="nama" class="col-1 m-2">Akun</label>
              <select class="form-control select2 col-3" name="id_akun">
                <option value="Semua">Semua Akun</option>
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
                    <td><?php echo $keterangan_transaksi; ?></td>
                    <td><?php echo number_format($debet,0); ?></td>
                    <td><?php echo number_format($kredit,0); ?></td>
                    <th><?php echo number_format($saldo,0); ?></th>
                  </tr>
                <?php }}?>
              </table>
              <?php if(isset($_POST['par1'])){
                $par1 = $_POST['par1'];
                $par2 = $_POST['par2'];

                $kode_akun = $_POST['id_akun'];
                $unit=$id_unit;

                $kode_akun1 = isset($_POST['id_akun']) ? $_POST['id_akun'] : "";
                $queryz = mysqli_query($mysqli, "SELECT * FROM tb_akun WHERE kode_akun = '$kode_akun1'");
                $dataz = mysqli_fetch_array($queryz);
                $nama_akun = isset($dataz['nama_akun']) ? $dataz['nama_akun']: "Semua";

                $resultz = ($kode_akun == "semua") ? "Semua" : $nama_akun;

              ?>
                <a href="lap_buku_besar_pdf.php?akun=<?= $kode_akun; ?>&periode1=<?= $par1 ?>&periode2=<?= $par2?>&unit=<?= $unit ?>&nama_akun=<?= $resultz ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>