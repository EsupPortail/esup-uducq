<?php

    function addLog($message)
    {
        global $_FIC_LOG;
        $dateLog = date("d/m/y H:i:s");
        $message = "[$dateLog] ['".$_SESSION['cas_user']."'] $message\n";
        error_log($message, 3, $_FIC_LOG);
    }

    function isLongURLValid($url)
    {
        if (preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $url)) {
            return true;
        } else {
            return false;
        }
    }

    function isShortURLValid($url)
    {
        if (preg_match('/^[a-z0-9\-]{1,40}$/', $url)) {
            return true;
        } else {
            return false;
        }
    }
