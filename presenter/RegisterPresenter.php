<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 8.5.17
 * Time: 13:12
 */

namespace presenter;


use model\form\customforms\RegisterForm;
use model\language\LanguageI;
use model\user\User;
use view\glob\RegisterViewI;

class RegisterPresenter extends Presenter{
    private $session;
    private $post;
    private $view;
    private $lang;
    private $request_method;
    private $remote_addr;

    /**
     * LoginPresenter constructor.
     * @param array $session
     * @param array $post
     * @param RegisterViewI $view
     * @param LanguageI $lang
     * @param string $request_method
     * @param string $remote_addr
     */
    public function __construct(array $session, array $post, RegisterViewI $view, LanguageI $lang, string $request_method,string $remote_addr) {
        $this->session = $session;
        $this->post = $post;
        $this->view = $view;
        $this->lang = $lang;

        $this->request_method = $request_method;
        $this->remote_addr = $remote_addr;

        $this->main();
    }

    private function main():void{
        $form = new RegisterForm($this->lang,$this->post);
        $this->view->setForm($form);

        $this->setUser($this->session);

        $this->view->isLoggedIn(boolval($this->isLogged()));

        if ($this->isLogged()) {
            return;
        }

        $hasData = $form->hasData($this->request_method);

        $this->view->hasData($hasData);

        if($hasData){
            $username = $form->getUsername()->getValue();
            $email = $form->getEmail()->getValue();
            $password = $form->getPassword()->getValue();
            $password2 = $form->getPassword2()->getValue();


            $this->view->passwordsEqual($passwordsEqual = $password === $password2);
            if(!$passwordsEqual) return;

            $registerData = User::registerUser($username,$password,$email,$this->remote_addr);

            $this->view->setRegisterData($registerData);
        }
    }
}