<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use MarkLogic\MLPHP;

// 3. Create a REST client that talks to MarkLogic.

$mlphp = new MLPHP\MLPHP(array(
    'username' => 'rest-writer-user',
    'password' => 'writer-pw',
    'host'     => 'localhost',
    'port'     => 8077,
    'version'  => 'v1',
    'auth'     => 'digest'
));

$client = $mlphp->newClient();
$document = new MLPHP\Document($client);

$qury['$query']['name'] = "srinivas guptha";   // Build your qbe query here .. 
$query = json_encode($qury);                   // Json encode it. ex: {'$query' : { 'name' : 'srinivas guptha'} }
$params['format'] = 'json';					   // Add the parameters your want send 

$results = $document->qbe($query,$params); 


// Display a result.
echo '<html>';
echo '<style>.highlight { background-color: yellow; }</style>';
if ($results->getTotal() > 0) {
    $matches = $results->getResultByIndex(1)->getMatches();
    echo $matches[0]->getContent();
} else {
    echo 'No results found.';
}
echo '</html>';
?>
