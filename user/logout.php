<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['admin']);
unset($_SESSION['Admin']);
unset($_SESSION['Kepala Desa']);
unset($_SESSION['Bendahara']);
unset($_SESSION['Ketua']);

echo "<script>window.location='../index.php';</script>";
?> 