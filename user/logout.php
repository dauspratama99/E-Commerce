<?php
session_start();

setcookie('email','', time() -3600);
session_destroy();
?>
<script>document.location = '<?= BASE_URL ?>/index.php'; </script>";


