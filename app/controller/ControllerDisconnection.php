<?php 

$UserSession->disconnectUser();

header('Location:' . BASE_URL . 'connection');
die();
