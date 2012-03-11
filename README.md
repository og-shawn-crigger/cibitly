Simple Bit.ly API Interface for CodeIgniter -> Still trying to figure out get tags sorry for any errors.
===========================================

NOTES
===========================================

This is a very small library providing only the functionality I needed at the time. I might expand on this later or
atleast show you how I use it.

[Check Here](http://s-vizion.com) for updates and other various CodeIgniter Things.

CONFIGURING
===========================================

You'll need a valid Bit.ly account to use this library.

If you already have an Bit.ly account, you can find your apiKey at: [http://bitly.com/a/your_api_key](http://bitly.com/a/your_api_key)

Setup your Login and API Key in the config file.


Usage Instructions Shorta
===========================================
```PHP
	/**
	 * Simple short method of using this.
	 *
	 */
	public function index()
	{
		// Load the rest client spark
		$this->load->spark('ci-bitly/0.0.3');


		$config = array('login'  => 'loginname','apikey' => 'yourapi');

		//This works as a library also if your not into the sparks thing.
		//$this->load->library('cibitly');

		// Run some setup
		$this->cibitly->initialize( $config );

		$url = 'http://blog.s-vizion.com/';

		$short = $this->cibitly->get_short_url ( $url );
		$long  = $this->cibitly->get_long_url ( $short );

		echo "Short URL : {$short} <br /> Long URL : ' , $long;

	}


