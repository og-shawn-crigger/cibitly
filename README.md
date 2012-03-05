Simple Bit.ly API Interface for CodeIgniter, First commit (whoop)
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


To Expand a URL 
===========================================

	$original_url = $this->input->post('url');
	$short_url    = $this->bitly->get_short_url ( $original_url )

To Expand a URL 
===========================================

	$original_url = $this->input->post('url');
	$long_url     = $this->bitly->get_long_url ( $original_url )
