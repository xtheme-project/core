<?php

namespace XTheme\Core;

use PHPUnit_Framework_TestCase;
use XTheme\Core\ThemeLoader\XmlThemeLoader;
use XTheme\Core\SiteLoader\XmlSiteLoader;
use XTheme\Core\Renderer;

class ThemeLoaderTest extends PHPUnit_Framework_TestCase
{
    public function testLoader()
    {
        $themeLoader = new XmlThemeLoader();
        $theme = $themeLoader->load(__DIR__ . '/../themes/demo/theme.xml');
        $this->assertEquals($theme->getName(), 'Demo');
        
        $siteLoader = new XmlSiteLoader();
        $site = $siteLoader->load(__DIR__ . '/../sites/demo/site.xml');
        
        $renderer = new Renderer();
        $html = $renderer->renderSitePage($theme, $site, 'home', 'en');
        echo $html;
    }
}
