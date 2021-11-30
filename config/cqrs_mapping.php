<?php

$configFiles = [
    '../app/Infrastructure/Product/Resources/cqrs_mapping.php',
];

$mappings = [];
foreach ($configFiles as $configFile) {
    $mappings = array_merge(require $configFile, $mappings);
}

return $mappings;
