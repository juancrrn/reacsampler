<?php

abstract class User
{
    
    public function getType(): string
    {
        return get_class($this);
    }
}

?>