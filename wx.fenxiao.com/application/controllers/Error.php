<?php

class ErrorController extends Yaf_Controller_Abstract {

	public function errorAction($exception) {
        echo '<pre>';
        print_r($exception);
        echo '</pre>';
        exit;
	}
}
