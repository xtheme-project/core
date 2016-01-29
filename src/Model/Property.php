<?php

namespace XTheme\Core\Model;

class Property
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
    
    protected $language;
    
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }
    
    protected $value;
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
}
