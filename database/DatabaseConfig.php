<?php

// Require ConfigGuard for Config Files
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/ConfigGuard.php';

class Database
{
    static function getPDO(): PDO
    {
        $PDOConnection = null;

        // Verify connection
        try {
            // Create new PDO Object
            $PDOConnection = new PDO(
                sprintf(
                    "mysql:host=%s;dbname=%s",
                    $_ENV['DATABASE_HOST'],
                    $_ENV['DATABASE_NAME']
                ),
                $_ENV['DATABASE_USERNAME'],
                $_ENV['DATABASE_PASSWORD']
            );

            // Test connection
            $PDOConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Log connection failure
            error_log("Connection unsuccessful: " . $e->getMessage());
        }

        return $PDOConnection;
    }

    // Utility functions for Common Database Actions
    static function BasicSQL(PDO $connection, string $query): bool
    {
        try {
            // Execute the query
            $connection->exec($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    static function SQLwithoutFetch(PDO $connection, string $query, array $keyValueBindMap = []): bool
    {
        try {
            // Prepare the statement
            $stmt = $connection->prepare($query);

            // Bind values if provided
            if (!empty($keyValueBindMap)) {
                foreach ($keyValueBindMap as $key => &$value) {
                    $stmt->bindParam($key, $value);
                }
            }

            // Execute the statement and return the number of affected rows
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false; // Indicate failure
            
        }
    }

    static function SQLwithFetch(PDO $connection, string $query, array $keyValueBindMap = []): array
    {
        try {
            // Prepare the statement
            $stmt = $connection->prepare($query);

            // Bind values if provided
            if (!empty($keyValueBindMap)) {
                foreach ($keyValueBindMap as $key => &$value) {
                    $stmt->bindParam($key, $value);
                }
            }

            // Execute the statement and return the number of affected rows
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
}

?>