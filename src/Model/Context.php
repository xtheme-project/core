<?php 

namespace XTheme\Core\Model;

class Context
{
    private $theme;
    
    public function getTheme()
    {
        return $this->theme;
    }
    
    public function setTheme(Theme $theme)
    {
        $this->theme = $theme;
        return $this;
    }
    
    private $contents = array();
    
    public function addContent(Content $content)
    {
        $this->contents[] = $content;
    }
    
    public function getContents()
    {
        return $this->contents;
    }
    
    public function getContentByBlockName($blockName)
    {
        foreach ($this->contents as $content) {
            if ($content->getBlock() == $blockName) {
                return $content;
            }
        }
        return null;
    }
}
