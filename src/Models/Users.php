<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;
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

    // returns true or false, the AuthController authorizes user if true
    public function login(string $email, string $password): array | false {
        if (!$this->checkIfXExists('email', $email)) {
            throw new AuthException("There's no user with this username or email");
        }

        $tableName = static::TABLE_NAME;

        $sql = "SELECT * FROM $tableName WHERE email = ?";

        $data = $this->executeSql($sql, [$email])->fetch();
        $correctPassword = $data['password'];
        $id = $data['id'];
        $username = $data['username'];

        if (password_verify($password, $correctPassword)) {
            return $data;
        } else {
            return false;
        }
    }

}