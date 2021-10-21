<?php

namespace MVC\Core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            # code...
            $flashMessage['removed'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        // var_dump($_SESSION[self::FLASH_KEY]);
    }
    
    public function setFlash($key, $message)
    {
        # code...
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];

    }

    public function getFlash($key)
    {
        # code...
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * Class destructor.
     */
    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            # code...
            if($flashMessage['removed']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        
    }
}