<ul class="nav nav-tabs">
<?php //var_dump($categories) ?>
    <?php foreach($categories as $key =>$categorie) :?>
    <li><a href="?routing=job/main/category&id_category=<?= $categorie->id ?>"><?= $categorie->nom ?></a></li>
    <?php endforeach ?>
</ul>

<?php /*
Pour lundi
> créer la page voir l'offre d'emploi
> 1 -> création du lien html vers cette page dans la sous-vue index.php (La vue qui liste les offres)
a href="index.php?routing=job/main/show&id=55"
> 2 -> Création d'un controller dédié > donc une méthode show() dans MainController
> 3 -> Création d'une sous-vue dédiée JobBundle>Views>show.php
> 4 -> Dans Kernel/Manager/Manager
création de la méthode FindOneBy($key, $val)
> 5 -> Dans le sous controller show > on appelle la requête, on stocke le résultat dans une variable $job et on la passe à la vue show.php qui se charge d'afficher
> 6 -> Attention, au stade où nous en sommes, nous utilisons uniquement fetchAll dans resultSet() de DB qui nous renvoi une collection même si on a qu'un seul résultat.
*/?>