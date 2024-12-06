## Installation du projet Laravel

Pour installer le projet Laravel, suivez ces étapes :

1. **Clonez le dépôt depuis GitHub :**
    ```bash
    git clone https://github.com/parizetm/socisso
    ```

2. **Naviguez vers le répertoire du projet :**
    ```bash
    cd socisso 
    #chemin du projet
    ```

3. **Installez les dépendances :**
    ```bash
    composer install
    ```

4. **Copiez le fichier `.env.example` en `.env` et configurez vos variables d'environnement :**
    ```bash
    cp .env.example .env
    ```

5. **Générez la clé de l'application :**
    ```bash
    php artisan key:generate
    ```

6. **Configurez votre base de données et mettez à jour le fichier `.env` avec vos identifiants de base de données.**

7. **Lancez les migrations de la base de données :**
    ```bash
    php artisan migrate
    ```

8. **Configurez la base de données :**
    ```bash
    php artisan db:seed
    ```

Socisso devrait maintenant être opérationnel.


### Projet réalisé par:
Félis Maillard
Martin Parizet
Léo Gerard
