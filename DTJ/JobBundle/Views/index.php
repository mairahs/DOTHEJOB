<?php
require_once 'menu_categories.php';
//var_dump($jobs);
?>
<h2>Les dernières offres</h2>
<?php foreach($tab_objet_jobs_competences as $job) :?>
    <div class="job">
        <div><span class="jobTitle"><?= $job['job']->jobNom ?></span></div>
        <div><span class="recrut-comp"><?= $job['job']->socNom ?></span></div>
        <div><span class="contrat pull-right"><?= $job['job']->contratNom ?></span></div>
        <p><?= $job['job']->offre_short ?></p>

        <?php foreach ($job['competences'] as $competence)  : ?>

               <a href="?routing=job/main/competence&id_competence=<?= $competence->id?>"><span class="label label-primary"><?= $competence->nom ?></span></a>

        <?php endforeach ?>

        <a class="btn btn-success btn-xs pull-right" href="?routing=job/main/show&id=<?=$job['job']->id ?>">Voir l'offre</a>
    </div>

<?php endforeach ?>
