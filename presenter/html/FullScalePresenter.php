<?php


namespace presenter\html;


use model\Header;
use model\Page;
use model\settings\AppSettings;
use presenter\Presenter;
use view\html\FooterView;
use view\html\HeaderLoginView;
use view\html\HeaderView;
use view\html\HeadView;

abstract class FullScalePresenter extends Presenter {
    protected $headView;
    protected $headerView;
    protected $footerView;

    protected final function setDefaulHeaderLoginInfo() {
        $header = new Header($this->lang, $this->user, Page::getPages());

        $this->headerView->setHeader($header);
    }

    protected function setHeadView(): HeadView {
        return new HeadView();
    }

    protected function setHeaderView(): HeaderView {
        return new HeaderView();
    }

    protected function setFooterView(): FooterView {
        return new FooterView();
    }

    protected final function setAllViews(): void {
        $this->headView = $this->setHeadView();
        $this->headerView = $this->setHeaderView();
        $this->footerView = $this->setFooterView();

        $this->setDefaulHeaderLoginInfo();
    }

    public function output(): string {
        $this->headers();
        $str = "<html>\n";
        $str .= @$this->headView->output();
        $str .= "<body>\n";
        $str .= @$this->headerView->output();
        $str .= "\n<main class='main_content'>\n";
        $str .= @$this->view->output();
        $str .= "\n</main>";
        $str .= @$this->footerView->output();
        $str .= "\n</body>\n</html>";
        return $str;
    }

    protected final function setTitle(string $title, string $suffix = AppSettings::DEFAULT_AFTER_TITLE) {
        $this->headView->setTitle($title . ($suffix ? " | " . $suffix : ""));
    }
}