<form action="/admin/authorize" method="post">
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input class="form-control" type="text" name="login" id="login" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input class="form-control" type="text" name="password" id="password" required>
    </div>
    <input class="btn btn-primary" type="submit" value="Авторизоваться">
</form>

<?php
if (!empty($pleaseTryAgain)) { ?>
    <div>
        Вы ввели неправильные логин/пароль. Повторите еще раз
    </div>
<?php } ?>
