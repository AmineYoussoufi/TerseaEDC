# **MINI CRM**

## *Comment configurer*

La Configuration du mini crm est très simple .

La première chose à faire est d'accéder à votre fichier .ENV et de modifier les parties suivantes :
on commence par le bas de la page , et on modifie les informations de l'email fournis par le fournisseur smtp en commençant par le type du mailer , url du fournisseur,port , email , mot de passe , type d'encryption ,  l'adresse de mailing qui sera affichée chez le recepteur du mail

 `MAIL_MAILER=smtp`
 `MAIL_HOST=`
 `MAIL_PORT=465`
 `MAIL_USERNAME=`
 `MAIL_PASSWORD=`
 `MAIL_ENCRYPTION=ssl`
 `MAIL_FROM_ADDRESS=`

Puis on accède au serveur SQL et on crée une nouvelle base de donnée et on change les informations du host , port , database, nom d'utilisateur et mot de passe

`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=MiniCRM`
`DB_USERNAME=root`
`DB_PASSWORD=`

Puis on change l'url de l'application

`APP_URL=`

## Commandes à executer en ordre respectif

- Créer les tables de la base de donnée
`php artisan migrate`
- Générer une clé unique de l'application
`php artisan key:generate`
- Créer le premier utilisateur
`php artisan db:seed`
- Installer les packages nodejs
`npm install` ou `yarn install`
- Générer les pages VueJS
`npm run build` ou `yarn build`

## Heberger l'application en production

 mettez la racine de votre application sur le dossier `/public`
