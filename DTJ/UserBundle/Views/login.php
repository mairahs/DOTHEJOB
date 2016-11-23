<h1>Merci de vous identifier</h1>
<?= $flash ?>
<form action="" method="POST">
    <?= $form->displayInput('Votre username','username') ?>
    <?= $form->displayInput('Votre mot de passe','password','password') ?>
    <?= $form->displaySubmit() ?>
</form>

