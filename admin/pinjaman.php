<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data pinjaman</h1>
      </div>
      <div class="col-sm-5">
      </div>
      <div class="col-sm-1">
        <a href="?hal=tambah_anggota_pinjaman" style="float: right;" class="btn btn-block bg-gradient-primary btn-sm">Tambah</a>
      </div>
    </div>
  </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title primary">List Data</h3>
            <div class="card-tools">
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Dukuh</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query="SELECT * from tb_anggota_pinjam";
                $result=$mysqli->query($query);
                $num_result=$result->num_rows;
                if ($num_result > 0 ) { 
                    $no=1;
                    while ($data=mysqli_fetch_assoc($result)) {
                    extract($data);
                    ?>
                    <tr>
                        <td width="5%"><?php echo $no++; ?></td>
                        <td><?=$kode; ?></td>
                        <td><?=$nama; ?></td>
                        <td><?=$dukuh; ?></td>
                        <td><?=$alamat.' Rt.'.$rt.'/Rw.'.$rw; ?></td>
                        <td width="15%">
                            <a href="?hal=anggota_pinjaman_edit&id=<?= $id; ?>" 
                            class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i> </a>

                            <a class="btn btn-danger" title="Hapus Data" href="operasi_crud/anggota_pinjam/delete.php?hapus=<?php echo $id;?>" 
                                onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <td>
                            <a href="?hal=pinjaman_detail&id_anggota=<?= $id; ?>" class="btn btn-info"><i class="fa fa-info mr-2"></i> Detail</a>
                        </td>
                    </tr>
                    <?php }} ?>
                    </table>
                </div>
                </div>
            </div>
            </div>
</section>