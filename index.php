<?php
  require_once "core/init.php";
  require_once "view/header.php";
  error_reporting(0);

  $login = false;
  if($_SESSION['user']){
    $login = true;
  }

  $peserta = tampilkan_jumlah_peserta();
  $seminar = tampilkan_total_seminars();
?>
    <div class="container-fluid">
      <div class="cover-image">

        <div class="container">

          <div class="row">
            <div class="col-sm-12 col-md-12">
              <h1 class="text-center text-title">Seminar Kampus</h1>
              <h3 class="text-center text-sub">#luaskanIlmu dan #luaskanManfaat dengan kekuatan super seminar</h3>

              <?php if($login == true): ?>
                <div class="action">
                  <a href="seminar_jadwal.php" class="btn btn-default">Lihat Jadwal</a>
                </div>
              <?php else: ?>
                <div class="action">
                  <a href="seminar_login.php" class="btn btn-default">Login</a>
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>

      </div>

    </div><!--akhir container-fluid-->

    <div class="wrap-info">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <h2 class="head-info">SAAT INI <br> SUDAH ADA</h2>
          </div>

          <div class="col-sm-6 col-md-6">
            <h3 class="info text-uppercase"><?= $peserta; ?> Pendaftar</h3>
            <h3 class="info text-uppercase"><?= $seminar; ?> Jadwal Seminar</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="wrap-about" id="wrap-about">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3">
            <img src="image/image-about/mading-rocket.png" class="img-rounded img-responsive" alt="about" />
          </div>

          <div class="col-sm-9 col-md-9">
            <h2>Tentang Seminar Kampus</h2>
            <p class="lead lead-1">
              Puji Serta syukur saya panjatkan kehadirat Allah SWT, Sang pencipta langit dan
              bumi serta segala isinya yang telah melimpahkan rahmat, hidayat, serta kasih
              sayang-Nya kepada saya sehingga dapat menyelesaikan tugas akhir ini sebagai
              syarat kelulusan untuk mendapat gelar S1.
            </p>

            <p class="lead">
              Terima kasih buat orang tua, teman-teman kelas maupun rumah yang telah
              memberikan semangat. serta kepada semua dosen universitas pamulang yang telah
              memberikan ilmunya sehingga saya dapat membuat dan menyelesaikan tugas akhir ini.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="wrap-profil">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h2 class="text-center">founder</h2>
            <img src="image/image-about/profile.jpg" class="img-circle center-block img-responsive" alt="profile" width="200px" />
            <p class="text-center">Aldi Gunawan</p>
          </div>
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
    <!--<br><br>
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content bg-content">
        <div class="modal-header">
          <img src="image/image-login/logoseminar.png" class="img-responsive img-rounded center-block" alt="Responsive image">
        </div>
        <div class="modal-body">
          <form class="col-md-12 center-block form1" action="#" method="post">
            <div class="form-group">
              <label for="user"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Username</label>
              <input type="text" class="form-control input-sm" id="user" name="username" placeholder="Username" required="required" value="">
            </div>

            <div class="form-group">
              <label for="pass"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control input-sm" id="pass" name="password" placeholder="Password" required="required" value="">
            </div>

            <div class="form-group">
              <label for="lv"><span class="glyphicon glyphicon-level-up"></span> Level user</label>
              <select class="form-control input-sm" id="lv" name="">
                <option value="">Pilih Level User</option>
                <option value="1">Administrator</option>
                <option value="2">Mahasiswa</option>
              </select>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-block btn-sm btn-success" name="submit" value="Login">
            </div>
          </form>
        </div>

        <div class="modal-footer">

        </div>
      </div>
    </div>-->
<?php
  require_once "view/footer.php"
?>
