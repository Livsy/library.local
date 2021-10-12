<?php


class FileStorage
{
    function __construct(array $param)
    {
        $this->param = $param;
    }


    function save(array &$data)
    {
        $time = microtime(microtime(true));
        $rand = rand(1000, 9999);
        $pathFile = $this->param['path'].$time.'_'.$rand.'_'.$data['file']['name'];

        copy($data['file']['tmp_name'], $pathFile);

        $addr = 'http://'.$_SERVER['SERVER_NAME'].'/UserFiles/'.$time.'_'.$rand.'_'.$data['file']['name'];

        return $addr;
    }

    /**
     * Проверяем данные FILES
     */
    function validate(array &$file)
    {
        $trueExtantion = explode(',', $this->param['true_extantion']);

        $fileExtantion = strtolower(pathinfo($file['file']['name'], PATHINFO_EXTENSION));

        $isTrueExt = false;

        foreach($trueExtantion as $item)
        {
            if($item == $fileExtantion)
            {
                $isTrueExt = true;
            }
        }

        $message = !$isTrueExt ? ['file' => 'Не правильный тип файла'] : [];

        return ['message' => $message, 'data' => $file];

    }


}