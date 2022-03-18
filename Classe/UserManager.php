<?php

namespace App\Classe;

use App\DB;

class UserManager
{
    public const TABLE = 'user';

    /**
     * Create a new User Entity
     * @param array $data
     * @return User
     */
    private static function createUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ;
    }

    /**
     * Return a user based on a given id.
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): ?User {
        $user = null;
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE id = $id");

        if ($query && $data = $query->fetch()) {
            $user = self::createUser($data);
        }
        return $user;
    }


    /**
     * Register new user
     * @param string $mail
     * @param string $username
     * @param string $password
     */
    public function registerUser(string $mail, string $username, string $password) {

        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (email, username, password)
            VALUES (:email, :username, :password)");

        $stmt->bindParam('email', $mail);
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);


        $stmt->execute();
    }


    /**
     * Check if a user exist (for connection)
     * @param string $mail
     * @return User|null
     */
    public function userExist(string $mail): ?User {
        $stmt = DB::getConnection()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :mail");

        $stmt->bindParam('mail', $mail);

        if ($stmt->execute() && $data = $stmt->fetch()) {
            return self::createUser($data);
        }

        return null;
    }

}
