<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Keuangan Kas</h1>
            </div>
            <div class="col-sm-5">
            </div>
            <div class="col-sm-1">
                <a href="?hal=tambah_kas" style="float: right;" class="btn btn-block bg-gradient-primary btn-sm">Tambah</a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title primary">Data Kas</h3>
            </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-hover">
                <thead>
                        <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th>#</th>
                        </tr>
                </thead>
                <tbody>
                <?php
                    $saldo=0;
                    $query      = "SELECT * from tb_kas";
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
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo number_format($debet,0); ?></td>
                        <td><?php echo number_format($kredit,0); ?></td>
                        <th><?php echo number_format($saldo,0); ?></th>
                        <td width="15%">
                            <a href="?hal=transaksi_edit&id=<?php echo ''; ?>"
                            class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i> </a>
                            <a class="btn btn-danger" title="Hapus Data" href="operasi_crud/kas/delete.php?id_kas=<?= $id_kas; ?>"
                                onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php }}?>
            </table>
                </div>
            </div>
        </div>
    </div>
</section>

