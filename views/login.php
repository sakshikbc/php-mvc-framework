<?php
/**
 * @var $model \MVC\App\Models\LoginForm
 */
?>
<h1>Login</h1>
<?php
use MVC\Core\Form\Form;
$form = Form::begin("", "POST") ?>

<?php
    echo $form->field($model, 'email');    
    echo $form->field($model, 'password')->passwordField();    
?>
<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end(); ?>