<?php

class Desconto
{
	public static $template = "<div class='desconto'> À vista %s: <b>%s</b> no boleto</div>";
	public static $moeda_da_loja = 'R$';
	public static $desconto = 0.10;


	/**
	 * @param      $preco
	 * @param null $special
	 * @param null $template
	 *
	 * @return void
	 */
	public static function e($preco, $special = NULL, $template = NULL)
	{
		echo self::calc($preco, $special, $template);
	}

	/**
	 * @param      $preco
	 * @param null $special
	 * @param null $template
	 *
	 * @return null|string
	 */
	public static function calc($preco, $special = NULL, $template = NULL)
	{
		$valor  = self::getPreco($preco, $special);
		$return = NULL;

		if ($valor > 0):
			$valorFinal  = self::getValorFinal($valor);
			$valorFinal = self::$moeda_da_loja . number_format($valorFinal, 2, ',', '.');
			$porcentagem = (self::$desconto * 100) . '%';
			$template    = (is_null($template)) ? self::$template : $template;

			$return = sprintf($template, $porcentagem, $valorFinal);
		endif;

		return $return;
	}

	/**
	 * @param $valor
	 *
	 * @return float
	 */
	private static function getDesconto($valor)
	{
		return ($valor * self::$desconto);
	}

	/**
	 * @param $valor
	 *
	 * @return float
	 */
	private static function getValorFinal($valor)
	{
		return $valor - self::getDesconto($valor);
	}

	/**
	 * @param      $preco
	 * @param null $special
	 *
	 * @return float
	 */
	private static function getPreco($preco, $special = NULL)
	{
		if (is_array($preco)):
			$special = $preco['special'];
			$preco   = $preco['price'];
		endif;

		if ($special):
			$preco = $special;
		endif;

		$numero = str_replace(',', '.', str_replace('.', '', str_replace(self::$moeda_da_loja, "", strip_tags($preco))));

		return $numero;
	}
}