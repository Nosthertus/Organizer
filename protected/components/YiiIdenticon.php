<?php 

Class YiiIdenticon extends Controller
{
	//Returns the data for html tag.
	public static function getImageDataUri($data, $size = 65, $color = null, $background = null)
	{
		$identicon = new Identicon;

		return $identicon->getImageDataUri($data, $size, $color, $background);
	}
	
	//Retuns the data.
	public static function getImageData($data, $size = 65, $color = null, $background = null)
	{
		$identicon = new Identicon;

		return $identicon->getImageData($data, $size, $color, $background);
	}
	
	//Returns the image.
	public static function displayImage($data, $size = 65, $color = null, $background = null)
	{
		$identicon = new Identicon;

		return $identicon->displayImage($data, $size, $color, $background);
	}
}

?>