<?php

abstract class BaseController {
    protected $action;
    protected $controlleName;
    protected $layoutName = DEFAUT_LAYOUT;
    protected $ifViewRendered = FALSE;
    protected $isPost = FALSE;
    
    function __construct($action, $controlleName) {
       $this->controlleName = $controlleName;
       $this->action = $action;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }
       $this->onInit();
    }
    
    public function onInit() {
        // Implement initializing logic in the subclasses
    }

    public function Index(){
        //default action
    }
        
    public function renderView($viewName = NULL, $includeLayout = TRUE) {
        if (!$this->ifViewRendered) {
            if ($viewName == NULL) {
                $viewName = $this->action;
            }
            $ViewPatch = 'views/' . ucfirst(strtolower($this->controlleName)) . '/' . $viewName . '.php';
            
            if ($includeLayout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once ($headerFile); 
            }
            include_once ($ViewPatch); 
            if ($includeLayout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once ($footerFile); 
            }
            
            $this->ifViewRendered = TRUE;
        }
    }  
        
    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect(
        $controllerName, $actionName = null, $params = null) {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            foreach ($params as $parm) {
                $url .= '/' . $parm;
            }
        }
        $this->redirectToUrl($url);
    }
    
    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        array_push($_SESSION['messages'],
        array('text' => $msg, 'type' => $type));
    }
    
    function addInfoMessage($msg) {
        //$_SESSION['messagesInfo'] = $msg;
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        //$_SESSION['messagesErr'] = $msg;
        $this->addMessage($msg, 'error');
    }
}
