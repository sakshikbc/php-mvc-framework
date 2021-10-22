<?php
/**
 * @var $this \MVC\Core\View
 * @var $model \MVC\App\Models\ContactForm
 */
use MVC\Core\Form\Form;
use MVC\Core\Form\TextAreaField;

$this->title = 'Contact';
?>
<h1>Contact</h1>

<?php
$form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextAreaField($model, 'body'); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>