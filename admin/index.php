<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

session_start();
if(isset($_SESSION['admin'])){
  require_once 'layout/top.php';
?>
    <nav class="main-header navbar navbar-expand navbar-dark elevation-2 navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user mr-2"></i>
            <span>Admin</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="fas fa-lock mr-2"></i> Log Out
              <span class="float-right text-muted text-sm"></span>
            </a>
          </div>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link text-center">
        <span class="brand-text font-gradient-light">BUMDES MAJU MAKMUR</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <?php include('_menu.php'); ?>
         </ul>
       </nav>
       <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
   </aside>

  <!-- Sidebar -->
  <div class="content-wrapper">
    <?php require_once 'layout/sidebar.php'; ?>
  </div>

  <!-- footer -->
<?php require_once 'layout/footer.php'; ?>
</div>
<?php require_once 'layout/bottom.php';?>

<?php 
}else{
  echo "<script>window.location='../index.php';</script>";
}
?>