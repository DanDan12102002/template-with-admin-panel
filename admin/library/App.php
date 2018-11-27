<?php
defined('_JEXEC') or die;

class LandingPageAPP {
	public $scripts = '';
	public $meta = array();
	public $basedir = '';
	public $baseurl = '';
	public $siteurl = '';
	public $isUserLoggedIn = 0;
	public $isUserAdmin = 0;
	
	function __construct() {		
		$this->baseurl = $this->getBaseUrl();
		$this->siteurl = $this->getBaseUrl( 1 );
		
		$this->isUserLoggedIn = Auth::isUserLoggedIn();
		$this->isUserAdmin = Auth::isUserAdmin();
		
		$this->AutoCompileLess('./assets/less/style.less', './assets/css/style.css');
		
		$this->GetScripts();
		
		return;
	}
	
	function AutoCompileLess($inputFile, $outputFile) {
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

	function getBaseUrl( $isSiteUrl = 0 ) {
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
			
			// If we want to get a site base link
			if ( $isSiteUrl ) {
				$indexUrlBase = str_replace('/admin','',$indexUrlBase);
			}
			
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
		$file = 'assets/includes.xml';
		
		if ( file_exists($file) ) {
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
					if ( file_exists($file->__toString()) ) {
						$allCssCode .= file_get_contents( $file->__toString() )."\n\n\n";
					}
				}
			}

			fwrite($newCssFile, $allCssCode);
			fclose($newCssFile);

			
			# Merge Js --------------
			$newJsFile = fopen($jsFile, "w") or die("Unable to open\create js cache file! Check folder permission: assets/cache/");
			$allJsCode = '';

			if ( count($scripts->file) ) {
				foreach ( $scripts->file as $file ) {
					if ( file_exists($file->__toString()) ) {
						$allJsCode .= file_get_contents( $file->__toString() )."\n\n\n";
					}
				}
			}

			fwrite($newJsFile, $allJsCode);
			fclose($newJsFile);


			$this->scripts->css = array($cssFile);
			$this->scripts->cssHtml = '<link rel="stylesheet" href="'.$this->baseurl.'/'.$cssFile.'" type="text/css">';
			$this->scripts->js = array($jsFile);
			$this->scripts->jsHtml = '<script src="'.$this->baseurl.'/'.$jsFile.'"></script>';

			return;
		}
	}
	
	public function redirect( $url ) {
		if ( $url ) :
			header( "Location: " . $url );
			die();
		endif;
	}
}