<?php
session_start();
session_destroy();
header("location: ../../arpweb/index.htm");
?>