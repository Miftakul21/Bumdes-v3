<?php 
require_once "../setting/koneksi.php";
require_once "../setting/tanggal.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

     <!-- datatable style css -->
    <link rel="stylesheet" type="text/css" href="../assets/dist/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    
    <title>Laporan Buku Besar Kas Excel</title>
  </head>
  <body>

<div class="container-fluid text-center">
    <h1>Laporan Buku Besar Kas Bumdes</h1>
    <h1>Desa Minggirsari</h1>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
       <div class="card card-primary">
        <div class="card-body">
            <?php 
                $sql1 = "SELECT * FROM tb_akun";
                $result = $mysqli->query($sql1);
                $num_result = $result->num_rows;

                if($num_result > 0) {
                    while($data = mysqli_fetch_assoc($result)){
                        extract($data);                                
            ?> 
                <table class="table table-bordered table-hover" id="id_table">
                    <thead>
                            <tr>
                                <th><?= $kode_akun ?></th>
                                <th><?= $nama_akun ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                    </thead>
                    <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Kode Akun</th>
                                <th>Sumber Dana</th>
                                <th>Keterangan</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                            </tr>
                    </thead> 
                    <tbody>
                        <?php
                            $debet = 0;
                            $kredit = 0;
                            $where = "";

                            $per1 = isset($_GET['per1']) ? $_GET['per1'] : '';
                            $per2 = isset($_GET['per2']) ? $_GET['per2'] : '';

                            if($per1 == '') {
                                $where = "WHERE kode_akun = '$kode_akun'";
                            } else {
                                $per1 = $_GET['per1'];
                                $per2 = $_GET['per2'];

                                $where = "WHERE kode_akun = '$kode_akun' AND (tanggal BETWEEN '$per1' AND '$per2')";
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
    
    <!-- datatables  -->
    <script src="../assets/dist/js/jquery.js"></script>    
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(document).ready(() => {
            $('#id_table').DataTable({
                "bLengthChange": false,
                "bFilter": false,
                "bInfo":false,
                "bPaginate": false,

                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });

        })
    </script>

  </body>
</html>