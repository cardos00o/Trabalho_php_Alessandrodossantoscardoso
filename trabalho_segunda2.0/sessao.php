<?php
session_start();

if (!isset($_SESSION["transacoes"])) {
    $_SESSION["transacoes"] = [];
}
?>