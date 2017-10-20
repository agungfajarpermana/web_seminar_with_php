<?php
  require_once "core/init.php";
  global $link;
  error_reporting(0);

  $output = '';
  $username = $_SESSION['user'];
  $id_seminar = $_POST['id_seminar'];

  $query_new  = "SELECT * FROM tb_seminar WHERE id_seminar='".$id_seminar."'";
  $result_new = mysqli_query($link, $query_new);

  if(mysqli_num_rows($result_new) > 0){
  while ($row = mysqli_fetch_assoc($result_new)) {
    $output .= '<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title text-center" id="myModalLabel">
                    '.$row['seminar'].'
                  </h4>
                </div>';

    $output .= '<div class="modal-body">
                  <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                      <h5 style="margin-left:10px; margin-top:-5px;">
                      Deskripsi...
                      </h5>
                    </div>
                    <div class="panel-body">
                      <h6 style="margin-left:10px; margin-top:-5px;">';
    ?>
                        <?php if($row['deskripsi'] == '') :?>
                          <?php $output .= 'Tidak Ada'; ?>
                        <?php else : ?>
                          <?php $output .= '"'.$row['deskripsi'].'"'?>
                        <?php endif;?>
    <?php
    $output .=        '</h6>
                    </div>

                    <!-- List group -->
                    <ul class="list-group">
                      <li class="list-group-item">
                        <i class="fa fa-star" aria-hidden="true"></i>. '.$row['pembicara'].'
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-ticket" aria-hidden="true"></i>. '.$row['kuota'].' Tiket
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>. '.$row['harga'].' (Rp)
                      </li>
                    </ul>
                  </div>
                </div>';
    }
  }

  $query = "SELECT count(id_seminar) AS jumlah_id FROM tb_peserta WHERE id_seminar='".$id_seminar."'";
  $result = mysqli_query($link, $query);

  $output .= '<div class="modal-footer">
              <div class="row">
              <div class="col-xs-6 col-sm-8 col-md-8">
              <span class="pull-left">
              <sm><a href="seminar_peserta.php?id='.$id_seminar.'" id="peserta" data-id="'.$id_seminar.'" class="btn btn-info btn-sm">';

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $jumlah = $row['jumlah_id'];
      if($jumlah != 0){
      $output .= '<strong>Sudah Ada '.$jumlah.' Pendaftar</strong>
                  </a></sm>
                  </span>
                </div>';
      }else{
      $output .= '<strong>Belum Ada Pendaftar</strong>
                    </a></sm>
                    </span>
                  </div>';
      }

    }
  }

  //menguji apakah nama sudah terdaftar atau belum
  $query_first  = "SELECT * FROM tb_mahasiswa WHERE username='$username'";
  $result_first = mysqli_query($link, $query_first);

  if($result_first){
    while($row = mysqli_fetch_assoc($result_first)){
      $nim = $row['nim'];
    }
  }

  $query_two  = "SELECT * FROM tb_peserta WHERE nim='$nim' AND id_seminar='$id_seminar'";
  $result_two = mysqli_query($link, $query_two);

  if($result_two){
    while($row = mysqli_fetch_assoc($result_two)){
      $id = $row['id_seminar'];
    }
  }

  $query_three  = "SELECT * FROM tb_seminar WHERE id_seminar='$id_seminar'";
  $result_three = mysqli_query($link, $query_three);

  while ($row = mysqli_fetch_assoc($result_three)) {
    $kuota = $row['kuota'];
  }

  if($jumlah < $kuota){

    if($id_seminar != $id){
      $output .= '<div class="col-xs-6 col-sm-4 col-md-4">
                    <a href="seminar_daftar.php?id='.$id_seminar.'" class="btn btn-primary btn-sm">
                      <strong>Pendaftaran Peserta</strong>
                    </a>
                  </div>
                </div>
              </div>';
    }else{
      $output .= '<div class="col-xs-6 col-sm-4 col-md-4">
                    <a href="#" class="btn btn-warning btn-sm">
                      <strong>Anda Sudah Terdaftar</strong>
                    </a>
                  </div>
                </div>
              </div>';
    }

  }else{
    $output .= '<div class="col-xs-6 col-sm-4 col-md-4">
                  <a href="#" class="btn btn-danger btn-sm">
                    <strong>Kuota Sudah Penuh</strong>
                  </a>
                </div>
              </div>
            </div>';
  }

  echo $output;
?>
