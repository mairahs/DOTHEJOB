<?php require_once 'menu_admin.php' ?>
<table class="table table-bordered table-striped">
    <tr>
        <th>Nom de l'offre</th>
        <th>Actions</th>
    </tr>

        <?php foreach($jobs as $job) : ?>
    <tr>
        <td><?= $job->nom ?></td>
        <td>
            <a class="btn btn-warning btn-xs" href="?routing=admin/admin/manageJob&id_job=<?= $job->id ?>">Editer</a>


            <a class="btn btn-danger btn-xs" href="?routing=admin/admin/deleteJob&id_job=<?= $job->id ?>">Supprimer</a>
        </td>
    </tr>
        <?php endforeach ?>


</table>