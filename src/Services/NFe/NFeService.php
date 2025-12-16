<?php

namespace App\Services\NFe;

use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use App\Models\Venda;
use NFePHP\NFe\Complements;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\Legacy\FilesFolders;
use NFePHP\Common\Soap\SoapCurl;

class NFeService {
    protected $tools;
   
    public function __construct(array $config, $issuer){
        $this->tools = new Tools(json_encode($config), Certificate::readPfx(file_get_contents(__DIR__.'/certificado.pfx'), '123456'));
        $this->tools->model(55);
    }

    public function generateXml($sale, $issuer){
        $nfe = new Make();
		$stdInNFe = new \stdClass();
		$stdInNFe->versao = '4.00'; 
		$stdInNFe->Id = null; 
		$stdInNFe->pk_nItem = ''; 
		$infNFe = $nfe->taginfNFe($stdInNFe);

        $numeroNFe = rand(1,9999);
		$stdIde = new \stdClass();
		$stdIde->cUF = 29;
		$stdIde->cNF = rand(11111,99999);
		$stdIde->natOp = "Teste de Venda de produtos em homologação (Testes)";

        $stdIde->mod = 55;
		$stdIde->serie = rand(100, 999);
		$stdIde->nNF = (int)$numeroNFe;
		$stdIde->dhEmi = date("Y-m-d\TH:i:sP");
		$stdIde->dhSaiEnt = date("Y-m-d\TH:i:sP");
		$stdIde->tpNF = 1;

        $stdIde->idDest = 1;
		$stdIde->cMunFG = 2931905;
		$stdIde->tpImp = 1;
		$stdIde->tpEmis = 1;
		$stdIde->cDV = 0;
		$stdIde->tpAmb = 2; //ambiente prod ou homologacao
		$stdIde->finNFe = 1;
		$stdIde->indFinal = 1;
		$stdIde->indPres = 1;
		$stdIde->indIntermed = 0;
		$stdIde->procEmi = '0';
		$stdIde->verProc = '3.10.31';
		$tagide = $nfe->tagide($stdIde);

        //TAG EMITENTE
		$stdEmit = new \stdClass();
		$stdEmit->xNome = $issuer->nome;
		$stdEmit->xFant = $issuer->nome;

		$ie = str_replace(".", "", '22.392.905-01');
		$ie = str_replace("/", "", $ie);
		$ie = str_replace("-", "", $ie);
		$stdEmit->IE = $ie;

		$stdEmit->CRT = 1; // Simples nacional
		$cnpj = str_replace(".", "", '60643465000192');
		$cnpj = str_replace("/", "", $cnpj);
		$cnpj = str_replace("-", "", $cnpj);
		$cnpj = str_replace(" ", "", $cnpj);

		if(strlen($cnpj) == 14){
			$stdEmit->CNPJ = $cnpj;
		}else{
			$stdEmit->CPF = $cnpj;
		}
		$emit = $nfe->tagemit($stdEmit);

        // ENDERECO EMITENTE
		$stdEnderEmit = new \stdClass();
		$stdEnderEmit->xLgr = 'Rua Jorge Amado';
		$stdEnderEmit->nro = 148;
		$stdEnderEmit->xCpl = 'Complemento: casa';
		$stdEnderEmit->xBairro = 'Primavera';
		$stdEnderEmit->cMun = 2931905;
		$stdEnderEmit->xMun = 'Tucano';
		$stdEnderEmit->UF = 'BA';

        $telefone = $issuer->telefone;
		$telefone = str_replace("(", "", $telefone);
		$telefone = str_replace(")", "", $telefone);
		$telefone = str_replace("-", "", $telefone);
		$telefone = str_replace(" ", "", $telefone);
		$stdEnderEmit->fone = $telefone;

        $cep = str_replace("-", "", '48790-000');
		$cep = str_replace(".", "", $cep);
		$stdEnderEmit->CEP = $cep;
		$stdEnderEmit->cPais = '1058';
		$stdEnderEmit->xPais = 'BRASIL';

        $enderEmit = $nfe->tagenderEmit($stdEnderEmit);

        // DESTINATARIO
		$stdDest = new \stdClass();
		$pFisica = false;
		$stdDest->xNome = 'João da Silva dos Testes';

        //if($venda->cliente->contribuinte){
        if(true){
			//if($venda->cliente->ie_rg == 'ISENTO'){
			if('ISENTO' == 'ISENTO'){
				$stdDest->indIEDest = "2";
			}else{
				$stdDest->indIEDest = "1";
			}

		}else{
			$stdDest->indIEDest = "9";
		}

        $cnpj_cpf = str_replace(".", "", '60643465000192');
		$cnpj_cpf = str_replace("/", "", $cnpj_cpf);
		$cnpj_cpf = str_replace("-", "", $cnpj_cpf);

		if(strlen($cnpj_cpf) == 14){
			$stdDest->CNPJ = $cnpj_cpf;
			$ie = str_replace(".", "", '22.392.905-01');
			$ie = str_replace("/", "", $ie);
			$ie = str_replace("-", "", $ie);
			$stdDest->IE = $ie;
		}
		else{
			// $stdDest->CPF = $cnpj_cpf;
			$stdDest->CPF = $cnpj_cpf;
			$ie = str_replace(".", "", '22.392.905-01');
			$ie = str_replace("/", "", $ie);
			$ie = str_replace("-", "", $ie);
			if(strtolower($ie) != "isento" && true)
				$stdDest->IE = $ie;
		} 

		$dest = $nfe->tagdest($stdDest);

        //ENDEREÇO DESTINATÁRIO
		$stdEnderDest = new \stdClass();
        $stdEnderDest->xLgr = 'Rua Jorge Amado';
		$stdEnderDest->nro = 148;
		$stdEnderDest->xCpl = 'Complemento: casa';
		$stdEnderDest->xBairro = 'Primavera';

		$telefone = '75 991228382';
		$telefone = str_replace("(", "", $telefone);
		$telefone = str_replace(")", "", $telefone);
		$telefone = str_replace("-", "", $telefone);
		$telefone = str_replace(" ", "", $telefone);
		$stdEnderDest->fone = $telefone;

		$stdEnderDest->cMun = 2931905;
		$stdEnderDest->xMun = 'Tucano';
		$stdEnderDest->UF = 'BA';

		$cep = str_replace("-", "", '48790-000');
		$cep = str_replace(".", "", $cep);
		$stdEnderDest->CEP = $cep;
		$stdEnderDest->cPais = "1058";
		$stdEnderDest->xPais = "BRASIL";
		$enderDest = $nfe->tagenderDest($stdEnderDest);

		//itens (produtos) usar foreach depois
		$stdProd = new \stdClass();
		$stdProd->item = 123;

		$cod = 'SEM GTIN';

		$stdProd->cEAN = $cod;
		$stdProd->cEANTrib = $cod;
		$stdProd->cProd = 31;
		$stdProd->xProd = 'Produo de Teste';

		$ncm = '1902.19.00';
		$ncm = str_replace(".", "", $ncm);
		$stdProd->NCM = $ncm;

		$stdProd->CFOP = 5405;

		$stdProd->uCom = 'UN';
		$stdProd->qCom = '10.000';
		$stdProd->vUnCom = '12.5000';
		$stdProd->vProd = '125.00';
		$stdProd->uTrib = 'UN';
		$stdProd->qTrib = '6.000';
		$stdProd->vUnTrib = '10.000';
		$stdProd->indTot = 1;
		$prod = $nfe->tagprod($stdProd);

		$stdImposto = new \stdClass();
		$stdImposto->item = 123;
		$imposto = $nfe->tagimposto($stdImposto);

		//ICMS
		$stdICMS = new \stdClass();
		$stdICMS->item = 123; 
		$stdICMS->orig = 0;
		$stdICMS->CSOSN = 101;
		$stdICMS->modBC = 0;
		$stdICMS->vBC = $stdProd->vProd;
		$stdICMS->pICMS = '18.00';
		$stdICMS->vICMS = $stdICMS->vBC * ($stdICMS->pICMS/100);
		$stdICMS->pCredSN = '1.65';
		$stdICMS->vCredICMSSN = '1.65';
		$ICMS = $nfe->tagICMSSN($stdICMS);

		//PIS
		$stdPIS = new \stdClass();
		$stdPIS->item = 123; 
		$stdPIS->CST = '01';
		$stdPIS->vBC = '100.00';
		$stdPIS->pPIS = '21.50';
		$stdPIS->vPIS = '1.65';
		$PIS = $nfe->tagPIS($stdPIS);

		//COFINS
		$stdCOFINS = new \stdClass();
		$stdCOFINS->item = 123; 
		$stdCOFINS->CST = '01';
		$stdCOFINS->vBC = 100.00;
		$stdCOFINS->pCOFINS = 7.60;
		$stdCOFINS->vCOFINS = number_format($stdCOFINS->vBC * ($stdCOFINS->pCOFINS / 100), 2, '.', '');
		$COFINS = $nfe->tagCOFINS($stdCOFINS);

		//IPI
		$std = new \stdClass();
		$std->item = 123; 
		$std->cEnq = '999'; 
		$std->CST = '50';
		$std->vBC = 100.00;
		$std->pIPI = 5.00;
		$std->vIPI = number_format($std->vBC * ($std->pIPI / 100), 2, '.', '');;
		$nfe->tagIPI($std);
		///

		$stdProd = new \stdClass();
		$stdProd->item = 789001273;

		$cod = 'SEM GTIN';

		$stdProd->cEAN = $cod;
		$stdProd->cEANTrib = $cod;
		$stdProd->cProd = 31;
		$stdProd->xProd = 'Outro produto de teste';

		$ncm = '1902.19.00';
		$ncm = str_replace(".", "", $ncm);
		$stdProd->NCM = $ncm;

		$stdProd->CFOP = 5405;

		$stdProd->uCom = 'UN';
		$stdProd->qCom = '10.000';
		$stdProd->vUnCom = '12.5000';
		$stdProd->vProd = '20.00';
		$stdProd->uTrib = 'UN';
		$stdProd->qTrib = '6.000';
		$stdProd->vUnTrib = '13.000';
		$stdProd->indTot = 1;
		$prod = $nfe->tagprod($stdProd);

		$stdImposto = new \stdClass();
		$stdImposto->item = 789001273;
		$imposto = $nfe->tagimposto($stdImposto);

		//ICMS
		$stdICMS = new \stdClass();
		$stdICMS->item = 789001273; 
		$stdICMS->orig = 0;
		$stdICMS->CSOSN = 101;
		$stdICMS->modBC = 0;
		$stdICMS->vBC = $stdProd->vProd;
		$stdICMS->pICMS = '18.00';
		$stdICMS->vICMS = $stdICMS->vBC * ($stdICMS->pICMS/100);
		$stdICMS->pCredSN = '1.65';
		$stdICMS->vCredICMSSN = '1.65';
		$ICMS = $nfe->tagICMSSN($stdICMS);

		//PIS
		$stdPIS = new \stdClass();
		$stdPIS->item = 789001273; 
		$stdPIS->CST = '01';
		$stdPIS->vBC = '100.00';
		$stdPIS->pPIS = '21.50';
		$stdPIS->vPIS = '1.65';
		$PIS = $nfe->tagPIS($stdPIS);

		//COFINS
		$stdCOFINS = new \stdClass();
		$stdCOFINS->item = 789001273; 
		$stdCOFINS->CST = '01';
		$stdCOFINS->vBC = 100.00;
		$stdCOFINS->pCOFINS = 7.60;
		$stdCOFINS->vCOFINS = number_format($stdCOFINS->vBC * ($stdCOFINS->pCOFINS / 100), 2, '.', '');
		$COFINS = $nfe->tagCOFINS($stdCOFINS);

		//IPI
		$std = new \stdClass();
		$std->item = 789001273; 
		$std->cEnq = '999'; 
		$std->CST = '50';
		$std->vBC = 100.00;
		$std->pIPI = 5.00;
		$std->vIPI = number_format($std->vBC * ($std->pIPI / 100), 2, '.', '');;
		$nfe->tagIPI($std);
		///FIM DO FOREACH dos produtos


		$stdTransp = new \stdClass();
		$stdTransp->modFrete = '9';

		$transp = $nfe->tagtransp($stdTransp);

		//TOTALIZADOR NFE
		$stdICMSTot = new \stdClass();
		$stdICMSTot->vProd = 0.00;
		$stdICMSTot->vBC = 0.00;
		$stdICMSTot->vICMS = 0.00;
		$stdICMSTot->vICMSDeson = 0.00;
		$stdICMSTot->vBCST = 0.00;
		$stdICMSTot->vST = 0.00;
		$stdICMSTot->vFrete = 0.00;
		$stdICMSTot->vSeg = 0.00;
		$stdICMSTot->vDesc = 0.00;
		$stdICMSTot->vII = 0.00;
		$stdICMSTot->vIPI = 0.00;
		$stdICMSTot->vPIS = 0.00;
		$stdICMSTot->vCOFINS = 0.00;
		$stdICMSTot->vOutro = 0.00;
		$stdICMSTot->vTotTrib = 0.00;
		$stdICMSTot->vNF = $sale->total;

		//DUPLICATAS
		$stdFat = new \stdClass();
		$stdFat->nFat = (int)$numeroNFe;
		$stdFat->vOrig = $sale->total;
		$stdFat->vDesc = 0.00;
		$stdFat->vLiq = $sale->total;
		//if($sale->forma_pagamento != '90'){
		if('90' != '90'){
			$fatura = $nfe->tagfat($stdFat);
		}

		//foreach($venda->fatura as $key =>  $fat){
			$stdDup = new \stdClass();
			$stdDup->nDup = '00'.(123);
			$stdDup->dVenc = '2025-12-31';
			$stdDup->vDup =  '1500.00';

			$nfe->tagdup($stdDup);

			$stdPag = new \stdClass();
			$pag = $nfe->tagpag($stdPag);

			$stdDetPag = new \stdClass();
			$stdDetPag->tPag = '03';
			$stdDetPag->vPag = '1500.00'; 
			$stdDetPag->indPag = 1; 
			$stdDetPag->vTroco = 0;
			if(true){
				$stdDetPag->tBand = '01';
				$stdDetPag->tpIntegra = 2;
			}
			$detPag = $nfe->tagdetPag($stdDetPag);
		//fim do foreach

		//if(getenv('AUT_XML') != ''){
		if(true){
			$std = new \stdClass();
			$cnpj = '60643465000192';
			$cnpj = str_replace(".", "", $cnpj);
			$cnpj = str_replace("-", "", $cnpj);
			$cnpj = str_replace("/", "", $cnpj);
			$cnpj = str_replace(" ", "", $cnpj);
			$std->CNPJ = $cnpj;
			$aut = $nfe->tagautXML($std);
		}

		//TAG RESPONSAVEL TECNICO
		$std = new \stdClass();
		$std->CNPJ = '60643465000192'; //CNPJ da pessoa jurídica responsável pelo sistema utilizado na emissão do documento fiscal eletrônico
		$std->xContato= 'André Victor Pimentel Sapucaia'; //Nome da pessoa a ser contatada
		$std->email = 'andreandre9128@gmail.com'; //E-mail da pessoa jurídica a ser contatada
		$std->fone = '75919230344';
		$nfe->taginfRespTec($std);

		try{
			$nfe->montaNFe();
			$arr = [
				'chave' => $nfe->getChave(),
				'xml' => $nfe->getXML(),
				'nNf' => $stdIde->nNF
			];
			return $arr;
		}catch(\Exception $e){
			return [
				'erros_xml' => 'Erro: ' . $nfe->getErrors()
			];
		}
    }

	public function sign($xml){
		return $this->tools->signNFe($xml);
	}

	public function transmit($signXml, $key){
		try{
			$idLote = str_pad(rand(1, 999999999999999), 15, '0', STR_PAD_LEFT);
			$resp = $this->tools->sefazEnviaLote([$signXml], $idLote, 1);

			$st = new Standardize();
			$std = $st->toStd($resp);
			sleep(2);

			if ($std->cStat != 103) {
				return [
					'erro' => "[$std->cStat] - $std->xMotivo"
				];
			}
			
			$recibo = $std->infRec->nRec; 
			$protocolo = $this->tools->sefazConsultaRecibo($recibo);
			
			sleep(3);
			try {
				$xml = Complements::toAuthorize($signXml, $protocolo);
				//createImage($key, 'nfe_xml');
				return [
					'sucesso' => $recibo
				];
				// $this->printDanfe($xml);
			} catch (\Exception $e) {
				return [
					'erro' => $e->getMessage()
				];
			}

		} catch(\Exception $e){
			return [
				'erro' => $e->getMessage()
			];
		}
	}

}