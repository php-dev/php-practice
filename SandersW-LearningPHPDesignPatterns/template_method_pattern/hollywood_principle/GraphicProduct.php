<?php
//GraphicProduct.php
class GraphicProduct implements Product {

	private $mfgProduct;

	public function getProperties() {
	$this->mfgProduct="<img src='../pix/genious.jpg'>";
	return $this->mfgProduct;
	}

}
?>