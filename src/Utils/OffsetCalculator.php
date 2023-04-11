<?php

namespace Universum\Utils;

/**
 * Calcula o 'offset' e 'limit' para o SQL em uma chamada ao banco
 * Tambem pode calcular ranges de 'inicio' e 'fim', em intervlaos segmentados
 * Existem casos em que a chamada SQL pode trazer registros demais e pode sobrecarregar a memoria do sistema
 * Sao calculados intervalos que podem ser parametrizados para chamadas SQL
 * 
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since april-2022
 * @version 1.0
 */
class OffsetCalculator
{
    /**
     * Calcular 'offset' e 'limit'
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
     * @since april-2022
     * 
     * @method calculateOffsetAndLimit
     * @param integer $absoluteBegin : inicio absoluto do segmento
     * @param integer $absoluteEnd : final absoluto do segmento
     * @param integer $rangeLenght : intervalo a segmentar
     * @return object[]
     */
    public static function calculateOffsetsAndLimits( $absoluteBegin = 0
                                                    , $absoluteEnd = 10000
                                                    , $rangeLenght = 1000 )
    {
        $offsets = self::offsetCalculator($absoluteBegin, $absoluteEnd, $rangeLenght);
        
        $ranges = [];
        array_walk($offsets, function($item, $key) use (&$ranges)
            { 
                $ranges[$key] = new stdClass;
                $ranges[$key]->offset = $item['offset'];
                $ranges[$key]->limit  = $item['limit'];
            } 
        );

        return $ranges;
    }

    /**
     * Calcular 'begin' e 'end' de cada intervalo
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
     * @since april-2022
     * 
     * @method calculateOffsetAndLimit
     * @param integer $absoluteBegin : inicio absoluto do segmento
     * @param integer $absoluteEnd : final absoluto do segmento
     * @param integer $rangeLenght : intervalo a segmentar
     * @return object[]
     */
    public static function calculateBeginEndIntervals( $absoluteBegin = 0
                                                     , $absoluteEnd = 10000
                                                     , $rangeLenght = 1000 )
    {
        $offsets = self::offsetCalculator($absoluteBegin, $absoluteEnd, $rangeLenght);
        
        $ranges = [];
        array_walk($offsets, function($item, $key) use (&$ranges)
            { 
                $ranges[$key] = new stdClass;
                $ranges[$key]->begin = $item['ini_interval'];
                $ranges[$key]->end   = $item['end_interval'];
            } 
        );

        return $ranges;
    }
    
    /**
     * Algoritmo que fornece os intervalos calculados para as demais funcoes
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
     * @since december-2021
     * 
     * @method offsetCalculator
     * @param integer $absoluteBegin : inicio do lote
     *  @example lote comeca em 0
     * @param integer $absoluteEnd : final do lote
     *  @example lote termina em 10K
     * @param integer $rangeLenght tamanho de cada segmento
     *  @example 1K dentro de cada segmento
     * @return array
     *  @example [[offsetIni, offsetEnd]]
     *  @example [[0,99], [100,199], [200,299], [...]]
     */
    private static function offsetCalculator( $absoluteBegin = 0
                                            , $absoluteEnd   = 10000
                                            , $rangeLenght   = 1000 )
    {
        $offsetControl = [];
        try
        {
            $offset = $absoluteBegin;

            for($offset; $offset < $absoluteEnd; $offset += $rangeLenght)
            {
                if(($offset - $rangeLenght) == 0)
                {
                    $offsetIni = $absoluteBegin;
                    $offsetEnd = ($rangeLenght - 1);

                    ## setp 1. ##
                    array_push($offsetControl, [ 'ini_interval'   => $offsetIni
                                               , 'end_interval'   => $offsetEnd
                                               , 'offset'         => $offsetIni
                                               , 'limit'          => $rangeLenght
                                               , 'absolute_begin' => $absoluteBegin
                                               , 'absolute_end'   => $absoluteEnd
                                               ]);
                }
                else if(($offset - $rangeLenght) >= 1)
                {
                    $offsetIni = ($offset - $rangeLenght);
                    $offsetEnd = ($offset - 1);

                    ## setp 2. ##
                    array_push($offsetControl, [ 'ini_interval'   => $offsetIni
                                               , 'end_interval'   => $offsetEnd
                                               , 'offset'         => $offsetIni
                                               , 'limit'          => $rangeLenght
                                               , 'absolute_begin' => $absoluteBegin
                                               , 'absolute_end'   => $absoluteEnd
                                               ]);
                }
                else
                {
                    $offsetIni = ($absoluteEnd - $rangeLenght);
                    $offsetEnd = $absoluteEnd;

                    ## setp 3. ##
                    $offsetAppend = [ 'ini_interval'   => $offsetIni
                                    , 'end_interval'   => $offsetEnd
                                    , 'offset'         => $offsetIni
                                    , 'limit'          => $rangeLenght
                                    , 'absolute_begin' => $absoluteBegin
                                    , 'absolute_end'   => $absoluteEnd
                                    ];
                }
            }

            ## step 4. ##
            array_push($offsetControl, $offsetAppend);
        }
        catch(Throwable $e)
        {
            throw new OutOfBoundsException('Nao foi possivel calcular Offset');
        }

        return $offsetControl;
    }
}
