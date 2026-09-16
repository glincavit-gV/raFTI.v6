<?php

/**
 * raFTI host compatibility facade.
 *
 * Standalone implementation of the db_query() contract
 * used by raFTI outside the Laravel environment.
 */

if (!function_exists('db_query')) {

    function db_query(string $sql): \PDOStatement
    {
        global $nfc_pdo;

        if (!isset($nfc_pdo) || !($nfc_pdo instanceof \PDO)) {
            throw new \RuntimeException(
                'raFTI: PDO connection is not initialized'
            );
        }

        $stmt = $nfc_pdo->query($sql);

        if ($stmt === false) {
            throw new \RuntimeException(
                'raFTI: db_query() failed'
            );
        }

        return $stmt;
    }
}