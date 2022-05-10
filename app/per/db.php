<?php
# MySQLi
$mysqliP = mysqli_init();
$mysqliP->ssl_set(NULL, NULL, "/etc/ssl/certs/ca-certificates.crt", NULL, NULL);
$mysqliP->real_connect(getenv('DB_HOST_P'), getenv('DB_USER_P'), getenv('DB_PASSWORD_P'), 'inleggo');

if ($mysqliP->connect_errno) {
    echo "La conexión fallo: %s\n". $mysqliP->connect_error ;
    exit();
}else{
    $mysqliP->query("SET time_zone = '-5:00'");
    $mysqliP->query("SET NAMES 'utf8'");
    $mysqliP->query("SET lc_time_names = 'es_PE'");
    clearStoredResultsP($mysqliP);
}

function clearStoredResultsP($mysqli_link){
  while($mysqli_link->more_results() && $mysqli_link->next_result()) {
      $extraResult = $mysqli_link->use_result();
      if($extraResult instanceof mysqli_result){
          $extraResult->free();
      }
  }
}
