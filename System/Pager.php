<?php


class Pager
{
    private $count;

    private $limit;

    function __construct($count, $limit)
    {
        $this->count = $count;

        $this->limit = $limit;
    }

    function getMatches()
    {
        $p['countString'] = $this->count;

        $p['limit'] = $this->limit;


        /**
         * Количество страниц
         */
        $p['countPage'] = (int) ceil($p['countString'] / $p['limit']);

        /**
         * Текущая страница
         */
        $p['currentPage'] = isset($_GET['page']) && intval($_GET['page']) > 0 ? $_GET['page'] : 1;

        /**
         * Количество страниц в пейджере
         */
        $p['countVisibleOnPage'] = 3;

        /**
         * Странца, с которой начинается пейджер
         */
        if($p['currentPage'] + $p['countVisibleOnPage'] > $p['countPage'])
        {
            $p['firstPage'] = $p['countPage'] - $p['countVisibleOnPage'];

            if($p['firstPage'] < 1)
            {
                $p['firstPage'] = 1;
            }
            else
            {
                $p['firstPage'] += 1;
            }

        }
        else
        {
            $p['firstPage'] = $p['currentPage'];
        }

        if($p['firstPage'] == $p['currentPage'])
        {
            if($p['firstPage'] - 1 >= 1)
            {
                $p['firstPage'] -= 1;
            }
        }



        /**
         * Ссылка для пейджера
         */
        $p['url'] = '/list.php?page=';

        /**
         * Предыдущая ссылка
         */
        $p['prevPage'] = $p['currentPage'] - 1 < 1 ? 1 : $p['currentPage'] - 1;

        /**
         * Следующая ссылка
         */
        $p['nextPage'] = $p['currentPage'] + 1 > $p['countPage'] ? $p['countPage'] : $p['currentPage'] + 1;

        return $p;
    }
}