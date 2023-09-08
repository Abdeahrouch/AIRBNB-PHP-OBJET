<?php

namespace Core\Repository;
/*
- un trait permet de gérer une portion de code qui peut etre utilisée dans plusieurs classes sans notion de hiérarchie.
- self: ici représente la classe qui appel le trait


*/

trait RepositoryManagerTrait
{
    private static ?self $rm_instance = null;

    public static function getRm(): self
    {
        if (is_null(self::$rm_instance)) {
            self::$rm_instance = new self();
        }
        return self::$rm_instance;
    }

    protected function __construct()
    {
    }
    protected function __clone()
    {
    }
    public function __wakeup()
    {
    }
}
