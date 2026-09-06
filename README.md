# Amélioration de la sélection des blocs de scénario Jeedom

Ce projet apporte plusieurs améliorations ergonomiques à la modale de sélection des blocs dans l'édition des scénarios Jeedom.

## Améliorations apportées

### 1. Raccourci d'ouverture de la modale
Il est désormais possible d'ouvrir la modale d'ajout de bloc instantanément avec le raccourci clavier **Ctrl + Alt + A** (ou **Cmd + Opt + A** sur macOS).

### 2. Raccourcis Clavier Numériques
Chaque type de bloc dispose d'un raccourci clavier direct (de **1** à **8**). Lorsqu'une modale d'ajout de bloc est ouverte, il suffit de presser le chiffre correspondant pour insérer immédiatement le bloc souhaité.

*   **1** : Si/Alors/Sinon
*   **2** : Action
*   **3** : Boucle (For)
*   **4** : Tant que (While)
*   **5** : Dans (In)
*   **6** : A (At)
*   **7** : Code
*   **8** : Commentaire

### 3. Interface Simplifiée
Le filtre de recherche textuelle, présent auparavant, a été supprimé. La sélection se limitant à 8 types de blocs, ce filtre alourdissait l'interface sans apporter de gain réel face à la rapidité des nouveaux raccourcis numériques.

### 4. Navigation au Clavier Optimisée
*   **Flèches directionnelles** : Navigation fluide entre les cartes de blocs.
*   **Entrée** : Validation du bloc sélectionné.
*   **Echap** : Fermeture de la modale.

## Installation
Remplacez les fichiers `scenario.php`, `scenario.js` et `scenario.css` dans le répertoire `desktop` de votre installation Jeedom par ceux fournis dans ce dépôt.
