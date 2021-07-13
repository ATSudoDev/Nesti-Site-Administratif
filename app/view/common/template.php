<?php

// Head
include(PATH_COMMON . 'head.php');

//Navigation
if (($loc != "connection") && ($loc != "disconnection")) {
    include('navigation.php');
}

//Content 
include(PATH_CTRL . 'controller_content.php');

// Scripts
include('scripts.php'); ?>

</body>

</html>