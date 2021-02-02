<?php

namespace Common\Enums\Base;

use Common\Enums\AbstractEnum;

class RequestMethods extends AbstractEnum
{
    protected static function getEnum(): array
    {
        return [
            'get' => 'GET',
            'post' => 'POST',
            'put' => 'PUT',
            'patch' => 'PATCH',
            'delete' => 'DELETE',
            'copy' => 'COPY',
            'head' => 'HEAD',
            'options' => 'OPTIONS',
            'link' => 'LINK',
            'unlink' => 'UNLINK',
            'purge' => 'PURGE',
            'lock' => 'LOCK',
            'unlock' => 'UNLOCK',
            'propfind' => 'PROPFIND',
            'view' => 'VIEW'
        ];
    }
}
