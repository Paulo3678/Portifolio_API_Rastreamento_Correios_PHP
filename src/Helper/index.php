<?php

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

require_once __DIR__ . "/../../vendor/autoload.php";

$browser = new HttpBrowser(HttpClient::create());
$browser->request("GET", "https://www2.correios.com.br/sistemas/rastreamento/");

$req = $browser->submitForm("Buscar", [
    "objetos" => "NX343732536BR"
], 'POST');

$noFilterData = $req->filter(".listEvent")->each(function ($node) {
    return $node->text();
});

$filterData = [];

foreach ($noFilterData as $key => $value) {
    array_push($filterData, explode("/", $value));
}

$response = [];


foreach ($filterData as $key => $value) {
    $dados = '';
    $data = $value[0] . "\\" . $value[1] . "\\" . $value[2];
    for ($i = 3; $i < count($value); $i++) {
        $dados .= $value[$i];
    }

    array_push($response, [
        "data" => $data,
        "info" => $dados
    ]);
}

