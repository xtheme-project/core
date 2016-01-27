<?php

namespace XTheme\Core\Model;

trait ContentTrait
{
    protected $contents = array();
    
    public function addContent(Content $content)
    {
        $this->contents[] = $content;
    }
    
    public function getContents()
    {
        return $this->contents;
    }
}
