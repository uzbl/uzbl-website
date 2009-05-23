<?php
/**
 * Phatso - A PHP Micro Framework
 * Copyright (C) 2008, Judd Vinet <jvinet@zeroflux.org>
 *
 * Version 0.1 :: 2008-10-03
 *   - initial release
 * Version 0.2 :: 2009-04-30
 *   - optimizations by Woody Gilk <woody.gilk@kohanaphp.com>
 *   - auto-detect base web root for relative URLs
 *
 */

function debug($arg) {
	$args = func_get_args();
	echo '<pre>';
	foreach($args as $arg) {
		echo '(', gettype($arg), ') ', print_r($arg, TRUE)."<br/>\n";
	}
	echo '</pre>';
}

class Phatso
{
	var $template_layout = 'layout.php';
	var $template_vars   = array();
	var $web_root        = '';

	/**
	 * Dispatch web request to correct function, as defined by
	 * URL route array.
	 */
	function run($urls) {
		$ctrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		for($i = 0; $i <= strlen($ctrl); $i++) {
			if($ctrl{$i} != $_SERVER['SCRIPT_NAME']{$i}) break;
		}
		$this->web_root = substr($ctrl, 0, $i);
		$ctrl = trim(substr($ctrl, $i), '/').'/';
		if($ctrl{0} != '/') $ctrl = "/$ctrl";

		$action = '';
		$params = array();
		foreach($urls as $request=>$route) {
			if(preg_match('#^'.$request.'$#', $ctrl, $matches)) {
				$action = $route;
				if(!empty($matches[1])) {
					$params = explode('/', trim($matches[1], '/'));
				}
				break;
			}
		}

		if(!function_exists("exec_{$action}")) {
			$this->status('404', 'File not found');
		}
		call_user_func("exec_{$action}", $this, $params);
	}

	/**
	 * Set HTTP status code and exit.
	 */
	function status($code, $msg) {
		header("{$_SERVER['SERVER_PROTOCOL']} $code");
		die($msg);
	}

	/**
	 * Redirect to a new URL
	 */
	function redirect($url) {
		$url = $_SERVER['SCRIPT_NAME'].$url;
		header("Location: $url");
		die;
	}

	/**
	 * Set a template variable.
	 */
	function set($name, $val) {
		$this->template_vars[$name] = $val;
	}

	/**
	 * Render a template and return the content.
	 */
	function fetch($template_filename, $vars=array())
	{
		$vars = array_merge($this->template_vars, $vars);
		ob_start();
		extract($vars, EXTR_SKIP);
		require 'templates/'.$template_filename;
		return str_replace('/.../', $this->web_root, ob_get_clean());
	}

	/**
	 * Render a template (with optional layout) and send the
	 * content to the browser.
	 */
	function render($filename, $vars=array(), $layout='')
	{
		if(empty($layout)) $layout = $this->template_layout;
		if($layout) {
			$vars['CONTENT_FOR_LAYOUT'] = $this->fetch($filename, $vars);
			$filename = $layout;
		}
		echo $this->fetch($filename, $vars);
	}
}
