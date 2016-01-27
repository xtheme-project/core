<?php

namespace XTheme\Core\Model;

class Content
{
    protected $block;
    
    public function getBlock()
    {
        return $this->block;
    }
    
    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }
    
    protected $properties = array();

    public function addProperty(Property $property)
    {
        $this->properties[$property->getName()] = $property;
    }

    public function getProperties()
    {
        return $this->properties;
    }
    
    public function getProperty($name)
    {
        return $this->properties[$name];
    }
}
