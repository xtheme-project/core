<?php

namespace XTheme\Core\Model;

use InvalidArgumentException;

trait PropertyTrait
{
    protected $properties = array();
    
    public function setProperty(Property $property)
    {
        if ($property->getLanguage()=='') {
            throw new InvalidArgumentException("Property doesn't have a language: " . $property->getName() . " with value " . $property->getValue());
        }
        if (strpos($property->getName(), '_')>0) {
            throw new InvalidArgumentException("Property name should not contain underscores: " . $property->getName() . " with value " . $property->getValue());
        }
        if (!isset($this->properties[$property->getLanguage()])) {
            $this->properties[$property->getLanguage()] = array();
        }
        $this->properties[$property->getLanguage()][$property->getName()] = $property;
    }
    
    public function getPropertiesByLanguage($language)
    {
        if (!isset($this->properties[$language])) {
            return array();
        }
        return $this->properties[$language];
    }
    public function getProperty($language, $name)
    {
        $properties = $this->getPropertiesByLanguage($language);
        if (!isset($properties[$name])) {
            return null;
        }
        return $properties[$name];
    }
}
