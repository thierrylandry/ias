##**Nouveautés v1.1a**
- Possibilité de créer des sous comptes de trésorerie et d'affecter la gestion à des utilisateurs en dehors du groupe `admin`.
- Création de groupe d'utilisateur basé sur les services.
- Filtre du menu en fonction de l'utilisateur connecté.
- Ajout des autorisations de page et d'actions.
- Prise en compte des emails de rappel de mission 5 jours (paramètrable) avant.

##**Process Change**

- Supprimer la table ligne brouillard 
- Créer la table `compte`
- Ajouter les services `Gestionnaire VL`, `Gestionnaire PL`, `Magasinier` dans la table "service"
- Ajout du `chauffeur par défaut` dans les véhicules.
- Ajout des catégories `PL` & `VL` dans le genre des véhicules. Création d'un attribut `categorie` dans la table `genre`.