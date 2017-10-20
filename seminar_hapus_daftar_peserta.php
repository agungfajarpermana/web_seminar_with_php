<?php
  require_once "core/init.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  global $link;

  $del = $_GET['del'];

  if(isset($_GET['del'])){

    if(hapus_data_daftar_peserta($del)){
      header("Location: seminar_daftar_peserta.php");
    }else{
      echo "<script>alert('Gagal Menghapus Data Daftar Peserta Seminar')</script>";
    }

  }
}
?>
