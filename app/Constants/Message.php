<?php

namespace App\Constants;

class Message
{
    public static function GROUP_JOIN_REQUEST($groupName)
    {
        return "さんから" . $groupName . "への参加リクエストが来ています";
    }
}
