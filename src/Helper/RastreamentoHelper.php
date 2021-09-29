<?php

namespace App\Helper;

use DateTime;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\BrowserKit\HttpBrowser;

abstract class RastreamentoHelper
{
    public static function buscarDados(string $codigoDeRastreamento)
    {
        $browser = new HttpBrowser(HttpClient::create());
        $browser->request("GET", "https://www2.correios.com.br/sistemas/rastreamento/");
        //NX343732536BR
        $req = $browser->submitForm("Buscar", [
            "objetos" =>  $codigoDeRastreamento
        ], 'POST');

        $teste = $req->filter(".listEvent")->each(function ($node) {
            if (
                $node->text() !== "\t\r" &&
                $node->text() !== "\r" &&
                $node->text() !== "\t" &&
                $node->text() !== " \r" &&
                $node->text() !== ""
            ) {
                return $node->text();
            }
        });

        $array = [];

        foreach ($teste as $key => $value) {
            array_push($array, explode("\n", $value));
        }

        return $array;
    }
}
