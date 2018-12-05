<?php

class Controller_Locator extends Controller_Base
{

    public function action_index()
    {
        $this->template->set_global('title', 'Find a Store');
        $this->template->set('content', $this->theme->view('locator/index', array(
            '_search_form' => $this->theme->view('locator/_search_form'),
            '_result_set'  => $this->theme->view('locator/_result_set', array(
                    'categories' => Model_Content::getByKey('categories'),
                    'services'   => Model_Content::getByKey('services'),
                )),
        )));
    }

}