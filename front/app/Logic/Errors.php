<?php

namespace App\Logic;

class Errors
{


    /**
     * Render not found
     *
     * @html errors/notfound
     */
    public function notfound() {}


    /**
     * Render not authorized
     *
     * @html errors/unauthorized
     */
    public function unauthorized() {}


    /**
     * Render fatal error
     *
     * @html errors/fatal
     */
    public function fatal() {}

}