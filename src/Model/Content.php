<?php

namespace XTheme\Core\Model;

class Content
{
    use PropertyTrait;
    
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
}
