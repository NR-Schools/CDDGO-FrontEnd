<?php


global $PDOConnection;

// Verify connection
try {
    // Create new PDO Object
    $PDOConnection = new PDO("mysql:host=localhost;dbname=it135_8l", "root", "%RGiG@8n02Mb");

    // Test connection
    $PDOConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection successful, log it
    error_log("Connection successful.");

} catch (PDOException $e) {
    // Log connection failure
    error_log("Connection unsuccessful: " . $e->getMessage());
}




// Utility functions for Common Database Actions
function BasicSQL(PDO $connection, string $query): void
{
    try {
        // Execute the query
        $connection->exec($query);
    } catch (PDOException $e) {
    }
}

function SQLwithoutFetch(PDO $connection, string $query, array $keyValueBindMap = [])
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
        return false; // Indicate failure
    }
}

function SQLwithFetch(PDO $connection, string $query, array $keyValueBindMap = [])
{
    try {
        // Prepare the statement
        $stmt = $connection->prepare($query);

        // Bind values if provided
        if (!empty($keyValueBindMap)) {
            foreach ($keyValueBindMap as $key => $value) {
                $stmt->bindParam($key, $value);
            }
        }
        
        // Execute the statement and return the number of affected rows
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return false; // Indicate failure
    }
}

?>