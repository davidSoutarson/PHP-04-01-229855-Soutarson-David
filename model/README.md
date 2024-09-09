# Contenue et utilités du docier model

Le model gener les requetes, recupére mes donneé et la logique métier  
(' Requetes,traitement ...)

## MODEL

- Création, Lecture, Mise à jour, Suppression (CRUD)
- Logique métier
- Recuperation des Données
- Validation, Convertion,Traitement...

## Fichier generData

### Générateur de Données de Répartition de Sportifs

Ce Fichier a pour objectif de générer des données de répartition aléatoire pour des sportifs dans différentes écoles et disciplines sportives. Le script permet de générer le nombre d'élèves et de sportifs, puis de répartir ces sportifs en fonction du nombre de sports qu'ils pratiquent, avec des choix allant de 1 à 3 sports. Ensuite, une répartition aléatoire des sportifs est attribuée aux disciplines sportives.

### Fonctionnalités

1. **Génération du nombre d'élèves par école** : Le programme génère un nombre aléatoire d'élèves pour chaque école.
2. **Génération du nombre de sportifs** : Parmi les élèves générés, un certain nombre sont des sportifs. Ce nombre est également généré aléatoirement.
3. **Répartition des sportifs selon le nombre de sports pratiqués** :
   - **1 sport** : Génère le nombre de sportifs pratiquant un seul sport.
   - **2 sports** : Génère le nombre de sportifs pratiquant deux sports.
   - **3 sports** : Génère le nombre de sportifs pratiquant trois sports.
4. **Répartition aléatoire dans les disciplines sportives** : Les sportifs sont répartis dans les disciplines suivantes : boxe, judo, football, natation, cyclisme.
5. **Répartition équivalente** : Les sportifs sont multipliés par un facteur selon le nombre de sports pratiqués (1, 2 ou 3).

## Utilisation

### 1. Instanciation de la classe `GenerData`

Pour utiliser le générateur, instanciez la classe `GenerData` avec les paramètres requis :

```php
$pdo = new PDO('mysql:host=localhost;dbname=test', 'username', 'password'); // Exemple de connexion à la base de données
$generateur = new GenerData($pdo);
```

### Pré-requis

- PHP 7.x ou supérieur
- Une connexion à une base de données (facultatif selon l'usage)

### Exemple d'exécution

Voici un exemple d'utilisation :

```php
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', ''); // Connexion à la base de données
$generateur = new GenerData($pdo);

$generateur->genererNomEcoles();
$generateur->genererNombreEleves();
$generateur->genererNombreDeSportif();
$generateur->genererSportifPratiquan1S();
$generateur->genererSportifPratiquan2S();
$generateur->genererSportifPratiquan3S();

$generateur->repartitionAleatoireChoix1();
$generateur->repartitionAleatoireChoix2();
$generateur->repartitionAleatoireChoix3();

```
