<?php
class Malshare
{
	private $api_key;
	private $url = "https://malshare.com/";
	private $endpoint;

	//make a new malshare
	function __construct($key)
	{
		$this->api_key = $key;
	}

	//make a call to the API endpoint
	function makeCall($ep)
	{
		return file_get_contents($ep);
	}

	//api.php?api_key=[API_KEY]&action=getlist
	function listHashesJson()
	{
		$this->endpoint = "api.php?api_key=".$this->api_key."&action=getlist";
		return $this->makeCall($this->url.$this->endpoint);
	}

	//api.php?api_key=[API_KEY]&action=getlistraw
	function listHashesRaw()
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=getlistraw";
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=getsources
	function getSourcesJson()
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=getsources";
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=getsourcesraw
	function getSourcesRaw()
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=getsourcesraw";
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=getfile&hash=[HASH]
	function dlFile($hash)
	{
		$this->endpoint = "api.php?api_key=".$this->api_key."&action=getfile&hash=".$hash;
		file_put_contents($hash, fopen($this->url.$this->endpoint, 'r'));
	}

	///api.php?api_key=[API_KEY]&action=details&hash=[HASH]
	function getFileDetails($hash)
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=details&hash=".$hash;
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=type&type=[FILE TYPE]
	//types: md5|sha1|sha256
	function listHashesByType($type)
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=type&type=".$type;
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=search&query=[SEARCH QUERY]
	function search($q)
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=search&query=".$q;
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=gettypes
	function getTypes()
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=gettypes";
                return $this->makeCall($this->url.$this->endpoint);
	}

	///api.php?api_key=[API_KEY]&action=upload
	function upload($file)
	{
		$url = $this->url."api.php?api_key=".$this->api_key."&action=upload";

		$post_data = [
			"upload" => $file
		];

		$options = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $post_data
		];

		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$data = curl_exec($ch);
		return $data;
	}

	///api.php?api_key=[API_KEY]&action=getlimit
	function getLimit()
	{
                $this->endpoint = "api.php?api_key=".$this->api_key."&action=getlimit";
                return $this->makeCall($this->url.$this->endpoint);
	}
}
?>
