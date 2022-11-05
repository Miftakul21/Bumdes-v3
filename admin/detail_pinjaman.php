<?php 
require_once '../setting/koneksi.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <!-- Informasi detail anggota pinjaman -->
        <div class="card">
            <h4 class="card-header font-weight-normal">Detail Pinjaman [nama orang]</h4>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-text">Nominal</h5>
                        <h5 class="card-text">Pokok</h5>
                        <h5 class="card-text">Jasa</h5>
                        <h5 class="card-text">Jangka Pinjaman</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">: Rp. 500.000</h5>
                        <h5 class="card-text">: Rp. 50.000</h5>
                        <h5 class="card-text">: Rp. 10.000</h5>
                        <h5 class="card-text">: 10 Bulan</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">Total Pokok dan Jasa</h5>
                        <h5 class="card-text">Sisa Pinjaman Penelusuran</h5>
                        <h5 class="card-text">Sisa Pinjaman Pokok Dan Jasa</h5>
                        <h5 class="card-text">Status</h5>
                    </div>
                    <div class="col">
                        <h5 class="card-text">: Rp. 50.000</h5>
                        <h5 class="card-text">: Rp. 10.000</h5>
                        <h5 class="card-text">: Rp. 10.000</h5>
                        <h5 class="card-text">: Belum Lunas</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <!-- <button class="btn btn-success mb-1">Tambah Data</button> -->
    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#staticBackdrop">
        Tambah Data
    </button>
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title primary">List Data Angsuran</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pokok</th>
                            <th>Jasa</th>
                            <th>Potongan</th>
                            <th>Sisa Pinjaman Akhir (Jasa)</th>
                            <th>Sisa Pinjaman Akhir (Non Jasa)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>


<!-- Live Modal Bayar Angsuran -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="operasi_crud/angsur/store.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="pokok" class="form-label">Pokok<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="pokok" name="pokok" placeholder="contoh: 50000">
                        </div>
                        <div class="mb-3">
                            <label for="jasa" class="form-label">Jasa<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jasa" name="jasa" placeholder="contoh: 50000">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<!-- Live Modal Untuk Menambahkan Potongan -->