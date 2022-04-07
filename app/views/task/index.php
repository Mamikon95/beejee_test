<?php
/** @var \app\services\PaginationService $paginationService */

use app\models\TaskModel;
use app\services\UserAuthService;

?>

<div class="my-2 my-sm-1s">
    <a href="/task/add" class="btn btn-success">Добавить задачу</a>
</div>
<form action="/task/index" method="get" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Поиск" name="search" value="<?=$searchText?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
</form>
<hr>
<div class="row">
    <?php foreach($tasks as $task):?>
        <div class="col-sm-12 col-md-4 mb-3">
            <div class="card">
                <div class="card-header">
                    <?=$task['username']?>
                    <br>
                    <?=$task['email']?>
                    <br>
                    <?php if($task['done'] == TaskModel::IS_DONE):?>
                        <span class="badge badge-success">Завершено</span>
                    <?php endif;?>
                    <?php if($task['edited'] == TaskModel::IS_EDITED):?>
                        <span class="badge badge-primary">Изменено</span>
                    <?php endif;?>
                </div>
                <div class="card-body">
                    <?=$task['text']?>
                </div>
                <?php if(!UserAuthService::isGuest()):?>
                    <a href="/task/edit?id=<?=$task['id'];?>"class="btn btn-primary">Редактировать</a>
                <?php endif;?>
            </div>
        </div>
    <?php endforeach;?>
</div>

<?php if($paginationService->getMaxPage() > 1):?>
    <ul class="pagination justify-content-center">
        <li class="page-item <?=$paginationService->getCurrentPage() == 1 ? 'disabled' : ''?>">
            <a class="page-link" href="/task/index?page=<?=$paginationService->getPrevPage() . ($searchText ? '&search=' . $searchText : '');?>">Предыдущий</a>
        </li>
        <?php for($page = 1; $page <= $paginationService->getMaxPage(); $page++):?>
            <?php if($page == $paginationService->getCurrentPage()):?>
                <li class="page-item active">
                  <span class="page-link"><?=$page?></span>
                </li>
            <?php else:?>
                <li class="page-item"><a class="page-link" href="/task/index?page=<?=$page . ($searchText ? '&search=' . $searchText : '')?>"><?=$page?></a></li>
            <?php endif;?>
        <?php endfor;?>
        <li class="page-item <?=$paginationService->getCurrentPage() == $paginationService->getMaxPage() ? 'disabled' : ''?>">
            <a class="page-link" href="/task/index?page=<?=$paginationService->getNextPage() . ($searchText ? '&search=' . $searchText : '');?>">Следующий</a>
        </li>
    </ul>
<?php endif;?>