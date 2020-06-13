<?php

class Parcelamento
{
	public static $templateBreakLine = "<div class='percela'> %sx de <b>%s</b><br>%s</div>";
	public static $template = "<div class='percela inline'> %sx de <b>%s</b> %s</div>";
	public static $qtd_parcelas = 4;
	public static $juros = 0;
	public static $moeda_da_loja = 'R$';
	public static $tipo_de_calculo = 0;
	public static $parcela_minima = 5.00;
	public static $current_qtd_parcelas = 0;

	/**
	 * @param      $preco
	 * @param null $special
	 */
	public static function e($preco, $special = NULL)
	{
		echo self::calc($preco, $special);
	}

	/**
	 * @param      $preco
	 * @param null $special
	 *
	 * @return null|string
	 */
	public static function calc($preco, $special = NULL, $template = NULL)
	{
		$valor  = self::getPreco($preco, $special);
		$return = NULL;

		if ($valor > 0):
			if (self::$tipo_de_calculo == 0):
				$parcela = self::calcSimples($valor);
			else:
				$parcela = self::calcComposto($valor);
			endif;

			$parcela = self::$moeda_da_loja . number_format($parcela, 2, ',', '.');

			if (self::$juros == 0):
				$jurosMsg = 'sem juros';
			else:
				$jurosMsg = 'com juros de ' . self::$juros . '%  ao m&ecirc;s';
			endif;

			$template = (is_null($template)) ? self::$template : $template;

			$return = sprintf($template, self::$current_qtd_parcelas, $parcela, $jurosMsg);
		endif;

		return $return;
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

	/**
	 * @param $valor
	 *
	 * @return float
	 */
	private static function calcSimples($valor)
	{
		self::$current_qtd_parcelas = self::$qtd_parcelas;
		$valor_total                = ($valor * pow(1 + (self::$juros / 100), self::$current_qtd_parcelas));
		$max_parcelas               = intval($valor_total / self::$parcela_minima);
		if ($max_parcelas < self::$current_qtd_parcelas):
			self::$current_qtd_parcelas = $max_parcelas;
		endif;

		$valor_parcela = $valor_total / self::$current_qtd_parcelas;

		return $valor_parcela;
	}

	/**
	 * @param $valor
	 *
	 * @return float
	 */
	private static function calcComposto($valor)
	{
		self::$current_qtd_parcelas = self::$qtd_parcelas;

		$valor_total  = ($valor * (self::$juros / 100));
		$max_parcelas = intval($valor_total / self::$parcela_minima);
		if ($max_parcelas < self::$current_qtd_parcelas):
			self::$current_qtd_parcelas = $max_parcelas;
		endif;

		$valor_parcela = $valor_total / (1 - (1 / (pow(1 + (self::$juros / 100), self::$current_qtd_parcelas))));

		return $valor_parcela;
	}

	/**
	 * @param      $preco
	 * @param null $special
	 */
	public static function enl($preco, $special = NULL)
	{
		echo self::calc($preco, $special, self::$templateBreakLine);
	}

}