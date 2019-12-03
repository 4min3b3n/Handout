<?php

function disconnect() {
    session_start();
    session_destroy();
    header('Location: /index.php');
}

disconnect();

