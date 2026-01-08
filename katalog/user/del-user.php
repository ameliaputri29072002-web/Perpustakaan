<?php

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";


$id = $_GET['id'];
$foto = $_GET['foto'];

if(delete($id, $foto)){
  echo "
      <script>document.location.href = 'data-user.php?msg=deleted';</script>

  ";
} else {
  echo "
      <script>document.location.href = 'data-user.php?msg=aborted';</script>
  ";
}
