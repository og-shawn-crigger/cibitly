<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Bit.ly API Class
 *
 * Simple Class to Expand and Shorten URL's using Bit.ly's API.
 *
 * Please feel free to expand on this if you need to, for now this was all I needed of there API.
 *
 * @package        	CodeIgniter
 * @subpackage    	 Libraries
 * @category    	   Libraries
 * @author        	 Shawn Crigger <@svizion>
 * @created			      03/01/12
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link            http://s-vizion.com
 * @link												http://getsparks.org/packages/cibitly/show
 */
class cibitly {

	private $bitly_url;

	private $login;


	/**
	 * Constructor method for this small class, please pass login and apikey into class through config array.
	 *
	 * @param		array 		$config(
	 *                          'login'  => 'yourlogin',
	 *                          'apikey' => 'yourapykey',
	 *                         )
	 *
	 */
	public function __construct( )
	{
		$this->bitly_url = 'http://api.bit.ly/v3/';
	}

	public function initialize ( $config = array() )
	{
			$this->bitly_url = 'http://api.bit.ly/v3/';
	}

	/**
	 * Returns shortened URL using Bit.ly's Service.
	 *
	 * @access public
	 * @param		string		$url 	     The URL to shorten
	 * @param  string  $format    The Optional Return Format, values include 'xml', 'json' and 'txt'
	 *
	 * return  string  Bit.ly shortened url
	 *
	 */
	public function get_short_url ( $url, $format='txt' )
	{
		$bitly_url = $this->bitly_url . 'shorten?' . $this->login . '&amp;uri='.urlencode($url).'&amp;format='.$format;

		return $this->curl_get_result($bitly_url);
	}

	/**
	 * Returns expanded URL using Bit.ly's Service.
	 *
	 * @access public
	 * @param		string		$url 	     The URL to expand
	 * @param  string  $format    The Optional Return Format, values include 'xml', 'json' and 'txt'
	 *
	 * return  string  Bit.ly expanded url
	 *
	 */
	public function get_long_url ( $url, $format='txt' )
	{
		$bitly_url = $this->bitly_url . 'expand?' . $this->login . '&amp;shortUrl='.urlencode($url).'&amp;format='.$format;
		return $this->curl_get_result($bitly_url);
	}

	/**
	 * Returns curl response for request to Bit.ly, maybe later will add fallback method.
	 *
	 * @access private
	 *
	 */
	private function curl_get_result( $url = '' )
	{
		if ( trim ( $url ) == '' )
				return '';

		$ch      = curl_init();
		$timeout = 5;

		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);

		$data    = curl_exec($ch);

		curl_close($ch);

		return $data;

	}


}

/* End of file /libraries/bitly.php */
