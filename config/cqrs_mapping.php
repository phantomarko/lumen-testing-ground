<?php

$mappingFiles = [
    '../app/Ui/Rest/Product/Resources/cqrs_mapping.php',
];

$mappings = [];
foreach ($mappingFiles as $mappingFile) {
    $mappings = array_merge(require $mappingFile, $mappings);
}

return $mappings;
