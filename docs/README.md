# Blog

## Install
```shell 
composer require osw3/symfony-blog
```

```php 
// config/bundle.php
return [
    OSW3\Blog\BlogBundle::class => ['all' => true],
];
```


## Workflow states

- draft (default) → Le post est en cours d'écriture.
- in_review (en relecture) → En attente de validation ou de corrections.
- approved (approuvé) → Validé mais pas encore publié.
- scheduled (planifié) → Prévu pour une publication automatique à une date définie.
- published (publié) → Visible publiquement.
- updated (mis à jour) → Publié et récemment modifié.
- archived (archivé) → Ancien contenu retiré de la publication mais conservé.
- deleted (supprimé) → Retiré du site mais récupérable.
- erased (effacé) → Supprimé définitivement sans possibilité de récupération.
- rejected (rejeté) → Non validé après relecture.
- flagged (signalé) → Contenu potentiellement problématique (modération requise).
- pending_changes (modifications en attente) → Nécessite des corrections avant approbation.


