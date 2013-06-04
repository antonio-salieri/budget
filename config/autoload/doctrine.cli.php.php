<?php
require 'autoloader.php';
App::init(); // read configuration and create $em
?>

app/console.php
<?php
require 'bootstrap.php';
$em = App::getEntityManager();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));