<?php
session_start();
session_unset();
session_destroy();

header("Location: ../htmls/index.php");
?>