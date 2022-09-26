<?php

require("inc/header.php");
echo "<div class='alert alert-warning' role='alert'>Vous n'avez pas accès à cette application.</div>";
echo "<section class='row'>
      <div class='col'>
        <p>Pour avoir accès à ce service, vous devez nous contacter <a href='mailto:". $_MAIL_CONTACT ."'>à cette adresse</a>.</p>
      </div>
    </section>";
require("inc/footer.php");
