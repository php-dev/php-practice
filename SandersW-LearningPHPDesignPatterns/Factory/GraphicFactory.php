<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//GraphicFactory.php
include_once('Creator.php');
include_once('GraphicProduct.php');

class GraphicFactory extends Creator {

	protected function factoryMethod() {
		$product=new GraphicProduct();
		return($product->getProperties());
	}

}