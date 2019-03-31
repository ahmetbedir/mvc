<?php

use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader as EdgeFileLoader;
use Windwalker\Edge\Cache\EdgeFileCache as EdgeFileCache;

class Template {
    
    public function render($file, $data = [], $cache = false){
        $paths = array(VIEWS_PATH);
        
        $loader = new EdgeFileLoader($paths);
        $loader->addFileExtension('.blade.php');
        $loader->addFileExtension('.edge.php');
        
        
        if($cache === true){
            $this->edge = new Edge($loader);
        }else{
            $this->edge = new Edge($loader, null, new EdgeFileCache(APP_PATH.'/cache'));
        }
        
        $result = null;
        
        try {
            $result = $this->edge->render($file, $data);
        } catch (Exception $e) {
            $result = null;
        }
        
        return $result;
    }
    
}