<?php require_once 'menu_categories.php'?>
<?php //var_dump($job)?>
<h1><?= $job->nom ?></h1>
<div class="date pull-right">Offre parue le
    <span class="label label-primary"><?=$job->created_at ?></span></div>

<p><?= $job->offre_short ?></p>
<p><?= $job->offre_long ?></p>