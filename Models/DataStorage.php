<?php

class DataStorage
{
    private $param;

    function __construct(array $param)
    {
      $this->param = $param;
    }

    function save(array $data)
    {
        $f = fopen($this->param['path'], 'a+');
        fwrite($f, '"'.implode('";"', $data)."\"\r\n");
        fclose($f);
    }

    /**
     * Проверяем и приводим к общему виду данные POST
     */
    function validate(array &$data)
    {
        $message = [];
        $myField = ['title', 'author', 'description'];

        foreach ($myField as $item) {
            if(!isset($data[$item]) || strlen($data[$item]) == 0)
            {
                $message[$item] = 'Поле не должно быть пустым';
            }
            $fields[$item] = addslashes(str_replace(['\'', '"', ';'], '', trim(strip_tags($data[$item]))));
        }

        return ['message' => $message, 'data' => $fields];
    }


    function getCount()
    {
        $count = 0;
        $f = fopen( $this->param['path'], 'r');

        while( !feof($f)) {
            fgets( $f);
            $count++;
        }
        fclose($f);

        return $count;
    }

    function getDataByLimit($pageNum, $limit)
    {
        $numFirstString = ((int) $pageNum * (int) $limit) - (int) $limit + 1;

        $data = [];

        $flag = false;

        $f = fopen($this->param['path'], 'r');
        for($i = 0; ($str = fgets($f, filesize($this->param['path']))) !== false; $i++)
        {
            if($i+1 == $numFirstString)
            {
                $flag = true;
            }

            if($flag)
            {
                $data[] = $str;
                if(count($data) == $limit)
                {
                    break;
                }
            }
        }

        fclose($f);

        return $data;
    }
}
