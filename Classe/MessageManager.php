<?php

namespace App\Manager;

use App\DB;
use App\Classe\Message;

class MessageManager
{
    const TABLE = 'message';

    /**
     * Create a new User Entity
     * @param array $data
     * @param $userManager
     * @return Message
     */
    private static function createMessage(array $data, $userManager): Message
    {
        return (new Message())
            ->setId($data['id'])
            ->setUser1($userManager->getUserById($data['user1']))
            ->setUser2($userManager->getUserById($data['user2']))
            ->setContent($data['content'])
            ;
    }

    public function newMessage($idUser1, $idUser2, $content) {
        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (user1_id, user2_id, content)
            VALUES (:user1, :user2, :content)");

        $stmt->bindParam('user1', $idUser1);
        $stmt->bindParam('user2', $idUser2);
        $stmt->bindParam('content', $content);


        $stmt->execute();
    }

    /**
     * get all messages between 2 users
     * @param int $idUser1
     * @param int $idUser2
     * @return array
     */
    public function getMessages(int $idUser1, int $idUser2): array {
        $messages = [];

        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE .
            "  WHERE (user1_id = $idUser1 OR user1_id = $idUser2) AND (user2_id = $idUser1 OR user2_id = $idUser2) ");

        if ($query && $data = $query->fetchAll()) {
            $userManager = new UserManager();
            foreach ($data as $value) {
                $messages[] = self::createMessage($value, $userManager);
            }
        }

        return $messages;
    }
}