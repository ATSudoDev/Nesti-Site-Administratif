# Nesti - Site Administratif

[Lien du projet](http://projets.teillieraxel.com/nesti-site-administratif/connection)

❗ Merci de respecter mon travail et de ne pas détruire la base de données ❗

## Index

- [Aperçu](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#aperçu)
- [Contexte](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#contexte)
- [Objectif](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#objectif-du-projet)
- [Éléments significatifs](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#éléments-significatifs)
- [Description fonctionnelle](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#description-fonctionnelle-des-besoins)
- [Outils et logiciels utilisés](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#outils-et-logiciels-utilisés)

## Aperçu

![Image Projet](https://teillieraxel.com/static/media/Nesti%20-%20site%20administratif.1a3125e3.png)

## Contexte

L'entreprise Nesti est une entreprise fictive ayant comme objectif de se digitaliser et ainsi développer un environnement d’e-commerce afin d’agrandir son marché. Pour ce faire, l’entreprise a fait appel à mes services afin d’obtenir un site administrateur permettant de gérer [son site vitrine e-commerce](https://projets.teillieraxel.com/nesti-site-e-commerce/public/).


## Objectif

L’objectif du projet était de développer une application web simple d’utilisation de type administration (CRUD) permettant de gérer le site vitrine aussi bien au niveau des recettes proposées que des articles mis en vente tout en passant par les profils utilisateurs des clients.


## Éléments significatifs

- Réalisée en *PHP from scratch* c'est-à-dire qu'aucun framework n'a été utilisé,
- Le projet partage la même base de données (*MySQL*) qu'un autre projet nommé [*Nesti - E-Commerce*](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce),
- Mise en place de modals de confirmation avant chaque modification ou suppression des différents éléments du site afin d’éviter des erreurs de saisie,
- Comporte un système de limitation d’accès suivant le rôle de l’utilisateur.


## Description fonctionnelle

- Comporte une connexion sécurisée afin d’accéder à l’application web,

- Comporte un système de limitation d’accès aux différentes pages en fonction du rôle de l’utilisateur qui est connecté c’est-à-dire :
  - Les administrateurs auront accès à toutes les pages,
  - Les modérateurs auront accès aux onglets de création et gestion des utilisateurs,
  - Les chefs pâtissiers auront aux onglets de création et gestion des recettes,
  
- Permet à un chef de créer une recette (nom, difficulté, nombre de personnes, temps de préparation, état, image, étapes de préparation, liste des ingrédients),

- Permet à un chef ou un administrateur de gérer et modifier des recettes,

- Permet à un administrateur d’importer un document csv avec la liste des articles disponible à la vente,

- Permet à un administrateur de gérer et modifier des articles,

- Permet à un administrateur d’obtenir l’ensemble des commandes effectuées sur le site client (payée ou en attente) et d’accéder aux détails des produits commandées,

- Permet à un administrateur ou un modérateur de créer un profil utilisateur (nom, prénom, email, nom d’utilisateur, mot de passe, adresse, ville, code postal, rôle),

- Permet à un administrateur ou un modérateur de gérer et modifier des utilisateurs,

- Permettre à un administrateur ou un modérateur d’accéder à des informations personnelles sur un client en particulier (date de création du profil, dernière connexion, commandes effectuées et leurs détails). D’autres informations s’affiche en fonction du rôle de l’utilisateur c’est-à-dire :
  - Si c’est un chef, l’accès au nombre de recettes crées et à la dernière recette créée,
  - Si c’est un administrateur, accès au nombre d’importations faites et date de la dernière importation,
  - Si c’est un modérateur, accès au nombre de commentaires bloqués et approuvés,

- Permet à un administrateur d’accéder à une page statistique regroupant des graphiques et classements sur les recettes, articles et utilisateurs et plus particulièrement :
  - Un graphique sur les heures de connexion des utilisateurs,
  - Un graphique regroupant l’argent dépensé pour les commandes passées et l’argent gagné pour les commandes reçues en fonction des dix derniers jours,
  - Un graphique regroupant les bénéfices et dépenses en fonction de chaque article mis en vente,
  - Plusieurs listes type Top 10 des meilleures commandes, utilisateurs, chefs et recettes.

## Outils et logiciels utilisés

- IDE : [*Visual Studio Code*](https://code.visualstudio.com/)
- Librairies : 
  - [*Bootstrap*](https://getbootstrap.com/)
  - [*Bootstrap Table*](https://bootstrap-table.com/)
  - [*Toast UI*](https://ui.toast.com)
- Logiciel : [*FileZilla*](https://filezilla-project.org/)
- Base de données : [*PHPMyAdmin*](https://www.phpmyadmin.net/)

