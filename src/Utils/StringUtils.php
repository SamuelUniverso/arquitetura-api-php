<?php

namespace Universum\Utils;

/**
 * Classe de utilitarios para diversas operacoes comuns realizadas com Strings
 * Também serve como referência documental do uso de funcoes nativas PHP
 * 
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
 * @since may-2022
 * @version 1.1
 */
class StringUtils
{
    /**
     * Encontra um padrao e retorna uma string e troca por outro
     * Input simples, apenas uma chave para um valor
     * 
     * @since 1.0
     * 
     * @method replacePattern
     * @param string $stream
     * @param string $find padrao a ser localizado
     * @param string $replace padrao para qual substituir
     */
    public static function replacePattern($stream, $find, $replace)
    {
        return str_replace($stream, $find, $replace);
    }

    /**
     * Encontra um padrao e retorna uma string e troca por outro
     * Rececebe uma string e substitui varios padroes mapeados no array
     * 
     * $map = ['localizar_valor' => 'substrituir_para'];
     * 
     * @since 1.1
     * 
     * @method replacePatternByMap
     * @param string $stream
     * @param array $map chave-valor para substituicao
     */
    public static function replacePatternByMap($stream, $map)
    {
        return strtr($stream, $map);
    }

    /**
     * Verifica se o padrao informado existe dentro da string
     * 
     * @since 1.0
     * 
     * @method isPattern
     * @param string $stream
     * @param string $find padrao a ser localizado
     */
    public static function isPattern($stream, $find)
    {
        return is_int(strpos($stream, $find));
    }

    /**
     * Reverte uma string no eixo horizontal
     * 
     * @since 1.0
     * 
     * @method reverse
     * @param string $stream
     */
    public static function reverse($stream)
    {
        return strrev($stream);
    }

    /**
     * Quebra uma string em um vetor de caracteres
     * 
     * @since 1.0
     * 
     * @method splitStringToCharArray
     * @param string $stream
     * @return string
     */
    public static function splitStringToCharArray($stream)
    {
        return str_split($stream);
    }
    
    /**
     * Diz em qual posicao da string o padrao informado ocorre (posicao inicial)
     * 
     * @since 1.0
     * 
     * @method findPatternPosition
     * @param string $stream string de input
     * @param string $find padrao a ser localizado
     * @param int $offset a partir de que ponto considerar
     * @return string
     */
    public static function findPatternPosition($stream, $find, $offset = 0)
    {
        return strpos($stream, $find, $offset);
    }

    /**
     * Verifica a iguladade de duas strings - Case Sensitive
     * 
     * @since 1.0
     * 
     * @method isEqual
     * @param string $leftHand stirng para comparar
     * @param string $rightHand string com a qual comprar
     * @return bool
     */
    public static function isEqual($leftHand, $rightHand)
    {
        return strcmp($leftHand, $rightHand) === 0 ? true : false;
    }
    /**
     * Convert string para "Titlecase'
     * 
     * @since 1.0
     * 
     * @method titleCase
     * @param string $stream
     * @return string
     */
    public static function titleCase($stream)
    {
        return ucfirst(mb_strtolower($stream));
    }

    /**
     * Convert string para "lowercase'
     * 
     * @since 1.0
     * 
     * @method lowerCase
     * @param string $stream
     * @return string
     */
    public static function lowerCase($stream)
    {
        return mb_strtolower($stream);
    }

    /**
     * Convert string para "UPPERCASE'
     * 
     * @since 1.0
     * 
     * @method upperCase
     * @param string $stream
     * @return string
     */
    public static function upperCase($stream)
    {
        return mb_strtoupper($stream);
    }    

    /**
     * Converte um char booleano para type booleano
     * 
     * @since 1.1
     * 
     * @method trueFalseCharToBoolean
     * @param string $boolean_char
     * @return boolean
     * @throws InvalidArgumentException
     */
    public static function trueFalseCharToBoolean($boolean_char)
    {
        switch($boolean_char)
        {
            case 'f': return false;
            case 'F': return false;
            case 'n': return false;
            case 'N': return false;
            case 't': return true;
            case 'T': return true;
            case 's': return true;
            case 'S': return true;

            default : throw new InvalidArgumentException("caractere informado nao e booleano");
        }
    }    

    /**
     * Converte um 'booleano' para caractere
     * 
     * @since 1.1
     * 
     * @method booleanToChar
     * @param boolean $boolean
     * @return string
     */
    public static function booleanToChar($boolean)
    {
        switch ($boolean)
        {
            case true: return 't';
            case false: return 'f';

            default : throw new InvalidArgumentException("parametro informado nao e booleano");
        }
    }

    /**
     * Remove sinais graficos de caracteres
     * 
     * @since 1.1
     * 
     * @method normalizeAccentedCharacters
     * @param string $string
     * @return string
     */
    public static function normalizeAccentedCharacters($string)
    {
        $replace_chars = [
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 
            'Þ'=>'B', 'ß'=>'Ss',
            'Ç'=>'C', 'ç'=>'c',
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'ð'=>'o', 'ñ'=>'n',
            'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'ù'=>'u', 'ú'=>'u', 'û'=>'u',
            'Ñ'=>'N',
            '?'=>'S', '?'=>'s', '?'=>'Z', '?'=>'z',
            'Ý'=>'Y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
        ];

        return strtr($string, $replace_chars);
    }

    /**
     * Converte chartset da string seguramente para UTF-8
     * 
     * @since 1.0
     * 
     * @method encodeStringToUTF8
     * @param string $stream
     * @return string
     */
    public static function encodeStringToUTF8($stream)
    {
        return mb_convert_encoding($stream, 'UTF-8', 'ISO-8859-1');
    }

    /**
     * Converte chartset da string seguramente para ISO-8859-1
     * 
     * @since 1.0
     * 
     * @method encodeStringToISO
     * @param string $stream
     * @return string
     */
    public static function encodeStringToISO($stream)
    {
        return mb_convert_encoding($stream, 'ISO-8859-1', 'UTF-8');
    }
}
