<?php

class ErrorController extends BaseController {

	public function errorAction($exception) {
        echo '<pre>';
                    print_r($exception);
                    echo '</pre>';
                    exit;
	}
}
