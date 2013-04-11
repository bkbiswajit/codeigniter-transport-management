<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
Copyright (c) 2010 Prateek Rungta

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/**
* Css
* 
* Pre-processing utilities for Cascading Style Sheets
*
* @package      CodeIgniter
* @subpackage   Libraries
* @category     Css
* @author       Prateek Rungta
* @license      http://www.opensource.org/licenses/mit-license.php MIT License
* @link         http://prateekrungta.com/bitsnpieces/codeigniter-libraries#css
* @version      1.0
*/
class Css
{
	/**
	 * Minify CSS code
	 *
	 * @access  public
	 * @param   string  valid CSS code
	 * @return  string  minified CSS
	 */
	public function minify($style) {
		$style = preg_replace(array(
				'!/\*[^*]*\*+([^/][^*]*\*+)*/!' // comments
				,'/[^}{]+{\s*}/'                // empty rules
				,'/^\s*|\s*$/'                  // edge trim
			), '', $style);
		
		$style = preg_replace(array(
				'/[\n\t\r\s]+/'         // 1. redundant whitespace
				,'/\s*([>+{:,;}])\s*/'  // 2. whitespace around separators
			), array(
				' '                     // 1. single space
				,'$1'                   // 2. separators only
			), $style);
		
		// redundant ; and tidying up
		$style = str_replace(';}', "}\n", $style);
		
		return $style;
	}
	
	
	/**
	 * Prefix root-relative urls
	 *
	 * @access  public
	 * @param   string  valid CSS code
	 * @param   string  base url to be prefixed 
	 * @return  string  CSS with <base url> prefixed to URLs starting with '/'
	 */
	public function expandUrls($style, $base_url='') {
		
		// use config if base_url not specified
		if (!$base_url) {
			$CI =& get_instance();
			$base_url = $CI->config->item('base_url').$CI->config->item('index_page');
		}
		
		// sanitise base_url to include trailing slash
		if (strrpos($base_url, '/') != strlen($base_url)-1) $base_url .= '/';
		
		// prefix $base to root urls
		$style = str_replace(array( // str_replace over preg_replace for performance 
				'url(/'
				,"url('/"
				,'url("/'
			), array(
				'url('.$base_url
				,"url('".$base_url
				,'url("'.$base_url
			), $style);
		
		return $style;
	}

}


/* End of file */