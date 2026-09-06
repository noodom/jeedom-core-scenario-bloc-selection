/*
 * Patch Jeedom - Scenario Bloc Selection
 * Installation
 */

$repository = 'https://raw.githubusercontent.com/noodom/jeedom-core-scenario-bloc-selection/main';

$files = [
    'desktop/php/scenario.php',
    'desktop/js/scenario.js',
    'desktop/css/scenario.css'
];

$jeedomRoot = realpath(__DIR__ . '/../../');

if (!$jeedomRoot || !is_dir($jeedomRoot)) {
    $scenario->setLog('[Patch ScenarioBloc] ERREUR : racine Jeedom introuvable.');
    return;
}

$scenario->setLog('[Patch ScenarioBloc] Début de l\'installation.');

// Téléchargement préalable de tous les fichiers
$downloaded = [];

foreach ($files as $file) {
    $url = $repository . '/' . $file;
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_USERAGENT => 'Jeedom-ScenarioBloc-Patch'
    ]);

    $content = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($content === false || $httpCode !== 200 || trim($content) === '') {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : téléchargement impossible : ' . $file);
        return;
    }

    $downloaded[$file] = $content;
    $scenario->setLog('[Patch ScenarioBloc] Téléchargé : ' . $file);
}

// Création des sauvegardes des fichiers originaux
foreach ($files as $file) {
    // scenario.css est ajouté par le patch
    if ($file === 'desktop/css/scenario.css') {
        continue;
    }

    $target = $jeedomRoot . '/' . $file;
    $backup = $target . '.bak';

    if (!file_exists($backup)) {
        if (!file_exists($target)) {
            $scenario->setLog('[Patch ScenarioBloc] ERREUR : fichier original introuvable : ' . $file);
            return;
        }

        if (!copy($target, $backup)) {
            $scenario->setLog('[Patch ScenarioBloc] ERREUR : sauvegarde impossible : ' . $file);
            return;
        }

        $scenario->setLog('[Patch ScenarioBloc] Sauvegarde créée : ' . $file . '.bak');
    } else {
        $scenario->setLog('[Patch ScenarioBloc] Sauvegarde existante conservée : ' . $file . '.bak');
    }
}

// Installation des fichiers du patch
foreach ($files as $file) {
    $target = $jeedomRoot . '/' . $file;

    if (file_put_contents($target, $downloaded[$file]) === false) {
        $scenario->setLog('[Patch ScenarioBloc] ERREUR : écriture impossible : ' . $file);
        return;
    }

    @chmod($target, 0664);
    $scenario->setLog('[Patch ScenarioBloc] Installé : ' . $file);
}

$scenario->setLog('[Patch ScenarioBloc] Patch installé avec succès.');