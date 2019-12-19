<?php include APP_ROOT . '/views/templates/header.php' ?>
<!-- Begin page content -->
<div class="text-center">
    <form class="form-signin mt-5" action="<?php echo URL_ROOT; ?>/userscontroller/signin" method="post">



        <h1 class="h3 mt-5 mb-3 font-weight-normal">Please sign in</h1>
        <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="name" name="name" required
                   class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" required
                   class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $data['password']; ?>">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>
<!--<div>--><?php //var_dump($data['posts']) ?><!--</div>-->
<?php include APP_ROOT . '/views/templates/footer.php' ?>
