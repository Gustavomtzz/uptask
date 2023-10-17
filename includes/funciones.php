<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth(): void
{
    empty($_SESSION) ? session_start() : '';

    !isset($_SESSION['login']) ? header('Location: /') : '';
}

function esAdmin(): void
{

    empty($_SESSION) ? session_start() : '';

    !isset($_SESSION['admin']) ?  header('Location: /') : '';
}
