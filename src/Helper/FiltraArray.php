<?php

namespace App\Helper;

abstract class FiltraArray
{

    public static function filtraArray(array $dados): array
    {
        $arrayFormatado = [];
        foreach ($dados as $key => $value) {
            $data = [];

            // limpa array
            foreach ($value as $chave => $valor) {
                if (
                    $valor !== "\n" &&
                    $valor !== "\t\r" &&
                    $valor !== " \t\r" &&
                    $valor !== " \r" &&
                    $valor !== "\r" &&
                    $valor !== ""
                ) {
                    $valor = str_replace("\r", " ", $valor);
                    $valor = str_replace("\t", "", $valor);

                    array_push($data, $valor);
                }
            }
            array_push($arrayFormatado, $data);
        }

        $finalArray = [];
        foreach ($arrayFormatado as $key => $value) {
            $info = "";

            for ($i = 3; $i < count($value); $i++) {
                $info .= $value[$i];
            }

            array_push($finalArray, [
                "date" => str_replace(" ", "", $value[0]),
                "time" => str_replace(" ", "", $value[1]),
                "city" => $value[2],
                "info" => $info
            ]);
        }

        return $finalArray;
    }
}
