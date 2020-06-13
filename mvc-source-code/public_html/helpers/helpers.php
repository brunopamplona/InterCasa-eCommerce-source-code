<?php

class StringHelper
{
	/**
	 * @param string $string
	 *
	 * @return bool
	 */
	public static function isKit($string)
	{
		$ini = strtolower(substr($string, 0, 3));

		return ($ini == 'kit');
	}
}