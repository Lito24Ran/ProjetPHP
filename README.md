# Configuration de la base de données (phpMyAdmin)

Ce projet utilise une base de données MySQL pour stocker les commentaires des utilisateurs. Voici les instructions pour que toute l’équipe ait la **même base de données** dans phpMyAdmin. (Kôpy lisany zany hoe synchronisation ito)

---

## Pour information le nom de la base de données est :

```sql
commentaires_db

```

## 1. Pour bien faciliter sans utiliser trop de souris
Ouvrez phpMyAdmin ou votre outil MySQL,
ensuite, entrer sur SQL sur la barre latèrale horizontale en haut pour exécutez la requête suivante :

CREATE DATABASE commentaires_db;

## 2. Selectionner ce base de donnees dans la liste des bd sur la barre latèrale verticale gauche puis : 
exécutez la requête suivante :

CREATE TABLE commentaires (
  id INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  commentaire TEXT NOT NULL,
  PRIMARY KEY(id)
);

ALTER TABLE commentaire AUTO_INCREMENT = 1;

## 3. Les champs de la table devrait être comme ceci pour ce debut :

| Champ         | Type         | Description                          |
| ------------- | ------------ | ------------------------------------ |
| `id`          | INT          | Identifiant unique (auto-incrémenté) |
| `nom`         | VARCHAR(100) | Nom du visiteur                      |
| `commentaire` | TEXT         | Commentaire du visiteur              |



