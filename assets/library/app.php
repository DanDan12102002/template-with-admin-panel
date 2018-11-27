<?php defined('_JEXEC') or die; ?>
<?php
require "assets/config.php";
require "lessc.inc.php";
require 'cln.router.php';
require 'template.php';

class LandingPageAPP {
	public $scripts = '';
	public $meta = array();
	public $baseurl = '';
	public $route = '';
	public $config = '';
	
	function __construct ( $isAdminPanel = 0 ) {		
		if ( $isAdminPanel ) :
			$baseAdminUrl = self::getBaseUrl();
			$this->baseurl = str_replace( '/admin', '', $baseAdminUrl );
			self::GetScripts( $isAdminPanel );
			
			return;
		endif;
		
		$this->config = new AppConfig();
		$this->baseurl = self::getBaseUrl();
		
		if ( $this->config->DevMode ) :
			self::autoCompileLess('./assets/less/style.less', './assets/css/style.css');
		endif;
		
		self::GetScripts();
		
		# Get Route
		$this->route = $this->getRoute();
		
		return;
	}
	
	function loadTemplate() {
		$template = new Template();
		
		if ( $this->config->DevMode ) :
			return $template->render( $this, 'tmpl/'.$this->route['action'].'.php');
		else :
			$tmplFile = 'assets/cache/'.$this->route['action'].'.html';
		
			if ( file_exists( $tmplFile ) ) :
		
				return $template->render( $this, $tmplFile);
		
			else :
				$newTmplFilePath = 'assets/cache/'.$this->route['action'].'.html';
				$newTmplFile = fopen($newTmplFilePath, "w") or die("Unable to open\create html cache file! Check folder permission: assets/cache/");
		
				ob_start();
					$template->render( $this, 'tmpl/'.$this->route['action'].'.php');
		
					$renderedTmpl = ob_get_contents(); 
				ob_end_clean();
		
				if ( $this->config->OptimizeScripts ) :
					$renderedTmpl = $this->optimizeHtml( $renderedTmpl );
				endif;

				fwrite($newTmplFile, $renderedTmpl);
				fclose($newTmplFile);
				
				return $template->render( $this, $newTmplFilePath);
		
			endif;
		endif;
	}
	
	function clearUrlParams( $url ) {
		if ( strpos($url, '?' ) !== false) :
			$u = explode( '?', $url );
			$url = $u[0];
		endif;
		
		if ( strpos($url, 'index.php' ) !== false || strpos($url, 'index.html' ) !== false ) :
			$url = dirname($url);
		endif;

		return $url;
	}
	
	function getRoute() {
		$router = new ClnRouter('./assets/routelist/routing.xml');
		
		$indexUrlBase = dirname( $_SERVER['SCRIPT_NAME'] );
		
		$hasQuery = 0;
		if ( $_SERVER['QUERY_STRING'] ) :
			$hasQuery = 1;
		else :
			#
		endif;
		
		$requestUrl = $this->clearUrlParams( $_SERVER['REQUEST_URI'], $hasQuery );
		$urlForRoute = str_replace($indexUrlBase, '', $requestUrl );
		
		$route = $router->get($urlForRoute);
		
		return $route;
	}
	
