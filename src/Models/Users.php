<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;
use App\DB;
use \PDO;
use App\Exceptions\ThisUserExists;
use App\Exceptions\AuthException;

class Users extends Model {

    protected const TABLE_NAME = 'users';

    public function signUp(string $username, string $email, string $password): void {

        if ($this->checkIfXExists('username', $username)) {
            throw new ThisUserExists('A user with this name already exists');
        }

        if ($this->checkIfXExists('email', $email)) {
            throw new ThisUserExists('A user with this email already exists');
        }

        try {
            $this->insertInto(['username', 'email', 'password'], [$username, $email, $password]);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function login(string $email, string $password): array | false {
        // returns true or false, the AuthController authorizes user if true
        if (!$this->checkIfXExists('email', $email)) {
            throw new AuthException("There's no user with this username or email");
        }

        $tableName = static::TABLE_NAME;

        $sql = "SELECT * FROM $tableName WHERE email = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);
            
            $data = $stmt->fetch();
            $correctPassword = $data['password'];
            $id = $data['id'];
            $username = $data['username'];

            if (password_verify($password, $correctPassword)) {
                return $data;
            } else {
                return false;
            }

        } catch(\PDOException $e) {
            if ($pdo->inTransaction()) {
            $pdo->rollBack();
            }
            throw new AuthException("Database error: " . $e->getMessage());
        }
    }
}