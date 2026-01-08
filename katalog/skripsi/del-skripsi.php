<?php



require "../config/config.php";
require "../config/functions.php";
require "../module/mode-skripsi.php";


$id = $_GET['id'];

if(delete($id)){
  echo "
      <script>document.location.href = 'data-skripsi.php?msg=deleted';</script>

  ";
} else {
  echo "
      <script>document.location.href = 'data-skripsi.php?msg=aborted';</script>
  ";
}
