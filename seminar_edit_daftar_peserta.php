<?php
  require_once "core/init.php";
  require_once "view/header.php";

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

    $super_user = $admin = $login = false;
    if($_SESSION['user']){
      $login = true;
      if(cek_status($_SESSION['user']) == 2){
        $super_user = true;
      }

      if(cek_status($_SESSION['user']) == 1){
        $admin = true;
      }
    }

  $error = '';
  $id = $_GET['id'];

  if (isset($_GET['id'])) {
    $view_edit_peserta = tampilkan_data_peserta_daftar($id);
    while ($row = mysqli_fetch_assoc($view_edit_peserta)) {
      $seminar    = $row['seminar'];
      $nims       = $row['nim'];
      $nama       = $row['nama'];
      $kelas      = $row['kelas'];
      $semester   = $row['semester'];
      $telpon     = $row['telpon'];
      $keterangan = $row['keterangan'];
      $fakultas   = $row['fakultas'];
      $prodi      = $row['prodi'];
      $status     = $row['status'];
      $id_seminar = $row['id_seminar'];
    }
  }

  if(isset($_POST['submit'])){
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $kelas      = $_POST['kelas'];
    $semester   = $_POST['smtr'];
    $telpon     = $_POST['telp'];
    $keterangan = $_POST['ket'];
    $fakultas   = $_POST['fakultas'];
    $prodi      = $_POST['prodi'];
    $status     = $_POST['status'];

    if(!empty(trim($nim)) && !empty(trim($nama)) && !empty(trim($kelas)) && !empty(trim($semester)) && !empty(trim($telpon)) && !empty(trim($keterangan)) && !empty(trim($fakultas)) && !empty(trim($prodi)) && !empty(trim($status))){

      if(edit_data_peserta_daftar($nim,$nama,$kelas,$semester,$telpon,$keterangan,$fakultas,$prodi,$status,$id)){
        //header('Location: seminar_peserta.php?id='.$id_seminar.'');
        echo '<div id="tampil_modal">
                <div id="modal">
                  <h5>BERHASIL !!</h5>
                  <h6>Anda Berhasil Merubah Data Peserta Seminar</h6>
                  <a href="seminar_peserta.php?id='.$id_seminar.'" class="btn btn-success center-block">OKE</a>
                </div>
              </div>';
      }else{
        $error = 'Ada Masalah Saat Merubah Data Peserta Daftar';
      }

    }else{
      $error = 'Semua Data Harus Di Isi';
    }
  }
?>

