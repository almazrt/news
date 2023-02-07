<?php

namespace App\Modules\System\Data\Logger;

enum RequestMethodEnum: string
{
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';
}
