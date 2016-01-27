<?php

namespace XTheme\Core\SiteLoader;

use SimpleXMLElement;
use XTheme\Core\Model\Site;
use XTheme\Core\Model\Page;
use XTheme\Core\Model\Content;
use XTheme\Core\Model\Property;

class XmlSiteLoader
{
    public function load($filename)
    {
        $site = new Site();
        $xml = file_get_contents($filename);
        $rootNode = new SimpleXMLElement($xml);

        $site->setName((string)$rootNode['name']);
    
        $this->loadContents($rootNode->content, $site);
        foreach ($rootNode->page as $pageNode) {
            $page = new Page();
            $page->setName((string)$pageNode['name']);
            $page->setTemplate((string)$pageNode['template']);
            
            $this->loadContents($pageNode->content, $page);
            $site->addPage($page);
        }
        return $site;
    }
    
    private function loadContents(SimpleXmlElement $contentsNode, $container)
    {
        foreach ($contentsNode as $contentNode) {
            $content = new Content();
            $content->setBlock((string)$contentNode['block']);
            foreach ($contentNode->property as $propertyNode) {
                $property = new Property();
                $property->setName((string)$propertyNode['name']);
                $property->setValue((string)$propertyNode);
                $content->addProperty($property);
            }
            $container->addContent($content);
        }
    }
}
