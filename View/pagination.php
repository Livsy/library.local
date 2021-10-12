<? $p = $data['pagination']; ?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="<?=$p['url'].$p['prevPage']?>">Previous</a></li>
        <? for($i = 0; $i < $p['countVisibleOnPage']; $i++):?>
            <li class="page-item">
                <a class="page-link" href="<?=$p['url'].($p['firstPage'] + $i)?>">
                    <?=$p['firstPage'] + $i?>
                </a>
            </li>
        <? endfor; ?>
        <li class="page-item"><a class="page-link" href="<?=$p['url'].$p['nextPage']?>">Next</a></li>
    </ul>
</nav>