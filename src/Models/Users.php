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
}