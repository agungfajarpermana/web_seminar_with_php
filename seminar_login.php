<?php
  require_once "core/init.php";
  require_once "view/header_login.php";
  error_reporting(0);

  if($_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  $error = '';

  if(isset($_POST['submit'])){
    $username  = $_POST['user'];
    $password  = $_POST['pass'];
    $level     = $_POST['level'];

    if(!empty(trim($username)) && !empty(trim($password))){

      if(cek_login($username,$password,$level)){
        $_SESSION['user'] = $username;
        header("Location: seminar_jadwal.php");

      }else{
        $error = 'Username, Password Dan Level Yang Dimasukan Salah';
      }

    }else{
      $error = 'Username, Password Dan Level User Harus Di Isi..';
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
          <li><a href="index.php #wra" class="">Tentang</a></li>
          <li><a href="seminar_login.php" class="#">Login</a></li>
        </ul>
      </div>

    </div>
  </nav>

  <div class="fluid-header">
    <div class="container">
      <div class="row rows">
        <div class="col-sm-6 col-md-6">
          <h1>Login</h1>
          <p class="text-justify lead">
            Hey! selamat datang di website seminar kampus. tanam ilmu sekarang, panen di masa depan
          </p>
        </div>

        <div class="col-sm-offset-2 col-sm-3 col-md-offset-2 col-md-4 collapse navbar-collapse">
          <img src="image/image-login/orang.png" alt="Login" class="img-responsive" width="150px" />
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-center">
    <div class="container">
      <form class="col-md-offset-2 col-md-8" action="#" method="post">
        <?php if($error != ''): ?>
          <div class="alert alert-danger" style="margin-top: -20px;">
        <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="user"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Username</label>
          <input type="text" class="form-control input-lg" name="user" placeholder="username" value="">
          <!--<span class="help-block">username tidak boleh kosong</span>-->
        </div>

        <div class="form-group">
          <label for="pass"><span class="glyphicon glyphicon-eye-close"></span> Password</label>
          <input type="password" class="form-control input-lg" name="pass" placeholder="password" value="">
          <!--<span class="help-block">password tidak boleh kosong</span>-->
        </div>

        <div class="form-group">
          <label for="level">Level User</label>
          <select class="form-control input-lg" name="level">
            <option value="">== Pilih Level User ==</option>
            <option value="2">Super Admin</option>
            <option value="1">Admin</option>
            <option value="0">Mahasiswa</option>
          </select>
        </div>

        <button type="submit" class="btn btn-block btn-lg btn-primary" name="submit">
          LOGIN
        </button>
      </form>
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
