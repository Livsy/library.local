<?php
session_start();

$config = parse_ini_file(__DIR__.DIRECTORY_SEPARATOR.'.env', true);

require_once $config['system']['path'].'Loader.php';

$thisFileIsRouting = new ListPage($config, new DataStorage($config['DataStorage']));


class ListPage
{
    function __construct(array $config, DataStorage $dataStorage)
    {
        $this->params = $config;

        $this->dataStorage = $dataStorage;


        /**
         * Считываем количество данных
         */
        $countString = $this->dataStorage->getCount();

        /**
         * Лимит данных на странице
         */
        $limit = $this->params['ListData']['limitData'];

        $pager = new Pager($countString, $limit);

        $data['pagination'] = $pager->getMatches();

        $data['content'] = $this->dataStorage->getDataByLimit($data['pagination']['currentPage'], $limit);


        $this->drawPage($data);
    }

    function drawPage($data)
    {
        $title = "List Data";
        $template = 'list';
        $templatePager = 'pagination.php';
        $pathView = $this->params['path']['views'];
        require_once $this->params['path']['views'] . 'index.php';
    }



}