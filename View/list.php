<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Description</th>
        <th scope="col">File</th>
    </tr>
    </thead>
    <tbody>
    <? foreach($data['content'] as $item): ?>
    <? //$str = explode(';', $item); ?>
    <? $res = str_getcsv($item, ';')?>
        <tr>
            <th scope="row"></th>
            <td><?=$res[0]?></td>
            <td><?=$res[1]?></td>
            <td><?=$res[2]?></td>
            <td>
                <? if(isset($res[3])): ?>
                    <a href="<?=$res[3]?>"><?=pathinfo($res[3], PATHINFO_BASENAME)?></a>
                <? endif; ?>
            </td>
        </tr>
    <? endforeach; ?>

    </tbody>
</table>

<? include $pathView.$templatePager?>