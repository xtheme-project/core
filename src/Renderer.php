<?php

namespace XTheme\Core;

use XTheme\Core\Model\Site;
use XTheme\Core\Model\Theme;
use XTheme\Core\Model\Content;
use XTheme\Core\Model\Tag;
use XTheme\Core\Model\Block;
use XTheme\Core\Model\Context;
use RuntimeException;
use DOMDocument;

class Renderer
{
    private function renderContent(Block $block, $content, Context $context)
    {
        $value = $block->getProperty('content')->getValue();
        if ($content) {
            $value = $content->getProperty('content')->getValue();
        }
        if ($value) {
            $value = $block->getHeader() . $value . $block->getFooter();
        }
        return $value;
    }
    private function getTagValue(Tag $tag, Context $context)
    {
        switch ($tag->getName()) {
            case 'include':
                $filename = $context->getTheme()->getBasePath() . '/code/' . $tag->getAttribute('name');
                $value = file_get_contents($filename);
                $value = $this->processTags($value, $context);
                break;
                
            case 'block':
                $content = $context->getContentByBlockName($tag->getAttribute('name'));
                if (!$content) {
                    throw new RuntimeException("Can't find content by name: " . $tag->getAttribute('name'));
                }
                $block = $context->getTheme()->getBlockByName($tag->getAttribute('name'));
                if (!$block) {
                    throw new RuntimeException("Can't find block by name: " . $tag->getAttribute('name'));
                }

                $value = $this->renderContent($block, $content, $context);
                break;
            default:
                throw new RuntimeException("Unknown tag: " . $tag->getName());
                break;
        }
        return $value;
    }
    
    private function processTags($string, Context $context)
    {
        preg_match_all("~\{\{\s*(.*?)\s*\}\}~", $string, $matches);
        foreach ($matches[1] as $key => $tag) {
            $tag = '<' . trim($tag) . ' />';
            $dom = new DOMDocument();
            $dom->loadXml($tag);
            $t = new Tag();
            $t->setName((string)$dom->documentElement->nodeName);
            foreach ($dom->documentElement->attributes as $a) {
                $t->setAttribute((string)$a->nodeName, (string)$a->nodeValue);
            }
            
            $content = $this->getTagValue($t, $context);
            $string = str_replace($matches[0][$key], $content, $string);
        }
        return $string;
    }
    
    public function renderSitePage(Theme $theme, Site $site, $pageName, $language = null)
    {
        $context = new Context();
        $context->setTheme($theme);
        // Load all site-wide contents into the context
        foreach ($site->getContents() as $content) {
            $context->addContent($content);
        }
        
        
        $page = $site->getPageByName($pageName);
        
        // Load all page-wide contents into the context
        foreach ($page->getContents() as $content) {
            $context->addContent($content);
        }
        
        if (!$page) {
            throw new RuntimeException("No such page in site: " . $pageName);
        }
        $templateName = $page->getTemplate();
        $templateFilename = $theme->getBasePath() . '/code/' . $templateName;
        $data = file_get_contents($templateFilename);
        $data = $this->processTags($data, $context);
        //echo "\n##FINAL:##\n" . $data; exit('boom');
        return $data;
    }
}
