<?php

namespace XTheme\Core\Model;

class Site
{
    use ContentTrait;
    
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
    
    protected $pages = array();
    
    public function addPage(Page $page)
    {
        $this->pages[$page->getName()] = $page;
    }
    
    public function getPages()
    {
        return $this->pages;
    }
    
    public function getPageByName($name)
    {
        if (!isset($this->pages[$name])) {
            return null;
        }
        return $this->pages[$name];
    }
}
