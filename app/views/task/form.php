<div class="card">
    <div class="card-header">
        <?=$taskModel->id ? 'Изменить' : 'Добавить'?> задачу
    </div>
    <div class="card-body">
        <form action="/task/<?=$taskModel->id ? 'edit?id=' . $taskModel->id : 'add'?>" method="post">
            <?php if($taskModel->id):?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="done" name="done" <?=$taskModel->done ? 'checked' : ''?>>
                    <label class="form-check-label" for="done">Выполнено</label>
                </div>
            <?php endif;?>
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Введите имя пользователя" value="<?=$taskModel->username;?>" <?=$taskModel->id ? 'disabled' : ''?>>
            </div>
            <div class="form-group">
                <label for="email">Почта</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Введите почту" value="<?=$taskModel->email;?>" <?=$taskModel->id ? 'disabled' : ''?>>
            </div>
            <div class="form-group">
                <label for="text">Текст задачи</label>
                <textarea name="text" id="text" class="form-control" cols="30" rows="5"><?=$taskModel->text;?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
</div>