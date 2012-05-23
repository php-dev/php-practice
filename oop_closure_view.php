

<?php
//(MyApplication/ViewInterface.php)
namespace MyApplication;

interface ViewInterface
{
    /**
     * Set the view template file
     */
    public function setTemplateFile($templateFile);
   
    /**
     * Get the view template file
     */
    public function getTemplateFile();
   
    /**
     * Add a new field to the view
     */
    public function set($name, $value);
   
    /**
     * Get the given field from the view
     */
    public function get($name);
   
    /**
     * Check if the given view field exists
     */
    public function exists($name);
   
    /**
     * Remove the given field from the view
     */
    public function remove($name);
   
    /**
     * Render the view template file
     */
    public function render();              
}
//Read more at http://www.devshed.com/c/a/PHP/Using-PHP-Closures-as-View-Helpers/#1YlhQ6GmEYUW2v6V.99

?>


<?php
//(MyApplication/DataHandlerInterface.php)
namespace MyApplication;

interface DataHandlerInterface
{
    /**
     * Write data to the storage
     */
    public function write($data);
   
    /**
     * Read data from the storage
     */
    public function read();  
}
//Read more at http://www.devshed.com/c/a/PHP/Using-PHP-Closures-as-View-Helpers/#1YlhQ6GmEYUW2v6V.99
?>

<?php 
//(MyApplication/View.php)

namespace MyApplication;

class View implements ViewInterface
{
    const DEFAULT_TEMPLATE_FILE = 'default_template.php';
    protected $_fields = array();
    protected $_templateFile;
   
    /**
     * Constructor
     */
    public function __construct(array $fields = array(), $templateFile = self::DEFAULT_TEMPLATE_FILE)
    {
        // optionally populate the view with an array of values
        if (!empty($fields)) {
            foreach ($fields as $field => $value) {
                $this->$field = $value;
            }
        }
        $this->setTemplateFile($templateFile);
    }
   
    /**
     * Set the view template file
     */
    public function setTemplateFile($templateFile)
    {
        if (!file_exists($templateFile) || !is_readable($templateFile)) {
            throw new InvalidArgumentException('The specified template file ' . $templateFile . ' is invalid.');
        }
        $this->_templateFile = $templateFile;
        return $this;
    }
   
    /**
     * Get the view template file
     */
    public function getTemplateFile()
    {
       return $this->_templateFile;
    }
   
    /**
     * Reset the template file to the default one
     */
    public function resetTemplateFile()
    {
        $this->_templateFile = self::DEFAULT_TEMPLATE_FILE;
        return $this;
    }
   
    /**
     * Assign a field to the view
     */
    public function set($name, $value)
    {
        return $this->__set($name, $value);
    }
   
    /**
     * Get the given field from the view
     */
    public function get($name)
    {
        return $this->__get($name);
    }
   
    /**
     * Check if the given field has been assigned to the view
     */
    public function exists($name)
    {
        return isset($this->_fields[$name]);
    }
   
    /**
     * Remove the given field from the view
     */
    public function remove($name)
    {
        if (isset($this->_fields[$name])) {
            unset($this->_fields[$name]);
        }
        return $this;
    }
      
    /**
     * Render the template file
     */
    public function render()
    {
        ob_start();
        include $this->_templateFile;
        return ob_get_clean();
    }
   
    /**
     * Assign the given field to the view via the '__set()' magic method
     */
    public function __set($name, $value)
    {
        $this->_fields[$name] = $value;
        return $this;
    }
   
    /**
     * Get the given field from the view via the '__get()' magic method
     */
    public function __get($name)
    {
        if (!isset($this->_fields[$name])) {
            throw new InvalidArgumentException('The specified view field ' . $name . ' does not exist.');
        }
        return (is_callable($this->_fields[$name]))
            ? $this->_fields[$name]($this)
            : $this->_fields[$name];   
    } 
}    
//Read more at http://www.devshed.com/c/a/PHP/Using-PHP-Closures-as-View-Helpers/1/#C7CtivrdAw7UzR4V.99

?>

<?php //(default_template.php)?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Using closures in PHP</title>
</head>
<body>
    <header>
        <h1>Header section</h1>
        <h2>Welcome! You're accessing this page from : <?php echo $this->clientIp;?></h2>
        <p><?php echo $this->header;?></p>
    </header>
    <section>
        <h2>Main section</h2>
        <p><?php echo $this->content;?></p>
    </section>
    <footer>
        <h2>Footer section</h2>
        <p><?php echo $this->footer;?></p>
    </footer>
</body>
</html>
<?php 
//Read more at http://www.devshed.com/c/a/PHP/Using-PHP-Closures-as-View-Helpers/1/#C7CtivrdAw7UzR4V.99
?>
<?php 

use MyApplicationView;

// include the autoloader and create an instance of it
require_once __DIR__ . '/Autoloader.php';
$autoloader = new Autoloader;

// create a view object and assign some properties to it
$view = new View;
$view->header = 'This is the content of the header section';
$view->content = 'This is the content of the main section';
$view->footer = 'This is the content of the footer section';

$view->clientIp = function() {
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
      return $_SERVER['REMOTE_ADDR'];
    }
};

// render the view template
echo $view->render();
//Read more at http://www.devshed.com/c/a/PHP/Using-PHP-Closures-as-View-Helpers/1/#C7CtivrdAw7UzR4V.99

?>

