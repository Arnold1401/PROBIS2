<?php
    session_start();

    if ($_POST["jenis"]=="keluar") {
        session_destroy();
    }
?>