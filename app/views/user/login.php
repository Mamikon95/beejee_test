<div class="card">
    <div class="card-header">
        Войти в аккаунт
    </div>
    <div class="card-body">
        <form action="/user/login" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Имя пользователя:</label>
                <input type="text" name="username" class="form-control" placeholder="Введите имя пользователя">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" name="password" class="form-control" placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>