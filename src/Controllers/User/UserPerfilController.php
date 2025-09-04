<?php

namespace App\Controllers\User;

use App\Request\Request;
use App\Config\Auth;
use App\Controllers\Controller;
use App\Interfaces\User\IUser;

class UserPerfilController extends Controller {

    protected $auth;
    protected $userRepository;
    protected $usuario;

    public function __construct(IUser $userRepository, Auth $auth){
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->auth = $auth;
    }

    public function index(Request $request){
        return $this->router->view('user/perfil/index', [
            'perfil' => true,
            'usuario' => $this->auth->user()
        ]);
    }

    public function updateIcone(Request $request){
        $icone = $request->getBodyParams();
        
        if(isset($_FILES['icone'])){
            $icone = $_FILES['icone'];
        }

        $dir = "/user/icons";

        if($icone['name'] == ""){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Insira uma imagem para continuar',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        $update = $this->userRepository->updateIcone($this->auth->user()->id, $icone, $dir);

        if(is_null($update)){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Não foi possível atualizar imagem de perfil',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        $_SESSION['user'] = $this->userRepository->findById($this->auth->user()->id);

        return $this->router->redirect('perfil');
    }

    public function updateDados(Request $request){
        $data = $request->getBodyParams();

        if($data['nome'] == "" || $data['email'] == "" || $data['cpf'] == ""){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Campo obrigatório em branco',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        $update = $this->userRepository->updatePerfil($data, $this->auth->user()->id);

        if(is_null($update)){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Não foi possível editar seus dados',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        unset($update->senha);

        $_SESSION['user'] = $update;

        return $this->router->redirect('perfil');
    }

    public function updateSenha(Request $request){
        $data = $request->getBodyParams();

        if(!isset($data['senha']) || $data['senha'] == ""){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Senha não pode estar em branco',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        $update = $this->userRepository->updateSenha($data, $this->auth->user()->id);

        if(is_null($update)){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Não foi possível editar sua senha',
                'perfil' => true,
                'usuario' => $this->auth->user()
            ]);
        }

        return $this->router->redirect('perfil');
    }

    public function destroy(Request $request){
        $delete = $this->userRepository->delete($this->auth->user()->id);

        if(!$delete){
            return $this->router->view('user/perfil/index', [
                'erro' => 'Não foi possível excluir sua conta'
            ]);
        }

        return $this->router->redirect('logout');
    }

}