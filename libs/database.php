<?php

/**
 * @return PDO
 */
function pdo()
{
    static $pdo;
    if ($pdo) {
        return $pdo;
    }
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=cotton', 'postgres');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
function findAll($sql)
{
    return pdo()->query($sql)->fetchAll();
}
