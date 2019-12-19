<?php include APP_ROOT . '/views/templates/header.php' ?>
<div class="card card-body bg-light mt-5">
    <h2>Создание Задачи</h2>
    <form action="<?php echo URL_ROOT; ?>/indexcontroller/create" method="post">
        <div class="form-group">
            <label for="name">Имя: <sup>*</sup></label>
            <input type="text" name="name" required
                   class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" required
                   class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>
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
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
            <?php endif; ?>
            <div class="col-md-6">
                <input type="submit" class="btn btn-success" value="Submit">
                <a href="<?php echo URL_ROOT; ?>" class="btn btn-primary"><i class="fa fa-backward"></i> Back</a>
            </div>
        </div>
    </form>
</div>
<?php include APP_ROOT . '/views/templates/footer.php' ?>
