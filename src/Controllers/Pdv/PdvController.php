<?php

namespace App\Controllers\Pdv;

use App\Request\Request;
use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;
use App\Interfaces\Venda\IVendaProduto;
use App\Interfaces\Produto\IProduto;

class PdvController extends Controller {

    protected $auth;
    protected $userRepository;
    protected $vendaRepository;
    protected $vendaProdutoRepository;
    protected $produtoRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IVendaProduto $vendaProdutoRepository, IProduto $produtoRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
        $this->vendaProdutoRepository = $vendaProdutoRepository;
        $this->produtoRepository = $produtoRepository;
    }

    public function index(Request $request){
        $user = $this->auth->user();

        $openSale = $this->vendaRepository->findByLastUserSale($user->id);

        if(!$openSale){
            $create = $this->vendaRepository->create([], $user->id);
            
            if(!$create){
                return $this->router->redirect('404');
            }

            return $this->router->redirect('pdv/'.$create->uuid);
        }

        return $this->router->redirect('pdv/'.$openSale->uuid);
    }

    public function pdv(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

        $totalPriceSale = priceWithDiscount($allProductsInSale);

        return $this->router->view('pdv/index', [
            'venda' => $pdv,
            'produtos' => $allProductsInSale,
            'total' => $totalPriceSale
        ]);
    }

    public function addProductInSale(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $data = $request->getBodyParams();

        $produto = $this->produtoRepository->findByCode($data['codigo']);

        if(!$produto){
            return $this->router->redirect('pdv');
        }

        $addProduct = $this->vendaProdutoRepository->create($data, $pdv->id, $produto->id);

        if(!$addProduct){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function removeProductInSale(Request $request, $uuid, $uuidProduto){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $vendaProduto = $this->vendaProdutoRepository->findByUuid($uuidProduto);

        if(!$vendaProduto){
            return $this->router->redirect('pdv');
        }

        $removeProduct = $this->vendaProdutoRepository->delete($vendaProduto->id, $pdv->id, $vendaProduto->produtos_id);
        
        if(!$removeProduct){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function removeAllProducts(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $removeAllProducts = $this->vendaProdutoRepository->deleteAllProductsInSale($pdv->id);
        
        if(!$removeAllProducts){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function finalizar(Request $request){
        return $this->router->view('pdv/finalizar', []);
    }

}