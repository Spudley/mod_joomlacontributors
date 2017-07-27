<?php
/**
 * @package  mod_joomlacontributors
 *
 * @copyright   Copyright (C) 2017 Simon Champion.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\Registry\Registry;

defined('_JEXEC') or die;

$processor = new joomlaContributorsProcessor($params);

require JModuleHelper::getLayoutPath('mod_joomlacontributors', 'default');

class joomlaContributorsProcessor
{
    const API_URL = "https://api.github.com/repos/joomla/joomla-cms/contributors?per_page=100&page={page}";

    private $params;
    private $contributors;

    public function __construct($params)
    {
        $this->params = $params;

        $cache = JFactory::getCache();
        $cache->call(array($this, 'loadContributors'));
    }

    public function loadContributors()
    {
        $pages = (int)$this->params['pages'] ?: 5;
        $contributors = [];
        for ($page=1; $page<=$pages; $page++) {
            $pageData = $this->getResponse(str_replace('{page}', $page, self::API_URL));
            //could just do $contributors = array_merge($contributors, $pageData) but manual loop so we can drop unnecessary elements
            foreach ($pageData as $contributor) {
                $contributors[] = array(
                    'id' => $contributor['id'],
                    'login' => $contributor['login'],
                    'avatar_url' => $contributor['avatar_url'],
                    'url' => $contributor['url'],
                    'html_url' => $contributor['html_url'],
                    'contributions' => $contributor['contributions']
                );
            }
        }
        $this->contributors = $contributors;
    }
    private function getResponse($url)
    {
		$version    = new JVersion;
		$httpOption = new Registry;
		$httpOption->set('userAgent', $version->getUserAgent('Joomla', true, false));

        $http = JHttpFactory::getHttp($httpOption);
        $response = $http->get($url);
        if ($response->code == 200 || $response->code == 100) {
            return json_decode($response->body, true);
        }
        return array();
    }

    public function getContributors()
    {
        switch ($this->params['sortType']) {
            case 'top' :        return $this->getTopContributors();
            case 'random' :     return $this->getRandomContributors();
            case 'weighted' :   return $this->getWeightedRandomContributors();
            default:            return $this->getWeightedRandomContributors();
        }
    }

    public function getTopContributors()
    {
        $toShow = (int)$this->params['avatarsToShow'] ?: 20;
        return array_slice($this->contributors, 0, $toShow);
    }

    public function getRandomContributors()
    {
        $toShow = (int)$this->params['avatarsToShow'] ?: 20;
        $contributors = $this->contributors;    //local copy as shuffle() means our array is not immutable.
        shuffle($contributors);
        return array_slice($contributors, 0, $toShow);
    }

    public function getWeightedRandomContributors()
    {
        $toShow = (int)$this->params['avatarsToShow'] ?: 20;
        $contributors = $this->contributors;    //local copy as usort() means our array is not immutable.
        usort($contributors, function($a, $b) {
            $mixer = 100; //increases the likelihood of lower contributors showing up, but still mainly favours higher contributors.
            return mt_rand(0, $a['contributions']+$b['contributions']+$mixer) > $a['contributions'] ? 1 : -1;
        });
        return array_slice($contributors, 0, $toShow);
    }

    public function getAvatarSize()
    {
        return (int)$this->params['avatarsSize'] ?: 50;
    }
}