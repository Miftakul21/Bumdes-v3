
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- Select2 -->
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
</body>
</html>

<script>
$(function () {
    $('#example2').DataTable();    
    $('#example3').dataTable( {
        "searching": false
    } );

    $('.select2').select2({
        theme: 'bootstrap4'
    });
});
</script>
