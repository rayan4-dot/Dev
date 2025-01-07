<?php

namespace App\Class\Crud;

use PDO;
use PDOException;
use App\Config\Database;

class Crud extends Database
{
    public function insertRecord(string $table, array $data): int
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table($columns) VALUES($placeholders)";

        try {
            $stmt = $this->getConnection()->prepare($sql);

            if (!$stmt) {
                return 0;
            }

            $stmt->execute(array_values($data));

            return (int)$this->getConnection()->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return 0;
        }
    }

    public function selectRecords(string $table, string $columns = '*', string $where = null): array|bool
    {
        $sql = "SELECT $columns FROM $table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        try {
            $stmt = $this->getConnection()->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing statement: " . implode(', ', $this->getConnection()->errorInfo()));
                return false;
            }

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error selecting records: " . $e->getMessage());
            return false;
        }
    }
}
