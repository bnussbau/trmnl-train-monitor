<?php

namespace App\Utils;

use Crwlr\Crawler\Cache\FileCache;
use Crwlr\Crawler\HttpCrawler;
use Crwlr\Crawler\Loader\LoaderInterface;
use Crwlr\Crawler\UserAgents\BotUserAgent;
use Crwlr\Crawler\UserAgents\UserAgentInterface;
use DateInterval;
use Psr\Log\LoggerInterface;

class OebbCrawler extends HttpCrawler
{
    protected function userAgent(): UserAgentInterface
    {
        return BotUserAgent::make('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36');
    }

    protected function loader(UserAgentInterface $userAgent, LoggerInterface $logger): LoaderInterface
    {
        $loader = parent::loader($userAgent, $logger);
        $loader->robotsTxt()->ignoreWildcardRules();
        $cache = new FileCache(storage_path('framework/cache') . '/crwlr');
        $cache->ttl(new DateInterval('P20M'));
        $loader->setCache($cache);
        return $loader;
    }


}
