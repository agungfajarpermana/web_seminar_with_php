
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){

        $('#errorUser').hide();
        $('#errorPass').hide();
        $('#errorNama').hide();
        $('#errorEmail').hide();
        $('#errorTlpn').hide();
        $('#errorLevel').hide();
        $('#errorFakul').hide();
        $('#errorProdi').hide();

        var error_user  = false;
        var error_pass  = false;
        var error_nama  = false;
        var error_email = false;
        var error_telp  = false;
        var error_level = false;
        var error_fakul = false;
        var error_prodi = false;

        $(document).on('keyup', '#inputUser', function(){
          return cek_username();
        });

        $(document).on('keyup', '#inputPass', function(){
          return cek_password();
        });

        $(document).on('keyup', '#inputNama', function(){
          return cek_nama();
        });

        $(document).on('keyup', '#inputEmail', function(){
          return cek_email();
        });

        $(document).on('keyup', '#inputTelp', function(){
          return cek_telepon();
        });

        $(document).on('focusout', '#inputLevel', function(){
          return cek_level();
        });

        $(document).on('focusout', '#inputFakul', function(){
          return cek_fakul();
        });

        $(document).on('focusout', '#inputProdi', function(){
          return cek_prodi();
        });



        function cek_username(){

          var username = $("#inputUser").val().length;
          if(username < 10 || username > 10){
            var form = document.getElementsByClassName('form-group')[0];
            var id = document.getElementsByClassName('glyphicon')[0];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorUser').html('username minimal 5-10 karakter');
            $('#errorUser').show();
            error_user  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[0];
            var id = document.getElementsByClassName('glyphicon')[0];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorUser').hide();
          }
        }

        function cek_password(){

          var password = $("#inputPass").val().length;
          if(password < 6){
            var form = document.getElementsByClassName('form-group')[1];
            var id = document.getElementsByClassName('glyphicon')[1];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorPass').html('username minimal 6 karakter');
            $('#errorPass').show();
            error_pass  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[1];
            var id = document.getElementsByClassName('glyphicon')[1];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorPass').hide();
          }
        }

        function cek_nama(){

          var nama = $("#inputNama").val().length;
          if(nama < 5){
            var form = document.getElementsByClassName('form-group')[2];
            var id = document.getElementsByClassName('glyphicon')[2];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorNama').html('nama minimal 5 karakter');
            $('#errorNama').show();
            error_nama  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[2];
            var id = document.getElementsByClassName('glyphicon')[2];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorNama').hide();
          }
        }

        function cek_email(){

          var email = $("#inputEmail").val().length;
          if(email < 5){
            var form = document.getElementsByClassName('form-group')[3];
            var id = document.getElementsByClassName('glyphicon')[3];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorEmail').html('email minimal 5 karakter');
            $('#errorEmail').show();
            error_email  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[3];
            var id = document.getElementsByClassName('glyphicon')[3];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorEmail').hide();
          }
        }

        function cek_telepon(){

          var telepon = $("#inputTelp").val().length;
          if(telepon < 12 || telepon > 12){
            var form = document.getElementsByClassName('form-group')[4];
            var id = document.getElementsByClassName('glyphicon')[4];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorTlpn').html('telepon minimal 5-12 karakter');
            $('#errorTlpn').show();
            error_telp  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[4];
            var id = document.getElementsByClassName('glyphicon')[4];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorTlpn').hide();
          }
        }

        function cek_level(){

          var level = $("#inputLevel").val();
          if(level == ''){
            var form = document.getElementsByClassName('form-group')[5];
            var id = document.getElementsByClassName('glyphicon')[5];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorLevel').html('mohon pilih fakultas');
            $('#errorLevel').show();
            error_level  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[5];
            var id = document.getElementsByClassName('glyphicon')[5];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorLevel').hide();
          }

        }

        function cek_fakul(){

          var fakultas = $("#inputFakul").val();
          if(fakultas == ''){
            var form = document.getElementsByClassName('form-group')[6];
            var id = document.getElementsByClassName('glyphicon')[6];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorFakul').html('mohon pilih fakultas');
            $('#errorFakul').show();
            error_fakul  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[6];
            var id = document.getElementsByClassName('glyphicon')[6];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorFakul').hide();
          }

        }

        function cek_prodi(){

          var prodi = $("#inputProdi").val();
          if(prodi == ''){
            var form = document.getElementsByClassName('form-group')[7];
            var id = document.getElementsByClassName('glyphicon')[7];
            id.className = 'glyphicon glyphicon-remove form-control-feedback';
            form.className = 'form-group has-feedback has-error';
            $('#errorProdi').html('mohon pilih prodi');
            $('#errorProdi').show();
            error_prodi  = true;
          }else{
            var form = document.getElementsByClassName('form-group')[7];
            var id = document.getElementsByClassName('glyphicon')[7];
            id.className = 'glyphicon glyphicon-ok form-control-feedback';
            form.className = 'form-group has-feedback has-success';
            $('#errorProdi').hide();
          }
        }

        $(document).on('click', '#tambahAdmin', function(){
          var user  = $("#inputUser").val();
          var pass  = $("#inputPass").val();
          var nama  = $("#inputNama").val();
          var email = $("#inputEmail").val();
          var telp  = $("#inputTelp").val();
          var level = $("#inputLevel").val();
          var fakul = $("#inputFakul").val();
          var prodi = $("#inputProdi").val();

          error_user  = false;
          error_pass  = false;
          error_nama  = false;
          error_email = false;
          error_telp  = false;
          error_level = false;
          error_fakul = false;
          error_prodi = false;

          cek_username();
          cek_password();
          cek_nama();
          cek_email();
          cek_telepon();
          cek_level();
          cek_fakul();
          cek_prodi();

          if(error_user == false && error_pass == false && error_nama == false && error_email == false && error_telp == false && error_level == false && error_fakul == false && error_prodi == false){
            $.ajax({
              url: 'seminar_tambah_admin.php',
              method: 'POST',
              data: {user:user,pass:pass,nama:nama,email:email,telp:telp,level:level,fakul:fakul,prodi:prodi},
              success: function(data){
                if(data == 1){
                  alert("Berhasil");
                }else{
                  alert("Gagal");
                }
              }
            });
          }else{
            return false;
          }
        });

      });
    </script>
  </body>
</html>
