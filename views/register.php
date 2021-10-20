<h1>Create An Account</h1>
<?php
use MVC\Core\Form\Form;
$form = Form::begin("", "POST") ?>
<?php
    echo '<div class="row">';
        echo '<div class="col">';
            echo $form->field($model, 'firstname');    
        echo '</div>';
        echo '<div class="col">'; 
            echo $form->field($model, 'lastname');    
        echo '</div>';
    echo '</div>';
       
    echo $form->field($model, 'email');    
    echo $form->field($model, 'password')->passwordField();    
    echo $form->field($model, 'confirmPassword')->passwordField();    
?>
<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end(); ?>
<!-- <form action="" method="POST">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>FirstName</label>
                <input type="text" class="form-control <?php echo $model->hasError('firstname') ? 'is-invalid' : '' ?>" 
                value="<?php echo $model->firstname ?>" name="firstname">
                <div class="invalid-feedback">
                    <?php
                        echo $model->getFirstError('firstname');
                    ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>LastName</label>
                <input type="text" class="form-control" name="lastname">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form> -->