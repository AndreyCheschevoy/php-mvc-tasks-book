<?php include APP_ROOT . '/views/templates/header.php' ?>
<a href="<?php echo URL_ROOT; ?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Изминение задачи Админом</h2>
    <form action="<?php echo URL_ROOT; ?>/indexcontroller/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="text">Задача: <sup>*</sup></label>
            <textarea name="text" required
                      class="form-control form-control-lg <?php echo (!empty($data['text_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['text']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['text_err']; ?></span>
        </div>
        <div class="d-flex align-items-center col-md-12 form-group">
            <?php if (isLoggedInAsAdmin()): ?>
                <div class=" d-flex col-md-6">
                    <label class="mr-5" for="status">Статус</label>
                    <select name="status" class="form-control" id="status">
                        <?php if($data['status'] == 1): ?>
                            <option value="0">Не выполнено</option>
                            <option value="1" selected>Выполнено</option>
                        <?php else : ?>
                            <option value="0" selected>Не выполнено</option>
                            <option value="1">Выполнено</option>
                        <?php endif?>
                    </select>
                </div>
            <?php endif ?>
            <div class="col-md-6">
                <input type="submit" class="btn btn-success" value="Submit">
                <a href="<?php echo URL_ROOT; ?>" class="btn btn-primary"><i class="fa fa-backward"></i> Back</a>
            </div>
        </div>
    </form>
</div>

<?php include APP_ROOT . '/views/templates/footer.php' ?>
