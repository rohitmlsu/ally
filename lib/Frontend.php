<?php
class Frontend extends ApiFrontend {

    function init() {
        parent::init();        
        $this->dbConnect();

        $this->api->pathfinder
            ->addLocation(array(
                'addons' => ['vendor','shared/addons'],
                'php'=>['shared']
            ))
            ->setBasePath($this->pathfinder->base_location->getPath());
        // Might come handy when multi-timezone base networks integrates
        $this->today = date('Y-m-d',strtotime($this->recall('current_date',date('Y-m-d'))));
        $this->now = date('Y-m-d H:i:s',strtotime($this->recall('current_date',date('Y-m-d H:i:s'))));

        $this->add('jUI'); 

        $m = $this->add('Menu',null,'Menu');
        $m->addItem('Home','index');
        $m->addItem('About','about');
        $m->addItem('Event','event');
        // $m->addItem('Help','help');

        
        $auth = $this->add('MyAuth');
        $auth->allowPage(['index','about','registration','forgotpassword','resetpassword']);
        $auth->setModel('Person','email','password');
        $auth->addHook('createForm',function($a,$p){
           $p->js(true)->_selector('.atk-content')->addClass('bgimage');
        });
        $auth->check();

        if($auth->isLoggedIn()){
            $m->addItem('Dashboard','dashboard');
            $m->addItem('Search','searchprofile');
            $m->addItem('Logout','logout');
        }else{
            $m->addItem('Login','dashboard');
            $m->addItem('Register','registration');
        }

    }
}
