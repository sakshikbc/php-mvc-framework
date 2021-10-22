<?php

namespace MVC\Core;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName() : string;
    
}