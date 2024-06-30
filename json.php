<html>
    <head>
        <title>WS NEO FEEDER</title>
        <link rel="icon" href="https://lldikti6.kemdikbud.go.id/wp-content/uploads/2019/11/cropped-logo-32x32.png" sizes="32x32" />
        <link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css">
 
    </head>
    <body>
        <!--end datatable-->
        <div class="container">
            <div class="page-header" id="banner">

                <?php require "koneksi.php";
                include 'config/initsoap.php'; ?>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#report').DataTable();
                            });
                        </script>
                        <h1>Data Program Studi</h1>
                        <?php $no = 0;
$filter = "";
$order = "";
$limit = "";
$offset = "";
$dictejum = [
    'act' => 'GetDictionary',
    'token' => $_token,
    'filter' => $filter, 
    'order' => $order, 
    'fungsi'=> 'GetListMahasiswa',
    'limit' => $limit, 
    'offset' => $offset
];
$dataprodi = json_decode($_ws->execute($dictejum));

// Convert the decoded data back to JSON and display it
$jsonData = json_encode($dataprodi, JSON_PRETTY_PRINT);
echo $jsonData; 

?>
                    </div>
                  
                    <div class="col-lg-4 col-md-5 col-sm-6">

                    </div>
                </div>
                <hr>
                <small>copyleft @ 2022. ghufronasadly.com.</small>


            </div>
        </div>
    </body>
</html>