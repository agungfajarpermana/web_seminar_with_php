<?php
  require_once "core/init.php";
  require_once "view/header.php";
  error_reporting(0);

  $super_user = $login = false;
  if($_SESSION['user']){
    $login = true;
    if(cek_status($_SESSION['user']) == 1){
      $super_user = true;
    }
  }

  $greet = '';
  $error = '';

  date_default_timezone_set('Asia/Jakarta');
  $date1 = date('H:i:s');

  if($date1 > '00:00:00'){
    $greet = "Selamat Pagi";
  }

  if($date1 > '12:00:00'){
    $greet = "Selamat Siang";
  }

  if($date1 > '15:00:00'){
    $greet = "Selamat Sore";
  }

  if($date1 > '18:00:00'){
    $greet = "Selamat Malam";
  }

  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $view_edit_admin = tampilkan_data_edit_admin($id);
    while ($row = mysqli_fetch_assoc($view_edit_admin)) {
      $username = $row['username'];
      $password = $row['password'];
      $nama     = $row['nama'];
      $email    = $row['email'];
      $telp     = $row['telpon'];
      $level    = $row['level'];
      $fakultas = $row['fakultas'];
      $prodi    = $row['prodi'];
    }

    if(isset($_POST['submit'])){
      $user     = $_POST['user'];
      $pass     = $_POST['pass'];
      $nama     = $_POST['nama'];
      $email    = $_POST['email'];
      $telpon   = $_POST['telpon'];
      $level    = $_POST['level'];
      $fakultas = $_POST['fakultas'];
      $prodi    = $_POST['prodi'];

      if(!empty(trim($user)) && !empty(trim($pass)) && !empty(trim($nama)) && !empty(trim($email)) && !empty(trim($telpon)) &&
         !empty(trim($level)) && !empty(trim($fakultas)) && !empty(trim($prodi))){

            if(edit_data_admin($user, $pass, $nama, $email, $telpon, $level, $fakultas, $prodi, $id)){

              echo '<div id="tampil_modal">
                      <div id="modal">
                        <h5>BERHASIL !!</h5>
                        <h6>Anda Berhasil Merubah Data Admin"</h6>
                        <a href="seminar_daftar_admin.php" class="btn btn-success center-block">OKE</a>
                      </div>
                    </div>';

            }else{
              $error = 'Ada Masalah Saat Mengubah Data Admin...';
            }

      }else{
        $error = 'Semua Data Wajib Di Isi...';
      }

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
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="seminar_admin.php" class="active">Tambah Admin</a></li>
          <li><a href="seminar_daftar_admin.php" class="active">Daftar Admin</a></li>
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
        <div class="col-sm-6 col-md-6">
          <h1>Halaman Ubah Admin</h1>
        
        </div>

        <div class="col-sm-offset-1 col-sm-4 col-md-offset-2 col-md-4 collapse navbar-collapse">
          <img src="image/image-tableseminar/schedule.png" alt="seminar" class="img-responsive center-block" width="270px" />
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-action">
    <div class="container" style="margin-top:30px;">
      <!--<div class="row">
        <div class="col-md-6">
          <form class="navbar navbar-right">
            <div class="form-group">
              <div class="input-group">
                <input type="search" class="form-control input-lg" name="cari" placeholder="cari judul seminar">
                <span class="input-group-addon">
                  <input type="submit" class="btn btn-primary btn-xs" name="submit" value="Cari">
                </span>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <p class="btn-collapse" data-toggle="collapse" data-target="#collapseBody">
            Filter Tag
          </p>
          <div class="collapse" id="collapseBody">
            <div class="collapse-body">
              <form class="" action="#" method="post">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">Tampilkan Semua Data</a></li>
                  <li><a href="#">Teknologi</a></li>
                  <li><a href="#">Pendidikan</a></li>
                  <li><a href="#">Budaya</a></li>
                  <li><a href="#">Bebas</a></li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>

  <div class="fluid-center" id="fluid-center" style="margin-top:-50px;">

    <div class="container">
      <h3 style="margin-top:-10px;">Form Ubah Admin</h3>
      <form id="form_admin" action="" method="post">
        <?php if($error): ?>
          <div class="alert alert-danger">
            <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="user">Username</label>
              <input type="text" class="form-control input-lg" name="user" placeholder="ex: 2012xxxxxx" value="<?= $username; ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="pass">Password</label>
              <input type="text" class="form-control input-lg" name="pass" placeholder="ex: 0501xx" value="<?= $password; ?>">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="nama">Nama</label>
              <input type="text" class="form-control input-lg" name="nama" placeholder="ex: fulan bin fulan" value="<?= $nama; ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="email">Email</label>
              <input type="text" class="form-control input-lg" name="email" placeholder="user@usermail.com" value="<?= $email; ?>">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="telpon">Telepon</label>
              <input type="text" class="form-control input-lg" name="telpon" placeholder="ex: 0812xxxxxxx" value="<?= $telp; ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="level">Level</label>
              <select name="level" class="form-control input-lg">
                <option value="<?= $level; ?>">Admin</option>
                <option value="2">Super Admin</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="fakultas">Fakultas</label>
              <select name="fakultas" class="form-control input-lg">
                <option value="<?= $fakultas; ?>"><?= $fakultas; ?></option>
                <option value="Teknik">Teknik</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Hukum">Hukum</option>
                <option value="MIPA">MIPA</option>
                <option value="Satra">Satra</option>
                <option value="FKIP">FKIP</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="prodi">Prodi</label>
              <select name="prodi" class="form-control input-lg">
                <option value="<?= $prodi; ?>"><?= $prodi; ?></option>
                <option value="T. Elektro [S1]">T. Elektro [S1]</option>
                <option value="T. Mesin [S1]">T. Mesin [S1]</option>
                <option value="T. Kimia [S1]">T. Kimia [S1]</option>
                <option value="T. Industri [S1]">T. Industri [S1]</option>
                <option value="T. Informatika [S1]">T. Informatika [S1]</option>
                <option value="Manajemen [S1]">Manajemen [S1]</option>
                <option value="Akutansi [D3]">Akutansi [D3]</option>
                <option value="Akutansi [S1]">Akutansi [S1]</option>
                <option value="Sekretaris [D3]">Sekretaris [D3]</option>
                <option value="Magister Manajemen [S2]">Magister Manajemen [S2]</option>
                <option value="Ilmu Hukum [S1]">Ilmu Hukum [S1]</option>
                <option value="Magister Hukum [S2]">Magister Hukum [S2]</option>
                <option value="Matematika [S1]">Matematika [S1]</option>
                <option value="Sastra Indonesia [S1]">Sastra Indonesia [S1]</option>
                <option value="Sastra Inggris [S1]">Sastra Inggris [S1]</option>
                <option value="Pendidikan Ekonomi [S1]">Pendidikan Ekonomi [S1]</option>
                <option value="Pendidikan Pancasila dan Kewarganegaraan [S1]">Pendidikan Pancasila dan Kewarganegaraan [S1]</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-default btn-primary" name="submit">Ubah Data Admin</button>
      </form>
    </div><!-- Akhir Container-->

  </div><!-- Akhir Fluid-center-->

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

</div><!-- Akhir div class Menu-->

<?php
  require_once "view/footer.php"
?>
