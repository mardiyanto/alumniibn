<?php   include 'koneksi.php';
  include 'config/initsoap.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="sys/bootstrap/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="sys/bootstrap/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="sys/bootstrap/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="sys/bootstrap/plugins/datatables/dataTables.bootstrap.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
  <div class='row'>
 <?php echo" <div class='row'>
  <div class='col-lg-6'>
<div class='panel panel-default'>
         <div class='panel-heading'>
        Profil PT $d->nama_perguruan_tinggi
         </div>
         <div class='panel-body'>
         <table id='example1' class='table table-bordered table-striped'>
                                      <thead>
                                          <tr> <th>No</th>
                                              <th>NAMA</th>
                                              <th>Keterangan</th>
                                          </tr>
                                      </thead><tbody>";
         $tebaru=mysqli_query($koneksi," SELECT * FROM postman ");
         while ($t=mysqli_fetch_array($tebaru)){
          echo"
                                          <tr><td>$no</td>
                                              <td><a class='btn btn-info' href='jsondata.php?id_d=$t[nama_postman]' target='_blank'>$t[nama_postman]</a></td> 
                                              <td>$t[ket_postman]</td> 

                                          </tr>";
  }
                                  echo"
                                      </tbody></table>
</div>
         </div>
       </div>"; ?>

    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="sys/bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="sys/bootstrap/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="sys/bootstrap/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

    <!-- DataTables -->
    <script src="sys/bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="sys/bootstrap/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>