<div class="menu">

  <nav class="navbar navbar-default">
    <div class="container">

      <div class="navbar-header" style="height:80px","padding:10px">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-hide" style="margin-top:22px">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand btn-home" style="padding:10px">
          <img src="image/image-login/logo.png" class="img-rounded img-responsive" alt="Brand" width="60px"/>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="menu-hide">
        <ul class="nav navbar-right navbar-nav list-menu" style="margin-top:10px">
          <?php if($super_user === true): ?>
            <li><a href="seminar_admin.php" class="active">Dashboard</a></li>
          <?php endif; ?>
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="#" class="">Tentang</a></li>
          <?php if($login == true) : ?>
          <li><a href="seminar_logout.php" class="#">Logout</a></li>
          <?php else: ?>
          <li><a href="seminar_login.php" class="#">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>

    </div>
  </nav>

  <div class="fluid-header">
    <div class="container">
      <div class="row rows">
        <div class="col-sm-12 col-md-12">
          <h1 class="text-center">Edit Data Peserta Seminar</h1>
          <p class="text-center lead">
            Tema : <?= $seminar; ?>
          </p>
        </div>
        <div class="text-center">
          <a href="seminar_peserta.php?id=<?=$id_seminar;?>" class="btn btn-default">Kembali</a>
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-center" id="form_tambah">
    <div class="container">
      <form class="col-md-offset-2 col-md-8" action="" method="post">
        <?php if($error): ?>
          <div class="alert alert-danger">
            <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="form-group form-group-lg">
          <label for="nim">Nim</label>
          <input type="text" class="form-control input-lg" name="nim" placeholder="Nomor Induk Mahasiswa" value="<?= $nims; ?>">
        </div>

        <div class="form-group form-group-lg">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control input-lg" name="nama" placeholder="Masukan Nama Anda" value="<?= $nama; ?>">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-group-lg">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control input-lg" name="kelas" placeholder="contoh : '08TPLPI'" value="<?= $kelas; ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group form-group-lg">
              <label for="smtr">Semester</label>
              <select class="form-control input-lg" name="smtr">
                <option value="<?= $semester; ?>">Semester <?= $semester; ?></option>
                <?= ($semester == '1') ? '' : '<option value="1">Semester 1</option>'?>
                <?= ($semester == '2') ? '' : '<option value="2">Semester 2</option>'?>
                <?= ($semester == '3') ? '' : '<option value="3">Semester 3</option>'?>
                <?= ($semester == '4') ? '' : '<option value="4">Semester 4</option>'?>
                <?= ($semester == '5') ? '' : '<option value="5">Semester 5</option>'?>
                <?= ($semester == '6') ? '' : '<option value="6">Semester 6</option>'?>
                <?= ($semester == '7') ? '' : '<option value="7">Semester 7</option>'?>
                <?= ($semester == '8') ? '' : '<option value="8">Semester 8</option>'?>
                <?= ($semester == '9') ? '' : '<option value="9">Semester 9</option>'?>
                <?= ($semester == '10') ? '' : '<option value="10">Semester 10</option>'?>
                <?= ($semester == '11') ? '' : '<option value="11">Semester 11</option>'?>
                <?= ($semester == '12') ? '' : '<option value="12">Semester 12</option>'?>
                <?= ($semester == '13') ? '' : '<option value="13">Semester 13</option>'?>
                <?= ($semester == '14') ? '' : '<option value="14">Semester 14</option>'?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="telp">No. Telephone/Handphone</label>
              <input type="tel" class="form-control input-lg" name="telp" placeholder="Masukan Nomor Telephone/Hp Anda" value="<?= $telpon; ?>">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group form-group-lg">
              <label for="" class="control-label">Keterangan</label>
              <div class="radio has-success">
                <label class="radio-inline input-lg">
                  <input type="radio" name="ket" value="Hadir" <?= ($keterangan == "Hadir") ? 'checked="checked"' : '' ?>> <strong>Hadir</strong>
                </label>

                <label class="radio-inline input-lg">
                  <input type="radio" name="ket" value="Tidak Hadir" <?= ($keterangan == "Tidak Hadir") ? 'checked="checked"' : '' ?>> <strong>Tidak Hadir</strong>
                </label>
              </div>
            </div>
          </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="fakultas">Fakultas</label>
                <select name="fakultas" class="form-control input-lg">
                  <option value="<?= $fakultas; ?>"><?= $fakultas; ?></option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="prodi">Prodi</label>
                <select name="prodi" class="form-control input-lg">
                  <option value="<?= $prodi; ?>"><?= $prodi; ?></option>
                </select>
              </div>
            </div>

            <?php if($super_user === true || $admin === true): ?>
              <div class="col-md-12">
                <div class="form-group form-group-lg">
                  <label for="Status Pembayaran">Status Pembayaran</label>
                  <select name="status" class="form-control input-lg">
                    <option value="<?= $status; ?>"><?= $status; ?></option>
                    <?php if($status === 'Lunas') :?>

                    <?php else: ?>
                      <option value="Lunas">Lunas</option>
                    <?php endif; ?>
                    <?php if($status === 'Belum Lunas'):?>

                    <?php else: ?>
                      <option value="Belum Lunas">Belum Lunas</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            <?php endif; ?>

            <div class="col-sm-12">
              <input type="submit" class="btn btn-block btn-lg btn-primary" name="submit" value="Simpan Perubahan">
            </div>
          </form>
        </div>
      </div>
    </div>

  <div class="wrap-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <p>
            &copy aldi gunawan 2017
          </p>
        </div>

        <div class="col-sm-6 col-md-6">
          <p class="text-right">
            [ ] dengan <span>❤</span> di tangerang selatan
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require_once "view/footer.php"
?>

<?php } ?>
