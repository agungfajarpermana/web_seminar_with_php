<?php
  require_once "core/init.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  global $link;

  $del = $_GET['del'];

  $query = "SELECT * FROM tb_peserta WHERE id_peserta=$del";
  $result = mysqli_query($link, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $id_seminar = $row['id_seminar'];
  }

  if(isset($_GET['del'])){

    if(hapus_data_peserta($del)){
      header("Location: seminar_peserta.php?id=".$id_seminar);
    }else{
      echo "<script>alert('Gagal Menghapus Data Peserta Seminar')</script>";
    }

  }
}
?>
