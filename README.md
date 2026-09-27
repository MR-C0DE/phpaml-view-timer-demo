# PHPAML View Timer

Un minuteur réactif de 60 secondes construit entièrement avec PHPAML View.
Cette petite démonstration présente la gestion d’état, les effets périodiques,
les actions déclaratives, la progression native et les notifications Toast,
sans écrire de JavaScript dans la page.

## Fonctionnalités

- démarrage, pause et réinitialisation du minuteur ;
- décompte automatique avec `#[Effect]` ;
- état réactif avec `#[State]` et `StateRef` ;
- barre de progression native ;
- Toast lorsque le temps est écoulé ;
- interface responsive et accessible.

## Démarrer le projet

Installez [AML](https://phpaml.com/download), puis exécutez :

```bash
git clone https://github.com/MR-C0DE/phpaml-view-timer-demo.git
cd phpaml-view-timer-demo
aml serve
```

Ouvrez ensuite l’adresse locale affichée dans le terminal.

## Tester

```bash
aml test
```

## Fichiers principaux

- `src/views/pages/home/page.php` : état et comportement du minuteur ;
- `src/views/stylesheets/base.css` : présentation visuelle ;
- `tests/aml-view.php` : test de rendu de la page.

## Sécurité du déploiement

Utilisez uniquement `public/` comme racine web. Le fichier `.env` et le dossier
`runtime/` sont exclus du dépôt.

## Licence

Ce projet est distribué sous [licence MIT](LICENSE).
