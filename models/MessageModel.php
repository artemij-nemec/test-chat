<?php 
namespace Models;
use Models\db\Message;

class MessageModel extends Message {
    const MAX_MESSAGE_COUNT = 20;

    public static function getMessages() {
        return parent::find()
            ->select("user_name", "text", "strftime('%d.%m.%Y - %H:%M:%S',date_create) as date_create")
            ->orderBy("date_create", "DESC")
            ->setMaxResults(self::MAX_MESSAGE_COUNT)
            ->execute()
            ->fetchAll();
    }

    public static function getLastMessagesJSON() {
        return '{"status" : "ok", "messages" : ' . json_encode(self::getMessages()) . '}';
    }

    public static function addMessage($user_name, $message) {
        $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
        $message = filter_var($message, FILTER_SANITIZE_STRING);
        self::getConnection()->insert('message', ['user_name' => $user_name, 'text' => "{$message}"]);
    }
}