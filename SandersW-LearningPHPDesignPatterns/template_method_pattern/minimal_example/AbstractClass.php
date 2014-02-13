<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractClass
 *
 * @author Anit Shrestha
 */
abstract class AbstractClass {

	protected $pix;

	protected $cap;

	public function templateMethod($pixNow, $capNow) {
		$this->pix=$pixNow;
		$this->cap=$capNow;
		$this->addPix($this->pix);
		$this->addCaption($this->cap);
	}

	abstract protected function addPix($pix);

	abstract protected function addCaption($cap);

	}
?>