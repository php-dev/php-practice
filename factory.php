<?php 
// define abstract 'ArrayFactory' class
abstract class ArrayFactory{
   abstract public function createArrayObj($type);
}

// define concrete factory to create numerically-indexed array
//objects
class NumericArrayFactory extends ArrayFactory{
   private $context='numeric';
   public function createArrayObj($type){
     $arrayObj=NULL;
     switch($type){
       case "uppercase";
         $arrayObj=new UppercasedNumericArrayObj();
         break;
       case "lowercase";
         $arrayObj=new LowercasedNumericArrayObj();
         break;
       default:
         $arrayObj=new LowercasedNumericArrayObj();
         break; 
     }
     return $arrayObj;
   }
}

// define concrete factory to create associative array objects
class AssociativeArrayFactory extends ArrayFactory{
   private $context='associative';
   public function createArrayObj($type){
     $arrayObj=NULL;
     switch($type){
       case "uppercase";
         $arrayObj=new UppercasedAssociativeArrayObj();
         break;
       case "lowercase";
         $arrayObj=new LowercasedAssociativeArrayObj();
         break;
       default:
         $arrayObj=new LowercasedAssociativeArrayObj();
         break; 
     }
     return $arrayObj;
   }
}

//Read more at http://www.devshed.com/c/a/PHP/The-Basics-of-Using-the-Factory-Pattern-in-PHP-5/1/#KfCG3oZHYm5v2OUE.99

// define abstract 'ArrayObj' class
abstract class ArrayObj{
   abstract public function getArraySize();
   abstract public function getArrayElements();
}

// define concrete 'UppercasedNumericArrayObj' class
class UppercasedNumericArrayObj extends ArrayObj{
   private $inputArray=array('Element 1','Element 2','Element
3');
   public function getArraySize(){
     return count($this->inputArray);
   }
   public function getArrayElements(){
     return array_map(strtoupper,$this->inputArray);
   }
}

// define concrete 'LowercasedNumericArrayObj' class
class LowercasedNumericArrayObj extends ArrayObj{
   private $inputArray=array('ELEMENT 1','ELEMENT 2','ELEMENT
3');
   public function getArraySize(){
     return count($this->inputArray);
   }
   public function getArrayElements(){
     return array_map(strtolower,$this->inputArray);
   }
}

// define concrete 'UppercasedAssociativecArrayObj' class
class UppercasedAssociativeArrayObj extends ArrayObj{
   private $inputArray=array('Element 1'=>'This is element
1','Element 2'=>'This is element 2','Element 3'=>'This is element
3');
   public function getArraySize(){
     return count($this->inputArray);
   }
   public function getArrayElements(){
     return array_map(strtoupper,$this->inputArray);
   }
}

// define concrete 'LowercasedAssociativecArrayObj' class
class LowercasedAssociativeArrayObj extends ArrayObj{
   private $inputArray=array('ELEMENT 1'=>'THIS IS ELEMENT
1','ELEMENT 2'=>'THIS IS ELEMENT 2','ELEMENT 3'=>'THIS IS ELEMENT
3');
   public function getArraySize(){
     return count($this->inputArray);
   }
   public function getArrayElements(){
     return array_map(strtolower,$this->inputArray);
   }
}
//Read more at http://www.devshed.com/c/a/PHP/The-Basics-of-Using-the-Factory-Pattern-in-PHP-5/2/#josG1Ho56KgIFw8X.99

// testing 

try{
   // create lowercased numeric array object
   $lowerNumArray=NumericArrayFactory::createArrayObj
('lowercase');
   // display array object size
   echo 'Number of elements of lowercased numeric array is the
following : '.$lowerNumArray->getArraySize();

   /*
   displays the following:
   Number of elements of lowercased numeric array is the
following : 3
   */

   // display array object elements
   print_r($lowerNumArray->getArrayElements());

   /*
   displays the following
   Array ( [0] => element 1 [1] => element 2 [2] => element 3 )
   */

   // create uppercased numeric array object
   $upperNumArray=NumericArrayFactory::createArrayObj
('uppercase');
   // display array object size
   echo 'Number of elements of uppercased numeric array is the
following : '.$upperNumArray->getArraySize();

   /*
   displays the following:
   Number of elements of uppercased numeric array is the
following : 3
   */

   // display array object elements
   print_r($upperNumArray->getArrayElements());

   /*
   displays the following
   Array ( [0] => ELEMENT 1 [1] => ELEMENT 2 [2] => ELEMENT 3 )
   */

   // create lowercased associative array object
   $lowerAssocArray=AssociativeArrayFactory::createArrayObj
('lowercase');
   // display array object size
   echo 'Number of elements of lowercased associative array is
the following : '.$lowerAssocArray->getArraySize();

   /*
   displays the following:
   Number of elements of lowercased associative array is the
following : 3
   */

   // display array object elements
   print_r($lowerAssocArray->getArrayElements());

   /*
   displays the following
   Array ( [ELEMENT 1] => this is element 1 [ELEMENT 2] => this
is element 2 [ELEMENT 3] => this is element 3 )
   */

   // create uppercased associative array object
   $upperAssocArray=AssociativeArrayFactory::createArrayObj
('uppercase');
   // display array object size
   echo 'Number of elements of uppercased associative array is
the following : '.$upperAssocArray->getArraySize();

   /*
   displays the following:
   Number of elements of uppercased associative array is the
following : 3
   */

   // display array object elements
   print_r($upperAssocArray->getArrayElements());

   /*
   displays the following
   Array ( [Element 1] => THIS IS ELEMENT 1 [Element 2] => THIS
IS ELEMENT 2 [Element 3] => THIS IS ELEMENT 3 )
   */
}

catch(Exception $e){
   throw $e->getMessage();
   exit();
}
//Read more at http://www.devshed.com/c/a/PHP/The-Basics-of-Using-the-Factory-Pattern-in-PHP-5/3/#LFWVuMjAfLiLkE7w.99



?>