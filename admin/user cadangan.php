<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data user</h1>
      </div><!-- /.col -->
      <div class="col-sm-5">
      </div>
      <div class="col-sm-1">
        <a href="?hal=user_olah" style="float: right;" class="btn btn-block bg-gradient-primary btn-sm">Tambah</a>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

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
                <th>Unit</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level User</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $query="SELECT * from tb_user join tb_unit using(id_unit)";
              $result=$mysqli->query($query);
              $num_result=$result->num_rows;
              if ($num_result > 0 ) { 
                $no=0;
                while ($data=mysqli_fetch_assoc($result)) {
                  extract($data);
                  ?>
                  <tr>
                    <td width="5%"><?php echo $no+=1; ?></td>
                    <td><?php echo $nama_unit; ?></td>
                    <td><?php echo $nama_user; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo str_repeat('*', strlen($password)); ?></td>
                    <td><?php echo $level_user; ?></td>
                  </td>

                  <td width="15%">

                    <a href="?hal=user_edit&id=<?php echo $id_user; ?>" 
                      class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger" title="Hapus Data" href="operasi_crud/user/delete.php?hapus=<?php echo $id_user;?>" 
                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php }} ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

