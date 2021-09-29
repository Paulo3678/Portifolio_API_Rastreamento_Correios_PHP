<?php

namespace App\Controller;

use App\Helper\FiltraArray;
use App\Helper\RastreamentoHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Rastreio extends AbstractController
{
    /** 
     * @Route("/rastreio/{codigo}", methods={"GET"})
     */
    public function rastreio(string $codigo): Response
    {
        $dados = RastreamentoHelper::buscarDados($codigo);

        $retorno = FiltraArray::filtraArray($dados);
        return new JsonResponse($retorno);
    }

}
