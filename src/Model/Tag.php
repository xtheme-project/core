<?php

namespace XTheme\Core\Model;

class Tag
{
    protected $name;
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    private $attributes = array();
    
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    
    public function getAttribute($name)
    {
        return $this->attributes[$name];
    }
}
