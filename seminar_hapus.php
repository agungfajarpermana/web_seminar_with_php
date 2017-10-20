<?php
  require_once "core/init.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  $id = $_GET['id'];
  $peserta = tampilkan_data_peserta_id($id);
  while ($row = mysqli_fetch_assoc($peserta)) {
    $id_seminar = $row['id_seminar'];
  }

  $jadwal_seminar = tampilkan();
  while ($row = mysqli_fetch_assoc($jadwal_seminar)) {
    $file = $row['gambar'];
  }

  if (isset($id)) {

    if($id_seminar != ''){
      if (hapus_data_seminar_dan_peserta($id)) {

        unlink("image/image/".$file);
        header("Location: seminar_jadwal.php #fluid-center");

      }else{
        echo "Gagal Menghapus Data Jadwal Seminar";
      }
    }else{
      if (hapus_data_seminar($id)) {

        unlink("image/image/".$file);
        header("Location: seminar_jadwal.php #fluid-center");

      }else{
        echo "Gagal Menghapus Data Jadwal Seminar";
      }
    }

  }
}
?>
