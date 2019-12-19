<?php include APP_ROOT . '/views/templates/header.php' ?>
<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="mb-5 d-flex align-items-baseline container">
        <div class="col-md-6"><h1 class="mt-5">Задачи</h1></div>
        <div class="col-md-6">
            <a href="<?php echo URL_ROOT; ?>/indexcontroller/create" class="btn btn-primary">Создать задачу</a>
        </div>
    </div>
    <div><?php flash('task_message'); ?></div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="<?= URL_ROOT; ?>/indexcontroller/paginate/<?= $data['page'] ?>&sortBy=username&sortType=<?= $data['sortType'] ?>">Имя</a></th>
            <th scope="col"><a href="<?= URL_ROOT; ?>/indexcontroller/paginate/<?= $data['page'] ?>&sortBy=email&sortType=<?= $data['sortType'] ?>">Email</a></th>
            <th scope="col">Текст</th>
            <th scope="col"><a href="<?= URL_ROOT; ?>/indexcontroller/paginate/<?= $data['page'] ?>&sortBy=status&sortType=<?= $data['sortType'] ?>">Статус</a></th>
            <?php if (isLoggedInAsAdmin()): ?>
                <th scope="col">Action</th>
            <?php endif ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['tasks'] as $task) : ?>
            <tr>
                <td><?= $task->username ?></td>
                <td><?= $task->email ?></td>
                <td><?= $task->text ?></td>
                <td>
                    <span><?= $task->changed == 1 ? 'отредактировано администратором, ' : 'не редактировалось, ' ?></span>
                    <span><?= $task->status == 1 ? 'выполнено' : 'не выполнено' ?></span>
                </td>
                <?php if (isLoggedInAsAdmin()): ?>
                    <td class="d-flex flex-wrap justify-content-around">
                        <a class="btn btn-primary" href="<?= URL_ROOT; ?>/indexcontroller/edit/<?= $task->id ?>">Edit</a>
                        <form class="pull-right" action="<?= URL_ROOT; ?>/indexcontroller/delete/<?= $task->id ?>"
                              method="POST">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
    <?php if ($data['total_pages'] > 1) : ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center">
                <li class="page-item"><a class="page-link" href="<?= URL_ROOT; ?>/indexcontroller/paginate/1&sortBy=<?= $data['sortBy'] ?>&sortType=<?= $data['sortType'] == "ASC" ? 'DESC' : 'ASC' ?>">В начало</a>
                </li>
                <?php for ($i = 1; $i <= $data['total_pages']; $i++) : ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= URL_ROOT; ?>/indexcontroller/paginate/<?= $i; ?>&sortBy=<?= $data['sortBy'] ?>&sortType=<?= $data['sortType'] == "ASC" ? 'DESC' : 'ASC' ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link"
                                         href="<?= URL_ROOT; ?>/indexcontroller/paginate/<?= $data['total_pages'] ?>&sortBy=<?= $data['sortBy'] ?>&sortType=<?= $data['sortType'] == "ASC" ? 'DESC' : 'ASC' ?>">В
                        конец</a></li>
            </ul>
        </nav>
    <?php endif ?>

</main>
<!--<div>--><?php //var_dump($data['posts']) ?><!--</div>-->
<?php include APP_ROOT . '/views/templates/footer.php' ?>