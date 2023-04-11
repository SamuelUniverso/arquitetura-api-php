<?php

namespace Universum\Utils;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
 * @since december-2022
 * @version 1.1
 */
class StringBuilder
{
    private string $content;

    public function __construct($content = "")
    {
        $this->content = $content;
    }

    /**
     * @since 1.0
     * 
     * @method append
     * @param string $string
     * @return self
     */
    public function append($string)
    {
        $this->content .= $string;
        
        return $this;
    }

    /**
     * @since 1.0
     * 
     * @method length
     * @return string
     */
    public function length()
    {
        return strlen($this->content);
    }

    /**
     * @since 1.0
     * 
     * @method reverse
     * @return string
     */
    public function reverse()
    {
        return strrev($this->content);
    }

    /**
     * @since 1.0
     * 
     * @method getChars
     * @return array
     */
    public function getChars()
    {
        return str_split($this->content);
    }

    /**
     * @since 1.0
     * 
     * @method charAt
     * @param integer $position
     * @return string
     */
    public function charAt($position)
    {
        return substr($this->content, $position, 1);
    }

    /**
     * @since 1.0
     * 
     * @method setCharAt
     * @param integer $position
     * @param string $char
     * @return string
     */
    public function setCharAt($position, $char)
    {
        return $this->content = substr_replace($this->content, $char, $position, 1);
    }

    /**
     * @since 1.0
     * 
     * @method substring
     * @param integer $offset
     * @param integer $length
     */
    public function substring($offset, $length)
    {
        return substr($this->content, $offset, $length);
    }

    /**
     * @since 1.1
     *
     * @param string $variable
     * @param string $value
     * @return string
     */
    public function replace($find, $value)
    {
        return $this->content = str_replace($find, $value, $this->content);
    }

    /**
     * @since 1.0
     * 
     * @method __toString
     * @return string
     */
    public function __toString()
    {
        return trim($this->content); 
    }
}
