<?php

#Générateur de QR code

include('inc/phpqrcode.php');

if (isset($_GET['code'])) {
    QRcode::png($_GET['code']);
}
