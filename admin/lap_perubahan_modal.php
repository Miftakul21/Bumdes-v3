<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0 text-dark">Laporan Perbahan Modal <?=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_GET['id']."'")?></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary"> Informasi Perubahan Modal</h3>
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
        <form role="form" id="quickForm" action="?hal=lap_perubahan_modal&id=<?=$id_unit?>" method="post">
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
        <?php if(isset($_POST['par1'])){ 
          $modal=caridata($mysqli,"select sum(kredit) from tb_transaksi join tb_kegiatan using(id_kegiatan) where(tanggal between '$par1' and '$par2') and id_unit='$id_unit' and kode_akun='3-111'");
          $prive=caridata($mysqli,"select sum(debet) from tb_transaksi join tb_kegiatan using(id_kegiatan) where (tanggal between '$par1' and '$par2') and id_unit='$id_unit' and kode_akun='3-211'");          
          $pendapatan=caridata($mysqli,"select sum(kredit) from tb_transaksi join tb_kegiatan using(id_kegiatan) where (tanggal between '$par1' and '$par2') and id_unit='$id_unit' and kode_akun='4-111'");          
          $bebangaji=caridata($mysqli,"select sum(debet) from tb_transaksi join tb_kegiatan using(id_kegiatan) where (tanggal between '$par1' and '$par2') and id_unit='$id_unit' and kode_akun like '5%'");          
          $labarugi=$pendapatan-$bebangaji;
          $modalakhir=$modal-$prive+$labarugi;
          ?>
          <table id="" class="table table-bordered table-hover">
            <tbody>
              <tr>
                <th width="50%"> Modal di setor </th>
                <th><?=number_format($modal,0)?></th>
              </tr>
              <tr>
                <th width="50%"> Prive </th>
                <th><?=number_format($prive,0)?></th>
              </tr>
              <tr>
                <th width="50%"> Laba / Rugi Bersih </th>
                <th><?=number_format($labarugi,0)?></th>
              </tr>
              <tr>
                <th width="50%"> Modal Akhir </th>
                <th><?=number_format($modalakhir,0)?></th>
              </tr>
            </tbody>
          </table>
        <?php } ?>
        <?php if(isset($_POST['par1'])){
          $unit = $id_unit;
          $periode1 = $_POST['par1'];
          $periode2 = $_POST['par2'];
        ?>
          <a href="lap_perubahan_modal_pdf.php?unit=<?= $unit ?>&periode1=<?= $periode1 ?>&periode2=<?= $periode2 ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</section>

