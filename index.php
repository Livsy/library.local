<?php
session_start();

$config = parse_ini_file(__DIR__.DIRECTORY_SEPARATOR.'.env', true);

require_once $config['system']['path'].'Loader.php';

$thisFileIsRouting = new Home($config, new DataStorage($config['DataStorage']), new FileStorage($config['FileStorage']));

class Home
{
    private $params = '';

    private $dataStorage = null;

    private $fileStorage = null;

    function __construct(array $config, DataStorage $dataStorage, FileStorage $fileStorage)
    {
        $this->params = $config;
        $this->dataStorage = $dataStorage;
        $this->fileStorage = $fileStorage;



        /**
         * Проверка данных формы
         */
        $filePath = $this->isFiles();

        $this->isPost($filePath);


        /**
         * Сохраняем состояние формы, если мы зарегистрировали ошибку
         */
        if(isset($_SESSION['message']) && count($_SESSION['message']) > 0)
        {
            if (isset($_POST) && count($_POST) > 0)
            {
                $_SESSION['post'] = $_POST;
            }
        }

        /**
         * Перегружаем страницу если есть ошибка
         */
        if (isset($_SESSION['message']) && count($_SESSION['message']) > 0
            && isset($_POST) && count($_POST) > 0) {
            header('Location: /');
            exit;
        }

        /**
         * Отображаем страницу
         */
        $this->drawPage();

        /**
         * Удаляем не нужные переменные
         */
        unset($_SESSION['message']);
        unset($_SESSION['post']);
    }


    function isPost($filePath)
    {
        if (!isset($_POST) || count($_POST) == 0) {
            return false;
        }

        $dataSimple = $this->dataStorage->validate($_POST);

        if (count($dataSimple['message']) > 0) {
            if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
                $_SESSION['message'] = array_merge($_SESSION['message'], $dataSimple['message']);
            } else {
                $_SESSION['message'] = $dataSimple['message'];
            }
        } else {
            $dataSimple['data']['file'] = $filePath;

            $this->dataStorage->save($dataSimple['data']);
        }

        return true;
    }


    function isFiles()
    {
        /**
         * Проверка файла
         */
        if (!isset($_FILES)
            || count($_FILES) == 0
            || strlen($_FILES['file']['name']) == 0) {
            return '';
        }

        $dataFile = $this->fileStorage->validate($_FILES);

        if (count($dataFile['message']) > 0)
        {
            if(isset($_SESSION['message']) && is_array($_SESSION['message']))
            {
                $_SESSION['message'] = array_merge($_SESSION['message'], $dataFile['message']);
            }
            else
            {
                $_SESSION['message'] = $dataFile['message'];
            }
        }
        else
        {
            return $this->fileStorage->save($_FILES);
        }
    }


    function drawPage()
    {
        $title = "Add Data";
        $template = 'form';
        $pathView = $this->params['path']['views'];
        require_once $this->params['path']['views'] . 'index.php';
    }
}