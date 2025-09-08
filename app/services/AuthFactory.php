<?php
namespace app\services;
require_once __DIR__. '/../contracts/AuthInterface.php';
require_once __DIR__ . '/DatebaseAuthService.php';
require_once __DIR__ . '/GoogleAuthService.php';
require_once __DIR__ . '/FacebookAuthService.php';

use app\contracts\AuthInterface;
use app\services\DatabaseAuthService;
use app\services\GoogleAuthService;
use app\services\FacebookAuthService;


class AuthFactory 
{
    public function make(string $authType): AuthInterface
    {
        return match($authType) {
            'google'   => new GoogleAuthService(),
            'facebook' => new FacebookAuthService(),
            default    => new DatabaseAuthService(),
        };
    }
}
