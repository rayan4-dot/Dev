<?php
namespace App\Class\Crud;


require_once __DIR__ . '/../../../vendor/autoload.php';



use App\Config\Database;

use PDO;
use PDOException;

class Crud extends Database
{
    // // Use the inherited connection directly
    // function __construct()
    // {
    //     parent::__construct(); // Calling the parent constructor to establish the connection
    // }

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

    public function updateRecord(string $table, array $data, int $id): bool
    {
        $args = [];
        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }

        $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";

        try {
            $stmt = $this->getConnection()->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing statement: " . implode(', ', $this->getConnection()->errorInfo()));
                return false;
            }

            return $stmt->execute(array_merge(array_values($data), [$id]));
        } catch (PDOException $e) {
            error_log("Error updating record: " . $e->getMessage());
            return false;
        }
    }

    public function deleteRecord(string $table, int $id, string $column = 'id'): bool
    {
        $sql = "DELETE FROM $table WHERE $column = ?";

        try {
            $stmt = $this->getConnection()->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing statement: " . implode(', ', $this->getConnection()->errorInfo()));
                return false;
            }

            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting record: " . $e->getMessage());
            return false;
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
