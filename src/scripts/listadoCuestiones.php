<?php
/**
 * PHP version 7.2
 * src\scripts\listadoCuestiones.php
 *
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

use TDW\GCuest\Entity\Cuestion;

require 'inicio.php';

try {
    $entityManager = \TDW\GCuest\Utils::getEntityManager();
    $cuestiones = $entityManager->getRepository(Cuestion::class)->findAll();
    $entityManager->close();
} catch (\Exception $e) {
    exit('ERROR (' . $e->getCode() . '): ' . $e->getMessage());
}

// Salida formato JSON
if (in_array('--json', $argv, false)) {
    echo json_encode([ 'cuestiones' => $cuestiones], JSON_PRETTY_PRINT);
    exit();
}

/** @var Cuestion $cuestion */
foreach ($cuestiones as $cuestion) {
    echo $cuestion . PHP_EOL;
}
