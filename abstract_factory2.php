<?php

namespace Library\Helper;

class Validator
{
    private function __construct(){}
   
    /**
     * Validate an email address
     */
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);   
    }
   
    /**
     * Validate a URL
     */
    public static function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);  
    }
   
    /**
     * Validate a float number
     */
    public static function validateFloat($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    } 
   
    /**
     * Validate an integer number
     */ 
     public static function validateInteger($value)
     {
         return filter_var($value, FILTER_VALIDATE_INT);
     }     
}
//Read more at http://www.devshed.com/c/a/PHP/PHP-Effects-of-Wrapping-Code-in-Class-Constructs/#TAxCLtYVsdVRXVRp.99

// include the validator helper
//require_once __DIR__ . '/Helper/Validator.php';

use Library\Helper\Validator as Validator;

// validate a URL
if (!Validator::validateUrl('http://www.devshed.com')) {
    echo 'The supplied URL is invalid';
}

// validate an email address
if (!Validator::validateEMail('user@domain.com')) {
    echo 'The supplied email address is invalid.';
}

// validate a float number   
if (!Validator::validateFloat(2.5)) {
    echo 'The supplied value is an invalid float number.';
}

// validate an integer number
if (!Validator::validateInteger(10.5)) {
    echo 'The supplied value is an invalid integer number.';
}

/* displays the following

The supplied value is an invalid integer number.

*/
//Read more at http://www.devshed.com/c/a/PHP/PHP-Effects-of-Wrapping-Code-in-Class-Constructs/#TAxCLtYVsdVRXVRp.99

?>
<?php 


namespace Library\Helper;

interface ValidatorInterface
{
    /**
     * Validate the given value
     */
    public function validate(); 
}     
//Read more at http://www.devshed.com/c/a/PHP/PHP-Effects-of-Wrapping-Code-in-Class-Constructs/1/#3U5hfgYAl7RKFcHh.99


namespace Library\Helper;

abstract class AbstractValidator
{
    const DEFAULT_ERROR_MESAGE = 'The supplied value is invalid.';
    protected $_value;
    protected $_errorMessage = self::DEFAULT_ERROR_MESAGE;
   
    /**
     * Constructor
     */
    public function __construct($value = null, $errorMessage = null)
    {  
        if ($value !== null) {
            $this->setValue($value);
        }
        if ($errorMessage !== null) {
           $this->setErrorMessage($errorMessage);
        }
    }
   
    /**
     * Set the value to be validated
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }
   
     /**
     * Get the inputted value
     */
    public function getValue()
    {
        return $this->_value;
    }
     
    /**
     * Set the error message
     */
    public function setErrorMessage($errorMessage)
    {
        if (!is_string($errorMessage) || empty($errorMessage)) {
            throw new \InvalidArgumentException('The error message is invalid. It must be a non-empty string.');
        }
        $this->_errorMessage = $errorMessage;
    }
   
    /**
     * Get the error message
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }
   
    /**
     * Reset the error message to the default value
     */
    public function resetErrorMessage()
    {
        $this->_errorMessage = self::DEFAULT_ERROR_MESAGE;
    }       
}
//Read more at http://www.devshed.com/c/a/PHP/PHP-Effects-of-Wrapping-Code-in-Class-Constructs/1/#3U5hfgYAl7RKFcHh.99


?>