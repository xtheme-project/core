<?php

namespace XTheme\Core\Model;

class Theme
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
    
    protected $basePath;
    
    public function getBasePath()
    {
        return $this->basePath;
    }
    
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }
    
    protected $blocks = array();
    
    public function addBlock(Block $block)
    {
        $this->blocks[$block->getName()] = $block;
    }
    
    public function getBlocks()
    {
        return $this->blocks;
    }
    
    public function getBlockByName($name)
    {
        if (isset($this->blocks[$name])) {
            return $this->blocks[$name];
        }
        return null;
    }
}
