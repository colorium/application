<?php

namespace App\Model;

use Colorium\Orm;

class User
{

    use Orm\Model;

    /**
     * @id
     * @var int
     */
    public $id;

    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /** @var string */
    public $email;

    /** @var int */
    public $rank = 1;

}