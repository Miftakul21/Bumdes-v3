<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Index</h1>
      </div>
      <div class="col-sm-5">
      </div>
      <div class="col-sm-1">
        <a href="?hal=ind_olah" style="float: right;" class="btn btn-block bg-gradient-primary btn-sm">Tambah</a>
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
                <th>ID</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $query="SELECT * from tb_index";
              $result=$mysqli->query($query);
              $num_result=$result->num_rows;
              if ($num_result > 0 ) { 
                $no=1;
                while ($data=mysqli_fetch_assoc($result)) {
                  extract($data);
                  ?>
                  <tr>
                    <td width="5%"><?php echo $no++; ?></td>
                    <td><?php echo $keterangan; ?></td>
                  </td>

                  <td width="15%">

                    <a href="?hal=ind_edit&id=<?php echo $id_index; ?>" 
                      class="btn btn-icon btn-primary" title="Edit Data"><i class="fa fa-edit"></i> </a>

                      <a class="btn btn-danger" title="Hapus Data" href="operasi_crud/ind/delete.php?hapus=<?php echo $id_index;?>" 
                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> <i class="fa fa-trash"></i></a>

                      </td>
                    </tr>
                    <?php }} ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>


<!-- Toastr -->
<script src="../assets/dist/js/toastr.min.js"></script>
<?php 
if(isset($_SESSION['info'])){
  if($_SESSION['info']['status'] == 'success'){
?>

<script>
  iziToast.success({
    title:'Sukses',
    message: `<?= $_SESSION['infor']['message']; ?>`,
    position: 'topCenter',
    timeout: 5000
  });
</script>
<?php
  } else {

?>
  <script>
    iziToast.error({
      title:'Gagal',
      message: `<?= $_SESSION['info']['message'] ?>`,
      timeout:5000,
      positoon: 'topCenter'
    });
  </script>
<?php 
  } 
  unset($_SESSION['info']);
  $_SESSION['info'] = null;
}
?>
