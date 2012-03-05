<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Bit.ly API Class
 *
 * Simple Class to Expand and Shorten URL's using Bit.ly's API
 *
 * @package        	CodeIgniter
 * @subpackage    	 Libraries
 * @category    	   Libraries
 * @author        	 Shawn Crigger <@svizion>
 * @created			      03/01/12
	* @link            http://s-vizion.com
 * @link												http://getsparks.org/packages/cibitly/show
 * @license         http://philsturgeon.co.uk/code/dbad-license
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
		public function __construct( $config = array() )
		{
				if ( count ( $config ) == 0 )
						return false;

				$this->bitly_url = ( array_key_exists('bitly_url', $config) && $config['bitly_url'] != '' ) ? $config['bitly_url'] : 'http://api.bit.ly/v3/';

				$this->login = 'login=' . $config['login'] . '&apiKey=' . $config['apikey'];

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
				$bitly_url = $this->bitly_url . 'shorten?' . $this->login . '&uri='.urlencode($url).'&format='.$format;

				return $this->curl_get_result($bitly_url);
		}

		/**
		 * Returns shortened URL and QR-Code using Bit.ly's Service.
		 *
		 * @access public
		 * @param		string		$url 	     The URL to shorten
		 * @param  string  $format    The Optional Return Format, values include 'xml', 'json' and 'txt'
		 *
		 * return  string  JSON encoded Bit.ly shortened url and qr-code
		 *
		 */
		public function get_short_qrcode ( $url, $format='txt' )
		{
				$bitly_url = $this->bitly_url . 'shorten?' . $this->login . '&uri='.urlencode($url).'&format='.$format;
				$bitly_url = $this->curl_get_result($bitly_url);

				$qr_code   = $bitly_url . '.qrcode';


				return json_encode( array('url' => $bitly_url, 'qr_code' => $qr_code ) );
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
		public function get_long_url ( $url, $login, $appkey, $format='txt' )
		{
				$bitly_url = $this->bitly_url . 'expand?' . $this->login . '&shortUrl='.urlencode($url).'&format='.$format;
				return $this->curl_get_result($bitly_url);
		}


		private function curl_get_result( $url = '' )
		{
				if ( trim ( $url ) == '' )
						return '';

				$ch      = curl_init();
				$timeout = 10;
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
				$data    = curl_exec($ch);
				curl_close($ch);
				return $data;

		}


}

/* End of file /libraries/bitly.php */
