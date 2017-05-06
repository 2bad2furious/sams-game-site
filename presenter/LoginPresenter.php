<?php


namespace presenter;


use model\form\customforms\LoginForm;
use model\language\LanguageI;
use model\user\User;
use presenter\Presenter;
use view\glob\LoginViewI;

class LoginPresenter extends Presenter {
    private $session;
    private $post;
    private $view;
    private $lang;
    /**
     * @var
     */
    private $request_method;
    /**
     * @var string
     */
    private $remote_addr;

    /**
     * LoginPresenter constructor.
     * @param array $session
     * @param array $post
     * @param LoginViewI $view
     * @param LanguageI $lang
     * @param string $request_method
     * @param string $remote_addr
     */
    public function __construct(array $session, array $post, LoginViewI $view, LanguageI $lang, string $request_method,string $remote_addr) {
        $this->session = $session;
        $this->post = $post;
        $this->view = $view;
        $this->lang = $lang;

        $this->request_method = $request_method;
        $this->remote_addr = $remote_addr;

        $this->main();
    }

    private function main(): void {
        $form = new LoginForm($this->lang, $this->post);

        $this->setUser($this->session);

        if ($this->isLogged()) {
            $this->view->isLoggedIn(true);
            return;
        }

        diedump($this->request_method);

        $hasData = $form->hasData($this->request_method);


        $this->view->hasData($hasData);
        $this->view->setForm($form);

        if ($hasData) {
            $username = $form->getUsername();
            $password = $form->getPassword();

            $user = User::getUserByLogin($username,$password,$this->remote_addr);
            var_dump($user);

        }
    }


}