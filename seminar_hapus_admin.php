<?php
  require_once "core/init.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  global $link;

  $del = $_GET['del'];

  if(isset($_GET['del'])){

    if(hapus_data_admin($del)){
      header("Location: seminar_daftar_admin.php");
    }else{
      echo "<script>alert('Gagal Menghapus Data Peserta Seminar')</script>";
    }

  }
}
?>
