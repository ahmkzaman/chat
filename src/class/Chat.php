<?php

class Chat {

    private $storage = "../data/messages.txt";

    public function addMessage($message, User $user) {
        if (trim($message) != '') {
            $date = date('m/d/Y h:i:s a');
            file_put_contents($this->storage, "[" . $date . "] " . $user->getNickname() . ": " . $message . "\r\n", FILE_APPEND);
        }
    }

    public function getMessages($messagesToDisplay) {
        $messages = file($this->storage);
        $messages = array_slice($messages, -$messagesToDisplay);

        foreach ($messages as $key => $value) {
            $messages[$key] = htmlspecialchars($value);
        }

        return implode('<br/>', $messages);
    }
}