	function autoCompileLess($inputFile, $outputFile) {
	  // load the cache
	  $cacheFile = $inputFile.".cache";

	  if (file_exists($cacheFile)) {
		$cache = unserialize(file_get_contents($cacheFile));
	  } else {
		$cache = $inputFile;
	  }

	  $less = new lessc;
	  $newCache = $less->cachedCompile($cache);

	  if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
		file_put_contents($cacheFile, serialize($newCache));
		file_put_contents($outputFile, $newCache['compiled']);
	  }
	}

	function getBaseUrl() {
		// Determine if the request was over SSL (HTTPS).
		if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off'))
		{
			$https = 's://';
		}
		else
		{
			$https = '://';
		}

		/*
		 * Since we are assigning the URI from the server variables, we first need
		 * to determine if we are running on apache or IIS.  If PHP_SELF and REQUEST_URI
		 * are present, we will assume we are running on apache.
		 */

		if (!empty($_SERVER['PHP_SELF']) && !empty($_SERVER['REQUEST_URI']))
		{
			// To build the entire URI we need to prepend the protocol, and the http host
			// to the URI string.
			$indexUrlBase = dirname( $_SERVER['SCRIPT_NAME'] );
			
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $indexUrlBase;
		}
		else
		{
			/*
			 * Since we do not have REQUEST_URI to work with, we will assume we are
			 * running on IIS and will therefore need to work some magic with the SCRIPT_NAME and
			 * QUERY_STRING environment variables.
			 *
			 * IIS uses the SCRIPT_NAME variable instead of a REQUEST_URI variable... thanks, MS
			 */
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'];
		}

		// Extra cleanup to remove invalid chars in the URL to prevent injections through the Host header
		$theURI = str_replace(array("'", '"', '<', '>', '\\'), array("%27", "%22", "%3C", "%3E", ""), $theURI);

		return $theURI;
	}
	
	function GetScripts( $isAdminPanel = 0 ) {
		if ( $isAdminPanel ) :
			$file = '../assets/includes.xml';
		else :
			$file = './assets/includes.xml';
		endif;
		
		if ( file_exists($file) && $this->config->DevMode ) {
			$cssHtml = '';
			$jsHtml = '';
			
			$css = array();
			$js = array();
			
			$xml = simplexml_load_file($file);
			$scripts = $xml->scripts;
			$stylesheets = $xml->stylesheets;
			
				
			$cssFile = 'assets/cache/style.css';
			$jsFile = 'assets/cache/scripts.js';

			# Merge Css --------------
			$newCssFile = fopen($cssFile, "w") or die("Unable to open\create css cache file! Check folder permission: assets/cache/");
			$allCssCode = '';

			if ( count($stylesheets->file) ) {
				foreach ( $stylesheets->file as $file ) {
					$allCssCode .= file_get_contents( $this->baseurl.$file->__toString() )."\n";
				}
			}
			
			if ( $this->config->OptimizeScripts ) :
				$allCssCode = $this->optimizeCss( $allCssCode );
			endif;

			fwrite($newCssFile, $allCssCode);
			fclose($newCssFile);

			
			# Merge Js --------------
			$newJsFile = fopen($jsFile, "w") or die("Unable to open\create js cache file! Check folder permission: assets/cache/");
			$allJsCode = '';

			if ( count($scripts->file) ) {
				foreach ( $scripts->file as $file ) {
					$allJsCode .= file_get_contents( $this->baseurl.$file->__toString() )."\n";
				}
			}
			
			/*if ( $this->config->OptimizeScripts ) :
				$allJsCode = $this->optimizeJs( $allJsCode );
			endif;*/

			fwrite($newJsFile, $allJsCode);
			fclose($newJsFile);


			$this->scripts->css = array($cssFile);
			$this->scripts->cssHtml = '<link rel="stylesheet" href="'.$this->baseurl.'/'.$cssFile.'?t='.date('U').'" type="text/css" />';
			$this->scripts->js = array($jsFile);
			$this->scripts->jsHtml = '<script src="'.$this->baseurl.'/'.$jsFile.'"></script>';

			return;

		} else {
			$cssFile = 'assets/cache/style.css';
			$jsFile = 'assets/cache/scripts.js';
			
			$this->scripts->css = array($cssFile);
			$this->scripts->cssHtml = '<link rel="stylesheet" href="'.$this->baseurl.'/'.$cssFile.'?t='.date('U').'" type="text/css" />';
			$this->scripts->js = array($jsFile);
			$this->scripts->jsHtml = '<script src="'.$this->baseurl.'/'.$jsFile.'"></script>';
			
			return;
		}
	}
	
	function optimizeHtml ( $code ) {
		$buffer = $code;
		
		$search = array(
			'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
			'/[^\S ]+\</s',     // strip whitespaces before tags, except space
			'/(\s)+/s',         // shorten multiple whitespace sequences
			'/<!--(.|\s)*?-->/' // Remove HTML comments
		);

		$replace = array(
			'>',
			'<',
			'\\1',
			''
		);

		$buffer = preg_replace($search, $replace, $buffer);

		return $buffer;
	}
	
	function optimizeCss ( $code ) {
		$buffer = $code;
		
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(["\r\n","\r","\n","\t",'  ','    ','     '], '', $buffer);
		$buffer = preg_replace(['(( )+{)','({( )+)'], '{', $buffer);
		$buffer = preg_replace(['(( )+})','(}( )+)','(;( )*})'], '}', $buffer);
		$buffer = preg_replace(['(;( )+)','(( )+;)'], ';', $buffer);

		return $buffer;
	}
	
	function optimizeJs ( $code ) {
		$buffer = $code;

		$buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
		$buffer = str_replace(["\r\n","\r","\t","\n",'  ','    ','     '], '', $buffer);
		$buffer = preg_replace(['(( )+\))','(\)( )+)'], ')', $buffer);
		
		return $buffer;
	}
	
	function getField( $fields, $name ) {		
		foreach( $fields as $field ) :
			if( $field['name'] == $name ) :
				return $field['value'];
			endif;
		endforeach;
	}
}