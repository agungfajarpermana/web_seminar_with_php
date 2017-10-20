
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){

        $('a[data-toggle="tab"]').on('hidden.bs.tab', function (e) {
          e.target // newly activated tab
          e.relatedTarget // previous active tab
        });

        $(document).on('click', '#modal-info', function(){
          var id_seminar = $(this).attr('data-id');

          $.ajax({
            url: "seminar_modalBox.php",
            method: "POST",
            data: {id_seminar:id_seminar},
            success: function(data){
              $("#total").html(data);
            }
          });
        });

      });
    </script>
  </body>
</html>
