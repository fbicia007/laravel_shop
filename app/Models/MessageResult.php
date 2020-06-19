<?php
namespace App\Models;

class MessageResult {

    public $status;
    public $message;

    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}
