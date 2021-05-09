
<div class="row">
    <div class="col-lg-5">
        <form action="/todo/add" method="post">
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user-email" name="user-email" aria-describedby="email" required placeholder="your@email.com">
                <div id="user-email" class="form-text">We'll never share your email with anyone else (I swear)</div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Имя Пользователя</label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="username">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Текст задачи</label>
                <input type="text" class="form-control" id="description" name="description" required placeholder="description">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <?php
            /** @var bool $isAdmin */
            if (!$isAdmin) { ?>
            <a href="/admin/signin">
                <button type="button" class="btn btn-info">Sign in</button>
            </a>
            <?php   }?>
        </form>
    </div>
</div>

<div class="row">
    <?php
    /** @var array $todoList */
    foreach ($todoList as $todoItem) {?>
    <div class="col">
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title"><?= $todoItem['username']?></h5>
                <p class="card-text"><?= $todoItem['description']?></p>

                <?php if ($isAdmin) { ?>
                <a href="/todo/edit/<?= $todoItem['id']?>" class="btn btn-primary">Go somewhere</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php }?>
</div>