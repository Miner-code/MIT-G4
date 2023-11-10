# UNEA

## Guide d'Installation en Local

Ce guide explique comment lancer le projet localement en utilisant WampServer.

### Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine:

- [WampServer](https://www.wampserver.com/)

### Étapes d'Installation

1. **Cloner le Projet**

 Ouvrez votre terminal et exécutez la commande suivante pour cloner le projet directement dans le répertoire www de wampserveur, par defaut: `C:\wamp64\www\` :

   ```bash
   git clone https://github.com/Miner-code/MIT-G4.git C:\wamp64\www\UNEA

### Configuration de la Base de Données

1. Ouvrez PhpMyAdmin dans votre navigateur en accédant à [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Créez une nouvelle base de données avec le nom `unea`.
3. Importez le fichier SQL unea.sql fourni avec le projet dans votre nouvelle base de données.

### Lancement du Projet

Ouvrez votre navigateur et accédez à [http://localhost/MIT-G4](http://localhost/MIT-G4).