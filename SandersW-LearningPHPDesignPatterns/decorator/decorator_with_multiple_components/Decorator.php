<?php
//Decorator.php
//Decorator participant
abstract class Decorator extends IComponent
{
public function setAge($ageNow)
{
$this->ageGroup=$this->ageGroup;
}
public function getAge()
{
return $this->ageGroup;
}
}