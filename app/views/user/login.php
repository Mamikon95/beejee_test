<div class="card">
    <div class="card-header">
        Войти в аккаунт
    </div>
    <div class="card-body">
        <form action="/user/login" method="post">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Введите имя пользователя" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>