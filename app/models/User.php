<?php
namespace app\models;

use database\DataBase;
use PDO;

require_once __DIR__ . '/../../database/DataBase.php';

class User {
    private static function getConnection() {
        $db = new DataBase();
        return $db->conectar();
    }

    /**
     * Cria um usuário (database ou oauth)
     * Espera um array associativo com os campos da tabela
     */
    public static function create(array $data) {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password_hash, provider, provider_id)
            VALUES (:username, :email, :password_hash, :provider, :provider_id)
        ");

        return $stmt->execute([
            ':username'     => $data['username'],
            ':email'        => $data['email'],
            ':password_hash'=> $data['password_hash'] ?? null,
            ':provider'     => $data['provider'],
            ':provider_id'  => $data['provider_id'] ?? null,
        ]);
    }

    /**
     * Verifica se já existe usuário pelo username ou email
     */
    public static function exists(string $username, string $email): bool {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Busca usuário pelo username (apenas provider=database)
     */
    public static function findByUsername(string $username): ?array {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND provider = 'database'");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Busca usuário pelo provider e provider_id
     */
    public static function findByProvider(string $provider, string $providerId): ?array {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE provider = ? AND provider_id = ?");
        $stmt->execute([$provider, $providerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Busca todos usuários (exemplo)
     */
    public static function getAll(): array {
        $pdo = self::getConnection();
        $stmt = $pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza usuário
     */
    public static function update(int $id, array $data): bool {
        $pdo = self::getConnection();

        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute($params);
    }

    /**
     * Deleta usuário
     */
    public static function delete(int $id): bool {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Verifica login database
     */
    public static function verify(string $username, string $password): ?array {
        $user = self::findByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }
}
