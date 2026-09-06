# Amélioration de la sélection des blocs de scénario Jeedom

Ce projet apporte plusieurs améliorations ergonomiques à la modale de sélection des blocs dans l'édition des scénarios Jeedom.

⚠️ **AVERTISSEMENT : Ce projet n'est pas un plugin officiel. Il modifie directement des fichiers du Core Jeedom.**

## Sécurité et Risques

*   **Modification du Core** : Ce projet remplace des fichiers système de Jeedom. Bien qu'un mécanisme de sauvegarde soit intégré, cela ne remplace pas une sauvegarde complète de votre système.
*   **Mises à jour Jeedom** : Une mise à jour de Jeedom pourra écraser ces modifications. Il sera peut-être nécessaire de réappliquer le patch après une mise à jour.
*   **Recommandations** : 
    *   Effectuez toujours une sauvegarde de Jeedom avant l'installation.
    *   Testez sur un environnement hors production si possible.

Ancienne modale de sélection de bloc de scénario

<img width="615" height="313" alt="image" src="https://github.com/user-attachments/assets/4dfbad2a-89ee-4e71-9489-c310a16ad422" />

## Nouvelle version proposée par ce patch

<img width="783" height="711" alt="image" src="https://github.com/user-attachments/assets/49cb9f3e-f2c8-4c10-a02b-640bf0d1aee5" />


## Améliorations apportées

### 1. Raccourci d'ouverture de la modale
Ouvrez la modale d'ajout de bloc instantanément avec **Ctrl + Alt + A** (ou **Cmd + Opt + A** sur macOS).

### 2. Raccourcis Clavier Numériques
Chaque type de bloc dispose d'un raccourci clavier direct (**1** à **8**). Pressez le chiffre correspondant pour insérer immédiatement le bloc.

*   **1** : Si/Alors/Sinon
*   **2** : Action
*   **3** : Boucle (For)
*   **4** : Tant que (While)
*   **5** : Dans (In)
*   **6** : A (At)
*   **7** : Code
*   **8** : Commentaire

### 3. Interface Simplifiée
Le filtre de recherche textuelle présent auparavant a été supprimé. Devenu inutile face à la rapidité des raccourcis numériques pour les 8 types de blocs, sa suppression épure l'interface.

### 4. Navigation au Clavier Optimisée
*   **Flèches directionnelles** : Navigation entre les cartes de blocs.
*   **Entrée** : Validation.
*   **Echap** : Fermeture.

## Installation / Désinstallation

L'installation et la désinstallation s'effectuent via un bloc **Code** dans un scénario Jeedom.

### Installation

Script : [`corePatchInstallation/scenarioBlocSelectionPatchInstall.php`](./corePatchInstallation/scenarioBlocSelectionPatchInstall.php)

Copiez son contenu dans un bloc **Code** puis exécutez le scénario.

Les fichiers originaux sont automatiquement sauvegardés en `.bak` avant leur modification.

### Désinstallation

Script : [`corePatchInstallation/scenarioBlocSelectionPatchUninstall.php`](./corePatchInstallation/scenarioBlocSelectionPatchUninstall.php)

Copiez son contenu dans un bloc **Code** puis exécutez le scénario.

Les fichiers originaux sont restaurés et les fichiers du patch sont supprimés.

## Fichiers modifiés

```text
desktop/php/scenario.php
desktop/js/scenario.js
desktop/css/scenario.css

Les sauvegardes des fichiers Core sont conservées sous :

desktop/php/scenario.php.bak
desktop/js/scenario.js.bak
