/*
 * Patch Jeedom - Scenario Bloc Selection
 * Désinstallation
 */

$files = [
    'desktop/php/scenario.php',
    'desktop/js/scenario.js'
];

$jeedomRoot = realpath(__DIR__ . '/../../');

if (!$jeedomRoot || !is_dir($jeedomRoot)) {
    $scenario->setLog('[Patch ScenarioBloc] ERREUR : racine Jeedom introuvable.');
    return;
}

$scenario->setLog('[Patch ScenarioBloc] Début de la désinstallation.');

// Vérification de tous les backups avant toute restauration
foreach ($files as $file) {
    $backup = $jeedomRoot . '/' . $file . '.bak';

    if (!file_exists($backup)) {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : sauvegarde introuvable : ' . $file . '.bak');
        return;
    }
}

// Restauration des fichiers originaux
foreach ($files as $file) {
    $target = $jeedomRoot . '/' . $file;
    $backup = $target . '.bak';

    if (!copy($backup, $target)) {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : restauration impossible : ' . $file);
        return;
    }

    @chmod($target, 0664);

    if (!unlink($backup)) {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : suppression du .bak impossible : ' . $backup);
        return;
    }

    $scenario->setLog('[Patch ScenarioBloc] Restauré : ' . $file);
}

// Suppression du CSS ajouté par le patch
$css = $jeedomRoot . '/desktop/css/scenario.css';

if (file_exists($css)) {
    if (!unlink($css)) {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : suppression impossible : desktop/css/scenario.css');
        return;
    }

    $scenario->setLog('[Patch ScenarioBloc] Supprimé : desktop/css/scenario.css');
}

$scenario->setLog('[Patch ScenarioBloc] Désinstallation terminée avec succès.');
$scenario->setLog('[Patch ScenarioBloc] Fichiers originaux restaurés.');