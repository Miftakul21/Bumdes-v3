<?php
$id_kas = $_GET['id_kas'];
$query = mysqli_query($mysqli, "SELECT a.*, b.id_index, c.kode_akun, c.nama_akun FROM tb_kas AS a JOIN 
                        tb_index AS b ON a.sumber = b.`id_index` JOIN  tb_akun AS C ON 
                        a.`kode_akun` = c.kode_akun WHERE a.id_kas='$id_kas' LIMIT 1");
$data = mysqli_fetch_array($query);
?>
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Kas</h3>
            </div>
        <form role="form" id="quickForm" action="operasi_crud/kas/update.php" method="post">
            <div class="card-body">
            <input type="hidden" name="id_kas" value="<?=$id_kas;?>">
            <div class="form-group row">
                <label for="nama" class="col-sm-2">No Transaksi<span class="text-danger">*</span></label>
                <input type="text" name="id_transaksi" class="form-control col-sm-5" value="<?=@$data['id_transaksi'];?>" readonly>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Tanggal Transaksi<span class="text-danger">*</span></label>
                <input type="date" name="tanggal" class="form-control col-sm-5" value="<?=@$data['tanggal']?>" readonly>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Sumber Arus Kas<span class="text-danger">*</span></label>
                <select class="form-control select2 col-sm-5" name="sumber">
                    <?php
                        $query ="SELECT a.* FROM tb_index AS a LEFT JOIN tb_kas AS b ON a.`id_index` = b.`sumber` 
                                GROUP BY a.`id_index`";
                        $result=$mysqli->query($query);
                        $num_result=$result->num_rows;
                        if ($num_result > 0 ) { 
                        while ($val=mysqli_fetch_assoc($result)) { ?>
                            <option value="<?= $val['id_index'] ?>" <?= isselect($data['sumber'], $data['sumber']) ?>><?= $val['keterangan']; ?></option>                            
                        <?php }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Akun<span class="text-danger">*</span></label>
                <select class="form-control select2 col-sm-5" name="kode_akun">
                <?php
                    $query="SELECT a.* FROM tb_akun AS a LEFT JOIN tb_kas AS b ON a.`kode_akun` = b.`kode_akun` 
                            GROUP BY a.`kode_akun`";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                    while ($val=mysqli_fetch_assoc($result)) { ?>
                        <option value="<?= $val['kode_akun'] ?>" <?= isselect($data['kode_akun'], $data['kode_akun']) ?>><?= $val['kode_akun'].' '.$val['nama_akun']; ?></option>                            
                    <?php }
                    }
                ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Keterangan<span class="text-danger">*</span></label>
                <input type="text" name="keterangan" class="form-control col-sm-5" value="<?=@$data['keterangan']?>" required>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Debit<span class="text-danger">*</span></label>
                <input type="number" name="debet" class="form-control col-sm-5" value="<?=@$data['debet']?>" required>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2">Kredit<span class="text-danger">*</span></label>
                <input type="number" name="kredit" class="form-control col-sm-5" value="<?=@$data['kredit']?>" required>
            </div>
        </div>
            <div class="card-footer">
                <button class="btn btn-primary">Ubah</button>
                <a href="?hal=kas" class="btn btn-default">Batal</a>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
</section>