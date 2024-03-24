# Instructions pour lancer l'application

Ces instructions vous guideront à travers les étapes nécessaires pour lancer cette application localement sur votre propre machine.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre ordinateur :

- [XAMPP](https://www.apachefriends.org/index.html) ou tout autre logiciel similaire pour exécuter un serveur web local.
- Un éditeur de texte ou un IDE (Integrated Development Environment) pour modifier le code source (par exemple, Visual Studio Code, Sublime Text, Atom, etc.).

## Instructions

1. Clonez ce dépôt sur votre machine locale en utilisant la commande suivante dans votre terminal :

    ```bash
    git clone https://github.com/votre-utilisateur/votre-repo.git
    ```

2. Assurez-vous que votre serveur web local (XAMPP, par exemple) est en cours d'exécution.

3. Placez le dossier de ce projet dans le répertoire racine de votre serveur local. Pour XAMPP, cela peut être le dossier `htdocs`.

4. Importez la base de données fournie (fichier ppe4.sql) dans votre serveur de base de données local (par exemple, via phpMyAdmin).

5. Ouvrez votre navigateur web et accédez à l'URL suivante :

    ```
    http://localhost/votre-dossier-projet
    ```

6. Si l'application ne fonctionne pas alors modifier le fichier config.php et mettez le chemin de votre dossier dans le BASE_URL

  ```
    <?php
    define("BASE_URL", "http://localhost/PPE4-2");
    define("LOGIN_PAGE", "/login.php");
    define("HOME_PAGE", "/home.php");
    ?>
  ```

7. Vous devriez maintenant voir l'application en cours d'exécution dans votre navigateur. Vous pouvez naviguer entre les différentes pages et utiliser les fonctionnalités de l'application comme prévu.
