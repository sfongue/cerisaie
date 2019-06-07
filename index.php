<?php
require_once '../vendor/restler.php';
use Luracast\Restler\Defaults;
Defaults::$smartAutoRouting = false;
$r = new Restler();
$r->addAPIClass('typeEmplacement');
$r->addAPIClass('activite');
$r->addAPIClass('client');
$r->addAPIClass('emplacement');
$r->addAPIClass('sejour');
$r->addAPIClass('reservation');
$r->addAPIClass('facture');
$r->handle();
?>
