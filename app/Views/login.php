<html>
   <head>
    <title>
        Login
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head> 
   <body>
    <div class="container">
        <div class="row" style = "margin-top:45px;">
            <div class="col-lg-4 col-md-6 mx-auto">
                <h4>Login</h4><br>
                <form action="<?=base_url('/check')?>" method = "post"> 
                <?= csrf_field(); ?>
                <?php if (!empty(session()->getFlashdata('fail'))) :?>
                <div class="alert alert-danger"><?= session()->getFlashdata('fail')?></div>
                <?php endif;?>
                <?php if (!empty(session()->getFlashdata('success'))) :?>
                <div class="alert alert-success"><?= session()->getFlashdata('success')?></div>
                <?php endif;?>
                <div class="formgroup">
                    <label for="">Username</label>

                    <input type="text" class="form-control" name="username" placeholder="Enter your Username" value="<?= set_value('username') ?>">

                    <span class="text-danger"><?= isset($validation)? displayError($validation,'username'): ''  ?></span>
                    <br><br>
                </div>
                <div class="formgroup">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your Password" value="<?= set_value('password') ?>">
                    <span class="text-danger"><?= isset($validation)? displayError($validation,'password'): ''  ?></span>
                    <br>
                </div>
                <div class="formgroup">
                    <button class="btn btn-primary btn-block" type = "submit">Login</button><br>
                </div>
            </form>
        </div>
    </div>
    </div>
    
   </body>
</html>
