*** Bienvenu sur le restaurant numérique ***


** Mise en situation :

Les restaurants étaient fermés depuis des mois à cause de la situation sanitaire actuelle.
Même s'ils réouvrent à peine, ils vont devoir se plier à des règles sanitaires plus strictes.
Ici est proposé une alternative à une carte numérique jusqu'au paiement.
Actuellement nous possédons tous un smartphone, qui nous donne accès à de plus en plus de choses, et qui nous facilite la vie.
Essayons de faciliter la vie des restaurateurs.
Peut-être qu'en passant au numérique, ils auraient pu ré-ouvrir avant !

Un QRCode est disponible dans le restaurant (ici il n'est pas proposé).
En le scannant, on a accès à l'accueil du site.
Après une connexion rapide, on peut commander et règler directement.
Aucun contact n'a été fait, mis à part avec votre propre téléphone.
Le serveur peut s'occuper pleinement de vous car il a ni à gérer la commande, ni à gérer le paiement.
Le restaurateur peut gérer sa carte comme il le souhaite avant le service.


** Fonctionnalités :

L'administrateur du restaurant se connecte.
Il a accès à sa partie admin qui lui permet de gérer son menu et la partie client où il peut passer commande comme un client lambda.
La partie admin lui permet de :
- modifier l'ordre des catégories du menu grâce à un drag and drop, 
- modifier le nom de la catégorie,
- définir si la catégorie est à la carte ou pas,
- créer un produit avec une photo obligatoire,
- supprimer un produit,
- modifier la catégorie du produit, le nom du produit, la photo du produit, la description du produit, ... .
Les catégories du menu sont limitées à 6 maximum, et ne peuvent pas être supprimées par l'administrateur.

Le client scanne un QRCode avec son propre téléphone et accède directement à la page d'accueil.
S'il n'est pas déjà inscrit, il lui suffit de se rendre sur la page Inscription, de rentrer un mail et un mot de passe, puis l'accès au menu se fait directement.
S'il est déjà inscrit, il lui suffit de se rendre sur la page Connexion avec son mail et son mot de passe.
Il peut :
- voir chaque catégorie,
- accéder à chaque fiche produit,
- ajouter des produits au panier.
Une fois sa commande terminée, il peut accéder au panier et peut :
- augmenter les quantités sur son panier,
- les diminuer jusqu'à les supprimer,
- revenir sur le menu s'il le souhaite,
- supprimer le panier entièrement,
- valider sa commande.
Le paiement se fait directement, il n'est pas géré ici.
Il peut de nouveau recommencer l'opération!


** Langages utilisés :

- HTML,
- CSS,
- Javascript,
- PHP,
- MySQL.
 

** Explications :

J'ai appliqué le modèle MVC en procédural, en mobile first, pour ce projet.
index.php est mon routeur, il sécurise l'accès au site, que l'on soit logué, administrateur ou client.
bdconnect.php est mon lien avec la base de données de la 3WA.
CSS s'occupe de rendre le site responsive avec plusieurs Media Queries.
Le Javascript permet quelques animations tel que le menu rideau, le menu burger, les titres et les encarts.
Il rend les formulaires plus dynamiques et sécurisés.
Il gère le drag and drop et envoie avec une requête Fetch des données en base de données.
PHP gère réellement la sécurité des formulaires, fait toutes les requêtes vers la base de données, s'occupe des redirections ... s'occupe de tout le site!
MySQL héberge les tables. Elles sont prévues pour que le projet évolue.
2 utilisateurs ont été créé dans la table users
- email : leburger@gmail.com / mot de passe : 00000000 / est administrateur (table users -> admin = 1),
- email : leburger@gmail.org / mot de passe : 00000000 / est utilisateur lambda (table users -> admin = 0).
Le changement d'un utilisateur en administrateur se fait par la base de données.
En s'enregistrant, on est un utilisateur.