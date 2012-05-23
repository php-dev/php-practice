<?php
/**
 * @desc this is a good example of class auto loader
 */
class Loader
{
    // here we store the already-initialized namespaces
    private static $loadedNamespaces = array();
 
    static function loadClass($className)
    {
        // we assume the class AAA\BBB\CCC is placed in /AAA/BBB/CCC.php
        $className = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $className);
      
        // we get the namespace parts
        $namespaces = explode(DIRECTORY_SEPARATOR, $className);
        unset($namespaces[sizeof($namespaces)-1]); // the last item is the classname
      
        // now we loops over namespaces
        $current=""; foreach($namespaces as $namepart)
        {
            // we chain $namepart to parent namespace string
            $current.='\\' . $namepart;
            // skip if the namespace is already initialized
            if(in_array($current, self::$loadedNamespaces)) continue;
            // wow, we got a namespace to load, so:
            $fnload = $current . DIRECTORY_SEPARATOR . "__init.php";
            if(file_exists($fnload)) require($fnload);
            // then we flag the namespace as already-loaded
            self::$loadedNamespaces[] = $current;
        }

        // we build the filename to require
        $load = $className . ".php";
        // check for file existence
        !file_exists($load) ?: require($load);
        // return true if class is loaded
        return class_exists($className, false);
    }
    static function register()
    {
        spl_autoload_register("Loader::loadClass");
    }
    static function unregister()
    {
        spl_autoload_unregister("Loader::loadClass");
    }
}

Loader::register();

?>