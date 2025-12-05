<?php

namespace App\Controllers\NotaFiscal;

use App\Request\Request;
use App\Controllers\Controller;
use App\Services\NFe\NFeService;
use App\Interfaces\Cliente\ICliente;
use App\Interfaces\Venda\IVenda;

class NotaFiscalController extends Controller {
    protected $clienteRepository;
    protected $vendaRepository;

    public function __construct(ICliente $clienteRepository, IVenda $vendaRepository){
        parent::__construct();
        $this->clienteRepository = $clienteRepository;
        $this->vendaRepository = $vendaRepository;
    }

    public function generateXml(Request $request){
        $emitente = $this->clienteRepository->findById(1);

        $venda = $this->vendaRepository->findById(13);

        $nfe = new NFeService([
            'atualizacao' => date('Y-m-d h:i:s'),
            'tpAmb' => 2, //produção e homologação
            'razaosocial' => $emitente->nome,
            'siglaUF' => 'BA',
            'cnpj' => $emitente->documento,
            'schemes' => 'PL_009_V4',
            'versao' => '4.00',
            'CSC' => 'AAAAAA',
            'CSCid' => '0000001'
        ], $emitente);

        header('Content-Type', 'application/xml');
        echo $nfe->generateXml($venda, $emitente)['xml'];
    }

    public function transmitNFe(Request $request){
        $emitente = $this->clienteRepository->findById(1);

        $venda = $this->vendaRepository->findById(13);

        $nfe = new NFeService([
            'atualizacao' => date('Y-m-d h:i:s'),
            'tpAmb' => 2, //produção e homologação
            'razaosocial' => $emitente->nome,
            'siglaUF' => 'BA',
            'cnpj' => $emitente->documento,
            'schemes' => 'PL_009_V4',
            'versao' => '4.00',
            'CSC' => 'AAAAAA',
            'CSCid' => '0000001'
        ], $emitente);

        //if($venda->estado == 'Rejeitado' || $venda->estado == 'Novo'){
        if(true){
            $result = $nfe->generateXml($venda, $emitente);
            print_r($result);
            if(!isset($result['erros_xml'])){
                $signed = $nfe->sign($result['xml']);
                $resultado = $nfe->transmit($signed, $result['chave']);
                if(isset($resultado['sucesso'])){
                    // $venda->chave = $result['chave'];
                    // $venda->estado = 'Aprovado';
                    // $venda->numero_nfe = $result['nNf'];

                    // $venda->save();
                    print_r($resultado['sucesso']);
                }else{
                    // $venda->estado = 'Rejeitado';
                    // $venda->save();
                    print_r($resultado['erro']);
                }
            }else{
                print_r($result['erros_xml']);
            }
        }
    }
}