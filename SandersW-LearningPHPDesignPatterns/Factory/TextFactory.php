<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('Creator.php');
include_once('TextProduct.php');

class TextFactory extends Creator {

	protected function factoryMethod() {
		$product=new TextProduct();
		return($product->getProperties());
	}

}

