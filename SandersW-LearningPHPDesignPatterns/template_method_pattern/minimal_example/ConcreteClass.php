<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConcreteClass
 *
 * @author Anit Shrestha
 */
include_once('AbstractClass.php');

class ConcreteClass extends AbstractClass {

	protected function addPix($pix) {
		$this->pix=$pix;
		$this->pix = "pix/" . $this->pix;
		$formatter = "<img src=$this->pix><br/>";
		echo $formatter;
	}

	protected function addCaption($cap) {
		$this->cap=$cap;
		echo "<em>Caption:</em>" . $this->cap . "<br/>";
	}
}
?>