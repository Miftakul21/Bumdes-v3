<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12">
            <h1 class="m-0 text-dark">Laporan Buku Besar Kas Desa</h1>
        </div>
        </div>
    </div>
</div>

<?php 
    $query_kas = "";
    $saldo = 0;        
    if(isset($_POST['periode1'])){
            $periode1=$_POST['periode1'];
            $periode2=$_POST['periode2'];
            $kode_akun = $_POST['kode_akun'];     
            
            if($_POST['kode_akun']=='semua')                         
                $query_kas = "SELECT * FROM tb_kas WHERE tanggal BETWEEN '$periode1' AND '$periode2'";
            else   
                $query_kas = "SELECT * FROM tb_kas WHERE kode_akun = '$kode_akun' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
    }else{
        $periode1="";
        $periode2="";
        $kode_akun="";
        $query_kas="SELECT * FROM tb_kas";
    }
?>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title primary">Data Transaksi </h3>
        </div>
        <div class="card-body">
            <form role="form" id="quickForm" action="?hal=lap_buku_besar_kas" method="POST">
                <div class="form-group row">
                    
                    <!-- <label for="nama" class="col-1 m-2">Akun</label>
                    <select class="form-control select2 col-3" name="kode_akun">
                        <option value="semua">Semua Akun</option>
                        <?php
                            $query="SELECT * from tb_akun";
                            $result=$mysqli->query($query);
                            $num_result=$result->num_rows;
                            $kode_akun = $_POST['kode_akun'] ? $_POST['kode_akun'] : '';

                            if ($num_result > 0 ) { 
                            $no=0;
                                while ($data=mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?=$data['kode_akun']?>" <?=isselect(@$kode_akun,$data['kode_akun'])?>><?=$data['kode_akun'].' '.$data['nama_akun']?></option>
                                <?php }
                            }        
                        ?>
                    </select> -->

                    <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
                    <input type="date" name="periode1" class="form-control col-2" value="<?= @$periode1; ?>" required>
                    <input type="date" name="periode2" class="form-control col-2" value="<?= @$periode2; ?>" required>
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
                        $result = mysqli_query($mysqli, $query_kas);
                        $num_result = mysqli_num_rows($result);
                        if($num_result > 0) {
                            while($data = mysqli_fetch_assoc($result)) {
                                extract($data);
                                $saldo += $debet;
                                $saldo -= $kredit;
                    ?>
                    <tr>
                        <td><?php echo $id_transaksi; ?></td>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo number_format($debet,0); ?></td>
                        <td><?php echo number_format($kredit,0); ?></td>
                        <td><?php echo number_format($saldo,0); ?></td>
                    </tr>
                    <?php 
                            }   
                        }
                    ?>
            </table>
            <?php 
                if(isset($_POST['periode1'])){
                    $periode1 = $_POST['periode1'];
                    $periode2 = $_POST['periode2'];
                    $kode_akun1 = isset($_POST['kode_akun']) ? $_POST['kode_akun'] : "";
                    $queryz = mysqli_query($mysqli, "SELECT * FROM tb_akun WHERE kode_akun = '$kode_akun1'");
                    $dataz = mysqli_fetch_array($queryz);
                    $nama_akun = isset($dataz['nama_akun']) ? $dataz['nama_akun']: "Semua";

                    $resultz = ($kode_akun == "semua") ? "Semua" : $nama_akun;

            ?>
                <a href="lap_buku_besar_kas_pdf.php?kode_akun=<?= $kode_akun1 ?>&nama_akun=<?= $resultz ?>&periode1=<?= $periode1 ?>&periode2=<?= $periode2 ?>" target="_blank" style="float: right;margin-top: 10px;" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</a>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

