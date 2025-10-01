<?php

namespace App\Controllers\User;

use App\Request\Request;
use App\Config\Auth;
use App\Controllers\Controller;
use App\Interfaces\User\IUser;
use App\Interfaces\User\IRecoveryPassword;
use App\Services\Email\EmailService;

class RecoveryPasswordController extends Controller {

    protected $userRepository;
    protected $recuperar;
    protected $email;

    public function __construct(IUser $userRepository, IRecoveryPassword $recuperar, EmailService $email){
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->recuperar = $recuperar;
        $this->email = $email;
    }

    public function index(Request $request){
        return $this->router->view('user/recovery-password/index', []);
    }

    public function sendCode(Request $request){
        $data = $request->getBodyParams();

        $user = $this->userRepository->findUserByEmail($data['email']);
        
        if(!$user){
            return $this->router->view('user/recovery-password/index', [
                'erro' => 'Usuário não encontrado',
                'email' => $data['email'] ?? null
            ]);
        }

        $code = $this->recuperar->create($user->id);

        if(is_null($code)){
            return $this->router->view('user/recovery-password/index', [
                'erro' => 'Erro ao enviar o código'
            ]);
        }

        $sendCodeToEmail = $this->email->sendRecoveryPassword($user, $code->codigo);

        if(is_null($sendCodeToEmail)){
            return $this->router->view('user/recovery-password/index', [
                'erro' => 'Erro ao enviar o código'
            ]);
        }

        return $this->router->redirect('recuperar-senha/' . $code->uuid);
    }


    public function verifyCode(Request $request, $uuid){
        return $this->router->view('user/recovery-password/verify', [
            'uuid' => $uuid
        ]);
    }

    public function verifySendCode(Request $request, $uuid){
        $data = $request->getBodyParams();

        $recuperacao = $this->recuperar->findByUuid($uuid);

        if(!$recuperacao){
            return $this->router->redirect('404');
        }

        $user = $this->userRepository->findById($recuperacao->usuarios_id);
        
        if(!$user){
            return $this->router->redirect('404');
        }

        $code = $this->recuperar->findByCodeAndUser($user->id, (int)$recuperacao->codigo);

        if(!$code){
            return $this->router->view('user/recovery-password/verify', [
                'erro' => 'Código não encontrado'
            ]);
        }

        return $this->router->redirect('recuperar-senha/'.$recuperacao->uuid.'/trocar-senha');
    }

    public function replacePassword(Request $request, $uuid){
        $recuperacao = $this->recuperar->findByUuid($uuid);

        if(!$recuperacao){
            return $this->router->redirect('404');
        }

        $user = $this->userRepository->findById($recuperacao->usuarios_id);
        
        if(!$user){
            return $this->router->redirect('404');
        }

        return $this->router->view('user/recovery-password/password', [
            'uuid' => $uuid
        ]);
    }

    public function updatePassword(Request $request, $uuid){
        $data = $request->getBodyParams();

        $recuperacao = $this->recuperar->findByUuid($uuid);

        if(!$recuperacao){
            return $this->router->redirect('404');
        }

        $user = $this->userRepository->findById($recuperacao->usuarios_id);
        
        if(!$user){
            return $this->router->redirect('404');
        }

        if($data['senha'] != $data['confirmar-senha']){
            return $this->router->view('user/recovery-password/password', [
                'uuid' => $uuid,
                'erro' => 'As senhas não são iguais, insira novamente'
            ]);
        }

        $new_password = $this->userRepository->updateSenha($data, $user->id);

        if(is_null($new_password)){
            return $this->router->view('user/recovery-password/password', [
                'uuid' => $uuid,
                'erro' => 'Erro ao alterar senha'
            ]);
        }

        $removeCode = $this->recuperar->delete($recuperacao->id, $user->id);

        if(!$removeCode){
            return $this->router->view('user/recovery-password/password', [
                'uuid' => $uuid,
                'erro' => 'Erro ao alterar senha'
            ]);
        }

        return $this->router->redirect('');
    }

    public function cancelCode(Request $request, $uuid){
        $recuperacao = $this->recuperar->findByUuid($uuid);

        if(!$recuperacao){
            return $this->router->redirect('404');
        }

        $user = $this->userRepository->findById($recuperacao->usuarios_id);
        
        if(!$user){
            return $this->router->redirect('404');
        }

        $removeCode = $this->recuperar->delete($recuperacao->id, $user->id);

        if(!$removeCode){
            return $this->router->view('user/recovery-password/verify', [
                'uuid' => $uuid,
                'erro' => 'Erro ao cancelar o código'
            ]);
        }

        return $this->router->redirect('');
    }
}