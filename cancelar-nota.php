<?php
include('header.php');
$chave = $_GET["chave"];
$id = $_GET["id"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://webmaniabr.com/api/1/nfe/cancelar/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "{\n\t\"chave\":\"".$chave."\",\n\t\"motivo\":\"Cancelamento por motivos administrativos.\"\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: f764fbc9-79f1-592f-01c4-6072b4810595",
    "x-access-token: 1782-UFyYxOvTBWMP3D4yAC0E04E6enykR9lixbBSxhXC7OuXPKed",
    "x-access-token-secret: 8lpVgdEP7momlnkYg2KGJD41f4ZvclyUdflcInxPQMxkM0Os",
    "x-consumer-key: imYQ2VXlUwVcm7VnoCPwcw7cnpO5X1gT",
    "x-consumer-secret: skvgLetUTPQrjGTBbF8pZxYgIDC7VvzB2PGw6a09Oq6dPkRa"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  alterar($id, 'nfe', 'status', 'cancelado', $conexao);
  $resposta = json_decode($response, true);
}
?>
<div class="page-wrapper" style="min-height: 638px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Resultado</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Resultado</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <?php 
                                foreach ($resposta as $key => $value) {
                                  echo "<strong>".$key." => </strong>".$value."<br>";
                                }
                               ?>
                               <hr>
                               <div class="row">
                                 <div class="col">
                                   <a href="notas.php" class="btn btn-success">Voltar Para As Notas</a>
                                 </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

<?php include('footer.php'); ?>