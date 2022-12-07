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
            <h3 class="card-title primary">Data Transaksi</h3>
        </div>
        <div class="card-body">
            <form role="form" id="quickForm" action="?hal=lap_buku_besar_kas" method="POST">
                <?php 
                    $per1 = isset($_POST['periode1']) ? $_POST['periode1'] : '';
                    $per2 = isset($_POST['periode2']) ? $_POST['periode2'] : '';
                ?>
                <div class="form-group row">
                    <label  for="nama" class="col-2 m-2">Periode Tanggal</label>
                    <input type="date" name="periode1" class="form-control col-2" value="<?= @$per1; ?>" required>
                    <input type="date" name="periode2" class="form-control col-2" value="<?= @$per2; ?>" required>
                    <div class="col-1">
                        <input type="submit" name="proses" class="btn btn-primary" style="float: right" value="Proses">
                    </div>
                    <div class="col-2 offset-2">
                        <a href="export_buku_besar_kas.php?per1=<?= $per1; ?>&per2=<?= $per2; ?>" class="btn btn-success">Export Excel</a>
                    </div>
                </div>
            </form>
            <hr>
            <!-- 
                1. Menampilkan filed pertama dengan data kode akun dan nama akun
                2. Selanjutnya melopping isi data berdasarkan akun
                3. Filter data beradasarkan periode
                4. Ini sama seperte kaya laporan arus kas
            -->
            <?php 
                $sql1 = "SELECT * FROM tb_akun";
                $result = $mysqli->query($sql1);
                $num_result = $result->num_rows;

                if($num_result > 0) {
                    while($data = mysqli_fetch_assoc($result)){
                        extract($data);                                
            ?> 
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?= $kode_akun; ?></th>
                            <th><?= $nama_akun; ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Kode Akun</th>
                                <th>Sumber Dana</th>
                                <th>Keterangan</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <th>Saldo</>
                            </tr>
                        <?php
                            $debet = 0;
                            $kredit = 0;
                            $where = "";

                            if(isset($_POST['periode1'])) {
                                $periode1 = $_POST['periode1'];
                                $periode2 = $_POST['periode2'];
                                $where = "WHERE kode_akun = '$kode_akun' AND (tanggal BETWEEN '$periode1' AND '$periode2')";
                            } else {
                                $where = "WHERE kode_akun = '$kode_akun'";
                            }

                            $queryz = "SELECT * FROM tb_kas JOIN tb_akun USING(kode_akun) ".$where;
                            $results = $mysqli->query($queryz);
                            $num_resultz = $results->num_rows;

                            if($num_resultz > 0){
                                while($dataz = mysqli_fetch_assoc($results)){
                                    extract($dataz)
                        ?>

                            <tr>
                                <td><?= tgl_indo($tanggal); ?></td>                            
                                <td><?= $id_transaksi; ?></td>                            
                                <td><?= $kode_akun; ?></td>                            
                                <td><?= $sumber; ?></td>                            
                                <td><?= $keterangan; ?></td>                            
                                <td><?= $debet; ?></td>                            
                                <td><?= $kredit; ?></td>                            
                                <td><?= number_format(10,0); ?></td>                            
                            </tr>

                        <?php 
                                }
                            }
                        ?>
                    </tbody>
                </table>
            <?php } } ?>
        </div>
      </div>
    </div>
  </div>
</section>

