<?php

namespace XTheme\Core\Model;

class Block
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
    
    protected $type;
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    protected $header;
    
    public function getHeader()
    {
        return $this->header;
    }
    
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
    
    protected $footer;
    
    public function getFooter()
    {
        return $this->footer;
    }
    
    public function setFooter($footer)
    {
        $this->footer = $footer;
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
    
    protected $editable = 'Y';
    
    public function getEditable()
    {
        return $this->editable;
    }
    
    public function setEditable($editable)
    {
        $this->editable = $editable;
        return $this;
    }
    
    protected $global = 'N';
    
    public function getGlobal()
    {
        return $this->global;
    }
    
    public function setGlobal($global)
    {
        $this->global = $global;
        return $this;
    }
}
