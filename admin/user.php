<?php   
  require_once '../setting/koneksi.php';
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data User</h1>
      </div>
      <div class="col-sm-5">
      </div>
      <div class="col-sm-1">
        <a href="?hal=user_olah" style="float: right;" class="btn btn-block bg-gradient-primary btn-sm">Tambah</a>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <?php 
    if(isset($_SESSION['success'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['success']; ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php 
    unset($_SESSION['success']);
    }
  ?>
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title primary">List Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Unit</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query      = "SELECT * FROM tb_user LEFT JOIN tb_unit ON tb_user.id_unit = tb_unit.id_unit WHERE tb_user.level_user NOT IN ('Admin')";
                $result     = $mysqli->query($query);
                $num_result = $result->num_rows;
              if ($num_result > 0) {
                $no = 0;
                while ($data = mysqli_fetch_assoc($result)) {
                  extract($data);
                  ?>
                  <tr>
                      <td width="5%"><?php echo $no += 1; ?></td>
                      <td><?php echo $nama; ?></td>
                      <td><?php echo $username; ?></td>
                      <td><?php echo str_repeat('*', strlen(substr($password, 0,8))); ?></td>
                      <td><?php echo $level_user; ?></td>
                      <td><?php echo $nama_unit != NULL ? $nama_unit : '-';?></td>
                      <td width="15%">
                        <a href="?hal=user_edit&id=<?php echo $id_user; ?>"
                        class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger" title="Hapus Data" href="operasi_crud/user/delete.php?hapus=<?php echo $id_user; ?>"
                          onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php }}?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
