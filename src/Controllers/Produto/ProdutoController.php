<?php

namespace App\Controllers\Produto;

use App\Request\Request;
use App\Controllers\Controller;
use App\Interfaces\Produto\IProduto;
use App\Interfaces\Grupo\IGrupo;
use App\Interfaces\Tributacao\ITributacao;
use App\Interfaces\Embalagem\IEmbalagem;

class ProdutoController extends Controller {

    protected $produtoRepository;
    protected $grupoRepository;
    protected $tributacaoRepository;
    protected $embalagemRepository;

    public function __construct(IProduto $produtoRepository, IGrupo $grupoRepository, ITributacao $tributacaoRepository, IEmbalagem $embalagemRepository) {
        parent::__construct();
        $this->produtoRepository = $produtoRepository;
        $this->grupoRepository = $grupoRepository;
        $this->tributacaoRepository = $tributacaoRepository;
        $this->embalagemRepository = $embalagemRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $produtos = $this->produtoRepository->all($params);

        return $this->router->view('produto/index', [
            'produtos' => $produtos,
            'nome_codigo' => $params['nome_codigo'] ?? null,
            'tipo' => $params['tipo'] ?? null,
            'ativo' => $params['ativo'] ?? null
        ]);
    }

    public function indexApi(Request $request){
        $params = $request->getQueryParams();

        $produtos = $this->produtoRepository->all($params);

        echo json_encode($produtos);
        exit();
    }

    public function create(Request $request){
        $grupos = $this->grupoRepository->all(['ativo' => 1]);

        $entrada = $this->embalagemRepository->all('entrada_produto', ['ativo' => 1]);
        $saida = $this->embalagemRepository->all('saida_produto', ['ativo' => 1]);

        $icms = $this->tributacaoRepository->all('icms', ['ativo' => 1]);
        $ipi = $this->tributacaoRepository->all('ipi', ['ativo' => 1]);
        $pis = $this->tributacaoRepository->all('pis', ['ativo' => 1]);
        $cofins = $this->tributacaoRepository->all('cofins', ['ativo' => 1]);

        return $this->router->view('produto/create', [
            'grupos' => $grupos,
            'entrada' => $entrada,
            'saida' => $saida,
            'icms' => $icms,
            'ipi' => $ipi,
            'pis' => $pis,
            'cofins' => $cofins
        ]);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $create = $this->produtoRepository->create($data);
        dd($create);
        if(is_null($create)){
            $grupos = $this->grupoRepository->all(['ativo' => 1]);

            $entrada = $this->embalagemRepository->all('entrada_produto', ['ativo' => 1]);
            $saida = $this->embalagemRepository->all('saida_produto', ['ativo' => 1]);

            $icms = $this->tributacaoRepository->all('icms', ['ativo' => 1]);
            $ipi = $this->tributacaoRepository->all('ipi', ['ativo' => 1]);
            $pis = $this->tributacaoRepository->all('pis', ['ativo' => 1]);
            $cofins = $this->tributacaoRepository->all('cofins', ['ativo' => 1]);

            return $this->router->view('produto/create', [
                'erro' => 'Erro ao cadastrar produto',
                'grupos' => $grupos,
                'entrada' => $entrada,
                'saida' => $saida,
                'icms' => $icms,
                'ipi' => $ipi,
                'pis' => $pis,
                'cofins' => $cofins
            ]);
        }

        return $this->router->redirect('produtos');
    }

    public function edit(Request $request, $uuid){
        $produto = $this->produtoRepository->findByUuid($uuid);

        $grupos = $this->grupoRepository->all(['ativo' => 1]);

        if(!$produto){
            return $this->router->redirect('404');
        }

        return $this->router->view('produto/edit', [
            'produto' => $produto,
            'grupos' => $grupos,
            'edit' => true
        ]);
    }

    public function update(Request $request, $uuid){
        $produto = $this->produtoRepository->findByUuid($uuid);

        if(!$produto){
            return $this->router->redirect('produtos');
        }

        $grupos = $this->grupoRepository->all(['ativo' => 1]);

        $data = $request->getBodyParams();

        $update = $this->produtoRepository->update($data, $produto->id);
        
        if(is_null($update)){
            return $this->router->view('produto/edit', [
                'erro' => 'Erro ao cadastrar produto',
                'produto' => $produto,
                'grupos' => $grupos,
                'edit' => true
            ]);
        }

        return $this->router->redirect('produtos');
    }

    public function destroy(Request $request, $uuid){
        $produto = $this->produtoRepository->findByUuid($uuid);

        if(!$produto){
            return $this->router->redirect('produtos');
        }

        $delete = $this->produtoRepository->delete($produto->id);

        if(!$delete){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('produtos');
    }

}