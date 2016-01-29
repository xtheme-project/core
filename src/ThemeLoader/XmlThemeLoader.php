<?php

namespace XTheme\Core\ThemeLoader;

use SimpleXMLElement;
use XTheme\Core\Model\Theme;
use XTheme\Core\Model\Block;
use XTheme\Core\Model\Property;

class XmlThemeLoader
{
    public function load($filename)
    {
        $theme = new Theme();
        $xml = file_get_contents($filename);
        $rootNode = new SimpleXMLElement($xml);
        $theme->setBasePath(dirname($filename));

        $theme->setName((string)$rootNode['name']);
        foreach ($rootNode->block as $blockNode) {
            $block = new Block();
            $block->setName((string)$blockNode['name']);
            $block->setType((string)$blockNode['type']);
            $block->setGlobal((string)$blockNode['global']);
            $block->setEditable((string)$blockNode['editable']);
            $block->setHeader((string)$blockNode->header);
            $block->setFooter((string)$blockNode->footer);
            
            foreach ($blockNode->property as $propertyNode) {
                $property = new Property();
                $property->setName((string)$propertyNode['name']);
                $property->setLanguage((string)$propertyNode['language']);
                $property->setValue((string)$propertyNode);
                $block->setProperty($property);
            }
            $theme->addBlock($block);
        }
        return $theme;
    }
}
