<?php
  function cek_login($username,$password,$level){
    global $link;

    $query = "SELECT tb_admin.username,tb_admin.password,tb_admin.level,tb_mahasiswa.username,tb_mahasiswa.password,tb_mahasiswa.level
              FROM tb_admin LEFT OUTER JOIN tb_mahasiswa ON tb_admin.level = tb_mahasiswa.level WHERE tb_admin.username='$username' AND tb_admin.password='$password' AND tb_admin.level='$level'
              UNION
              SELECT tb_admin.username,tb_admin.password,tb_admin.level,tb_mahasiswa.username,tb_mahasiswa.password,tb_mahasiswa.level
              FROM tb_admin RIGHT OUTER JOIN tb_mahasiswa ON tb_admin.level = tb_mahasiswa.level WHERE tb_mahasiswa.username='$username' AND tb_mahasiswa.password='$password' AND tb_mahasiswa.level='$level'";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) != 0) {
        return true;
      }else{
        return false;
      }
    }

  function cek_status($username){
    global $link;

    $query = "SELECT level FROM tb_admin WHERE username='$username'";
    $result = mysqli_query($link, $query);

    if($result){
      while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['level'];
      }
      return $status;
    }
  }
?>
