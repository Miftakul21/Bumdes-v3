<!-- Main content -->
<section class="content" style="margin-top: 10px;">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Pinjaman</h3>
            </div>
            <!-- form start -->
            <form role="form" id="quickForm" action="operasi_crud/anggota_pinjam/store.php" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Kode<span class="text-danger">*</span></label>
                        <input type="text" name="kode" class="form-control" value="" placeholder="Contoh: POK 1" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama<span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Andi" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Dukuh<span class="text-danger">*</span></label>
                        <input type="text" name="dukuh" class="form-control" placeholder="Contoh: Dukuh 1" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Alamat<span class="text-danger">*</span></label>
                        <input type="text" name="alamat" class="form-control" placeholder="Contoh: Minggirsari" required="">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="RT">RT<span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control" placeholder="Contoh: 01" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="rw">RW<span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control" placeholder="Contoh: 01" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nominal_pinajm">Nominal Pinajaman<span class="text-danger">*</span></label>
                        <input type="number" name="nominal_pinjaman" class="form-control" placeholder="Contoh: 1000000" required="">
                    </div>
                    <div class="form-group">
                        <label for="jangka_pinjaman">Jangka Pinjaman<span class="text-danger">*</span></label>
                        <input type="number" name="jangka_pinjaman" class="form-control" placeholder="Masukkan bulan 1 - 12 bulan" required="" min="1" max="12">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="?hal=#" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</section>