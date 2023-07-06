# TP API REST

## Création de la table

1. name est de type varchar limité à 255 caractères.<br>
Il s'agit du nombre de caractères max toléré par la BDD.<br>
Cela permet une certaine amplitude pour le nom d'une personne, sans trop affecter l'espace de stockage.<br>

2. Il manque le fait que l'email doit être unique, car une adresse email désigne un seul compte, lité à une entité.<br>

## Configuration 

### Qu'est-ce qu'une class ?

Une classe est une définition contient le nom des propriétés qu'on pourra manipuler avec des méthodes.<br>
C'est une sorte de mode d'emploi d'un objet avec toutes les explications de son mode de fonctionnement.<br>
Les propriétés sont des variables internes de cette définition.<br>
Les méthodes sont des fonctions internes à la classe.<br>
La classe détermine ce qu'il sera possible de faire avec l'objet.<br>

par exemple :<br>
si on a une classe appelée `Voiture`:<br> 
  * la classe est le mode d'emploi<br> 
  * elle possède des caractéristiques = les propriétés.<br>
les caractéristiques peuvent être : la couleur, le nombre de portes, le type de moteur, la vitesse max...
  * et des fonctionnalités = les méthodes.<br>
les fonctionnalités peuvent être : rouler, freiner, klaxonner...

L'instance de classe est un objet de la classe.<br>
Dans l'exemple, nous pouvons avoir un objet de la classe Voiture, qui est de couleur rouge, avec 5 portes, moteur diesel.<br>
On peut avoir autant d'objet de la classe Voiture mais une seule classe Voiture pouvant être utilisée autant de fois qu'on veut créer un objet.<br>

### Quel est l'intérêt de déclarer la connexion PDO dans une classe et pas dans un fichier "généralé" type index.php ?

C'est l'idée de décomposer le code pour simplifier la maintenance.<br>
On pourra également appeler autant de fois la classe `PhpPdo` dont on a besoin. 