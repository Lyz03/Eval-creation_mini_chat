<?php

namespace App\Manager;

use App\DB;
use App\Classe\Message;
use DateTime;

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
        $format = "Y-m-d H:i:s";

        return (new Message())
            ->setId($data['id'])
            ->setUser($userManager->getUserById($data['user_id']))
            ->setDateSent(DateTime::createFromFormat($format, $data['date_sent']))
            ->setContent($data['content'])
            ;
    }

    /**
     * add a new message
     * @param $idUser
     * @param $content
     * @return bool
     */
    public function newMessage($idUser, $content): bool {
        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (user_id, content)
            VALUES (:user, :content)");

        $stmt->bindParam('user', $idUser);
        $stmt->bindParam('content', $content);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}