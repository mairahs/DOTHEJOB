<?php require_once 'menu_admin.php'; ?>
<h1>Ajouter une offre d'emploi</h1>
<form action="" method="POST">
<?= $form->displayInput('Intitulé du poste','nom') ?>
<?= $form->displayTextarea('Description du poste (courte) ','offre_short',5) ?>
<?= $form->displayTextarea('Description du poste (longue) ','offre_long',15) ?>
<?= $form->displaySelect('Choisir une catégorie ','id_cat',$categories) ?>
<?= $form->displaySelect('Choisir un recruteur ','id_societe',$societes) ?>
<?= $form->displaySelect('Choisir un type de contrat ','id_contrat',$contrats) ?>
<?= $form->displayCheckbox('Choisir des compétences ','competences',$competences,$competences_actuelles) ?>
<?= $form->displaySubmit() ?>
</form>