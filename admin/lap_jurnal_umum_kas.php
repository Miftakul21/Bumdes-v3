<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12">
            <h1 class="m-0 text-dark">Laporan Buku Besar Kas Desa</h1>
        </div>
        </div>
    </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title primary">Data Transaksi </h3>>
            </div>
        <div class="card-body">
        <?php
            if(isset($_POST['par1'])){
                $par1=$_POST['par1']; // tanggal awal
                $par2=$_POST['par2']; //
                $id_akun=$_POST['id_akun'];

                if($_POST['id_akun']=='Semua')
                /*
                    Mencari referensi jangka tanggali awal sampai tanggal akhir
                */ 
                $where="where (tb_kas.tanggal between '$par1' and '$par2')";
                else
                $where="where (tb_kas.tanggal between '$par1' and '$par2') and kode_akun='$id_akun'";
            }else{
                $par1="";
                $par2="";
                $id_akun="";
                // $where="where id_unit='$id_unit'";
                $where = "";
            }
        ?>
        <form role="form" id="quickForm" action="#" method="post">
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
                    <th>Akun</th>
                    <th>Keterangan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $saldo=0;
                // $query      = "SELECT * from tb_transaksi join tb_kegiatan using(id_kegiatan) $where";
                $query      = "SELECT * FROM tb_kas JOIN tb_akun ON tb_kas.kode_akun = tb_akun.kode_akun"; 
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
                        <td><?php echo $nama_akun; ?></td>
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo number_format($debet,0); ?></td>
                        <td><?php echo number_format($kredit,0); ?></td>
                        <th><?php echo number_format($saldo,0); ?></th>
                    </tr>
                <?php }}?>
            </table>
            <?php if(isset($_POST['par1'])){
                $_SESSION['laporan']['judul']="Laporan Buku Besar";
                $_SESSION['laporan']['periode'] =tgl_indo($_POST['par1'])." S/d ".tgl_indo($_POST['par2']);
                $_SESSION['laporan']['sql']=$query;
                $_SESSION['laporan']['unit']=caridata($mysqli,"select nama_unit from tb_unit where id_unit='".$_GET['id']."'");
                if($_POST['id_akun']=='Semua') {
                    $_SESSION['laporan']['akun']='Semua Akun';
                } else {
                    $_SESSION['laporan']['akun']=caridata($mysqli,"select nama_akun from tb_akun where kode_akun='".$_POST['id_akun']."'");
                }
                ?>
                <a href="lap_buku_besar_pdf.php" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
            <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

