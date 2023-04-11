<?php

namespace Universum\Utils;

use DateInterval;
use DateTime;

/**
 * Utilidades diversas para facilitar interacao com DateTime
 *
 * * const ISO : ISO-8601 Interational Standard  : "yyyy-mm-dd"
 * * const USA : United States Standard          : "mm-dd-yyyy"
 * * const BRE : Brazilian and European Standard : "dd-mm-yyyy"
 *
 * @author Samuel Obeger Rockenbach <samuel.rockenbach@univates.br>
 * @since may-2022
 * @version 1.4
 **/
class DateTimeUtils
{
    const ISO = 'ISO';
    const USA = 'USA';
    const BRE = 'BRE';

    const HIPHEN_DATE_SEPARATOR = '-';
    const SLASH_DATE_SEPARATOR  = '/';

    private const ISO_HIPHEN_FORMAT = 'Y-m-d';
    private const ISO_SLASH_FORMAT  = 'Y/m/d';
    private const USA_HIPHEN_FORMAT = 'm-d-Y';
    private const USA_SLASH_FORMAT  = 'm/d/Y';
    private const BRE_HIPHEN_FORMAT = 'd-m-Y';
    private const BRE_SLASH_FORMAT  = 'd/m/Y';

    /**
     * Adicioanr 'dias' a uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method addDaysToDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numDays quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function addDaysToDate($stringDate, $numDays, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->add(DateInterval::createFromDateString("{$numDays} days"))
                        ->format($formatter);
    }

    /**
     * Subtrair 'dias' de uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method subtractDaysFromDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numDays quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function subtractDaysFromDate($stringDate, $numDays, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->sub(DateInterval::createFromDateString("{$numDays} days"))
                        ->format($formatter);
    }

    /**
     * Adicionar 'meses' a uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method addMonthsToDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numMonths quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function addMonthsToDate($stringDate, $numMonths, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->add(DateInterval::createFromDateString("{$numMonths} months"))
                        ->format($formatter);
    }

    /**
     * Subtrair 'meses' de uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method subtractMonthsFromDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numMonths quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function subtractMonthsFromDate($stringDate, $numMonths, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->sub(DateInterval::createFromDateString("{$numMonths} months"))
                        ->format($formatter);
    }

    /**
     * Adicionar 'anos' a uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method addYearsToDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numYears quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function addYearsToDate($stringDate, $numYears, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->add(DateInterval::createFromDateString("{$numYears} years"))
                        ->format($formatter);
    }

    /**
     * Subtrair 'anos' de uma data
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method subtractYersFromDate
     * @param string $stringDate data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $numYears quantidade dias
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function subtractYersFromDate($stringDate, $numYears, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        return (new DateTime((string) $isoDate))
                    ->sub(DateInterval::createFromDateString("{$numYears} years"))
                        ->format($formatter);
    }

    /**
     * Se o comparando e igual ao 'comparado'
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.1
     * 
     * @method isDateEqualsThan
     * @param string $dateToCompare
     * @param string $dateCompared
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function isDateEqualsThan($dateToCompare, $dateCompared, $inputFormat)
    {
        $isoDate1 = self::convertDateFormat($dateToCompare, $inputFormat, self::ISO);
        $isoDate2 = self::convertDateFormat($dateCompared, $inputFormat, self::ISO);

        $date1 = (new DateTIme((string) $isoDate1));
        $date2 = (new DateTIme((string) $isoDate2));

        return $date1 == $date2;
    }

    /**
     * Se o 'comparando' e maior que o comparado
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method isDateGreaterThan
     * @param string $dateToCompare
     * @param string $dateCompared
     * @param string $inputFormat  : constantes da classe [ISO, USA, BRE]
     */
    public static function isDateGreaterThan($dateToCompare, $dateCompared, $inputFormat)
    {
        $isoDate1 = self::convertDateFormat($dateToCompare, $inputFormat, self::ISO);
        $isoDate2 = self::convertDateFormat($dateCompared, $inputFormat, self::ISO);

        $date1 = (new DateTIme((string) $isoDate1));
        $date2 = (new DateTIme((string) $isoDate2));

        return $date1 > $date2;
    }

    /**
     * Se o 'comparando' e maior ou igual ao 'comparado'
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.1
     * 
     * @method isDateGreaterEqualsThan
     * @param string $dateToCompare
     * @param string $dateCompared
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function isDateGreaterEqualsThan($dateToCompare, $dateCompared, $inputFormat)
    {
        $isoDate1 = self::convertDateFormat($dateToCompare, $inputFormat, self::ISO);
        $isoDate2 = self::convertDateFormat($dateCompared, $inputFormat, self::ISO);

        $date1 = (new DateTIme((string) $isoDate1));
        $date2 = (new DateTIme((string) $isoDate2));

        return $date1 >= $date2;
    }

    /**
     * Se o 'comparando' e menor que o 'comparado'
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.1
     * 
     * @method isDateLesserThan
     * @param string $dateToCompare
     * @param string $dateCompared
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function isDateLesserThan($dateToCompare, $dateCompared, $inputFormat)
    {
        $isoDate1 = self::convertDateFormat($dateToCompare, $inputFormat, self::ISO);
        $isoDate2 = self::convertDateFormat($dateCompared, $inputFormat, self::ISO);

        $date1 = (new DateTIme((string) $isoDate1));
        $date2 = (new DateTIme((string) $isoDate2));

        return $date1 < $date2;
    }

    /**
     * Se 'comparando' e menor ou igual ao 'comparado'
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.1
     * 
     * @method isDateLesserEqualsThan
     * @param string $dateToCompare
     * @param string $dateCompared
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function isDateLesserEqualsThan($dateToCompare, $dateCompared, $inputFormat)
    {
        $isoDate1 = self::convertDateFormat($dateToCompare, $inputFormat, self::ISO);
        $isoDate2 = self::convertDateFormat($dateCompared, $inputFormat, self::ISO);

        $date1 = (new DateTIme((string) $isoDate1));
        $date2 = (new DateTIme((string) $isoDate2));

        return $date1 <= $date2;
    }

    /**
     * Verifica se uma data esta num intervalo valido (ex: 31 de fevereiro)
     * * Retorna 'true' para datas valida e 'false' para datas invalidas
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method checkDateValidity
     * @param string $stringDate  : data em formato regional qualquer ['yyyy-mm-dd','dd-mm-yyyy','mm-dd-yyyy']
     * @param string $inputFormat : constantes da classe [ISO, USA, BRE]
     * @return boolean
     */
    public static function checkDateValidity($stringDate, $inputFormat)
    {
        $isoDate = self::convertDateFormat($stringDate, $inputFormat, self::ISO);
        $formatter = self::getDateFormatterForGivenDate($stringDate, $inputFormat);

        $dateCompare = (string) (new DateTime((string) $isoDate))->format($formatter);

        return strcmp($stringDate, $dateCompare) === 0 ? true : false;
    }

    /**
     * Reliza a conversao de uma string de data, em um formato regional para outro
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method convertDateFormat
     * @param string $stringDate date-string in any format
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     * @param string $outputFormat constantes da classe [ISO, USA, BRE]
     * @return string
     */
    public static function convertDateFormat($stringDate, $inputFormat, $outputFormat)
    {
        $separator = self::identifyDateSeparator($stringDate);
        $splittedDate = explode($separator, $stringDate);

        $isoDate = self::getInternationalDateFormatFromGivenDate($splittedDate, $inputFormat, $separator);

        return self::getDateInGivenFormatFromInternationalDateFormat($isoDate, $outputFormat, $separator);
    }

    /**
     * Adiciona os separadores em uma data ISO 8601 literal
     * * Formato e muito comum nas bases do Protheus/MicroSIGA
     * @example '20230101' => '2023/01/01'
     * 
     * @version may-2022
     * @since 1.2
     * 
     * @method addSeparatorsToISOLiteralDate
     * @param string $separator constantes da classe [HIPHEN_DATE_SEPARATOR, SLASH_DATE_SEPARATOR]
     * @return string
     */
    public static function addSeparatorsToISOLiteralDate($stringDate, $separator)
    {
        return substr($stringDate,6, 2).$separator.substr($stringDate,4, 2).$separator.substr($stringDate,0, 4);
    }

    /**
     * Pega a menor data dentro de uma lista
     * 
     * @author Samuel Obeger Rockenbach <samuel.rockenbach@univates.br>
     * @version february-2023
     * @since 1.4
     * 
     * @param array $list
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function getFirstDateFromList($list, $inputFormat)
    {
        usort(
            $list,
            function($previous, $current) use ($inputFormat) {
                return
                    new DateTime(TDateTimeUtils::convertDateFormat($previous, $inputFormat, TDateTimeUtils::ISO))
                    <=>
                    new DateTime(TDateTimeUtils::convertDateFormat($current, $inputFormat, TDateTimeUtils::ISO));
            }
        );

        return $list[0];
    }

    /**
     * Pega a maior data dentro de uma lista
     * 
     * @author Samuel Obeger Rockenbach <samuel.rockenbach@univates.br>
     * @version february-2023
     * @since 1.4
     * 
     * @param array $list
     * @param string $inputFormat constantes da classe [ISO, USA, BRE]
     */
    public static function getLastDateFromList($list, $inputFormat)
    {
        usort(
            $list,
            function($previous, $current) use ($inputFormat) {
                return
                    new DateTime(TDateTimeUtils::convertDateFormat($current, $inputFormat, TDateTimeUtils::ISO))
                    <=>
                    new DateTime(TDateTimeUtils::convertDateFormat($previous, $inputFormat, TDateTimeUtils::ISO));
            }
        );

        return $list[0];
    }

    /**
     * @method getCurrentTimestamp
     * @return string
     */
    public static function getCurrentTimestamp()
    {
        return (new DateTime())->format('Y-m-d H:i:s.v');
    }

    /**
     * Retorna data atual para formato informado
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.3
     * 
     * @method getCurrentDate
     * @param string $format constantes da classe [ISO, USA, BRE]
     * @param string $separator constantes da classe [HIPHEN_DATE_SEPARATOR, SLASH_DATE_SEPARATOR]
     * @param string 
     */
    public static function getCurrentDate($format, $separator)
    {
        return self::getDateInGivenFormatFromInternationalDateFormat((new DateTime())->format('Y-m-d'), $format, $separator);
    }

    /**
     * @method getCurrentYear
     * @return string
     */
    public static function getCurrentYear()
    {
        return (new DateTime())->format('Y');
    }

    /**
     * @method getCurrentMonth
     * @return string
     */
    public static function getCurrentMonth()
    {
        return (new DateTime())->format('m');
    }

    /**
     * @method getCurrentMonthNamePtBr
     * @return string
     */
    public static function getCurrentMonthNamePtBr()
    {
        switch(self::getCurrentMonth())
        {
            case 1 : return 'Janeiro';
            case 2 : return 'Fevereiro';
            case 3 : return 'Março';
            case 4 : return 'Abril';
            case 5 : return 'Maio';
            case 6 : return 'Junho';
            case 7 : return 'Julho';
            case 8 : return 'Agosto';
            case 9 : return 'Setembro';
            case 10: return 'Outubro';
            case 11: return 'Novembro';
            case 12: return 'Dezembro';
        }
    }

    /**
     * @method getCurrentDayOfMonth
     * @return string
     */
    public static function getCurrentDayOfMonth()
    {
        return (new DateTime())->format('d');
    }

    /**
     * @method getCurrentDayOfWeek
     * @return string
     */
    public static function getCurrentDayOfWeek()
    {
        return (new DateTime())->format('w');
    }

    /**
     * @method getCurrentDayOfWeekNamePtBr
     * @return string
     */
    public static function getCurrentDayOfWeekNamePtBr()
    {
        switch(self::getCurrentDayOfWeek())
        {
            case 0: return 'Domingo';
            case 1: return 'Segunda-feira';
            case 2: return 'Terça-feira';
            case 3: return 'Quarta-feira';
            case 4: return 'Quinta-feira';
            case 5: return 'Sexta-feira';
            case 6: return 'Sábado';
        }
    }

    /**
     * @method getCurrentTime
     * @return string
     */
    public static function getCurrentTime()
    {
        return (new DateTime())->format('H:i:s');
    }

    /**
     * @method getCurrentHour
     * @return string
     */
    public static function getCurrentHour()

    {
        return (new DateTime())->format('H');
    }

    /**
     * @method getCurrentMinute
     * @return string
     */
    public static function getCurrentMinute()
    {
        return (new DateTime())->format('i');
    }

    /**
     * @method getCurrentSecond
     * @return string
     */
    public static function getCurrentSecond()
    {
        return (new DateTime())->format('s');
    }

    /**
     * @method getCurrentMillisecond
     * @return string
     */
    public static function getCurrentMillisecond()
    {
        return (new DateTime())->format('v');
    }

    /**
     * Converte uma string string no formato regional para ISO-8601
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method getInternationalDateFormatFromGivenDate
     * @param string $stringDate    : ?? "yyyy-mm-dd" || "dd-mm-yyyy" || "mm-dd-yyyy"
     * @param string $outputFormat  : constantes da classe [ISO, USA, BRE]
     * @param string $separator     : constantes da classe [HIPHEN_DATE_SEPARATOR, SLASH_DATE_SEPARATOR]
     * @return string
     * @throws Exception
     */
    private static function getInternationalDateFormatFromGivenDate($splittedDate, $inputFormat, $separator)
    {
        if(empty($splittedDate) || is_null($inputFormat) || is_null($separator))
        {
            throw new InvalidArgumentException();
        }

        switch($inputFormat)
        {
            case self::BRE: return (string) ($splittedDate[2].$separator.$splittedDate[1].$separator.$splittedDate[0]);
            case self::USA: return (string) ($splittedDate[2].$separator.$splittedDate[0].$separator.$splittedDate[1]);
            case self::ISO: return (string) ($splittedDate[0].$separator.$splittedDate[1].$separator.$splittedDate[2]);

            default: throw new Exception("Error trying to convert Date to ISO-8601 international");
        }
    }

    /**
     * Retorna detecta o formatador adequado para data informada no parametros
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method getDateFormatterForGivenDate
     * @param string $stringDate
     * @param string $inputFormat
     * @return string
     * @throws Exception
     */
    public static function getDateFormatterForGivenDate($stringDate, $inputFormat)
    {
        switch (self::identifyDateSeparator($stringDate))
        {
            case self::HIPHEN_DATE_SEPARATOR:
            {
                switch ($inputFormat)
                {
                    case self::BRE: return self::BRE_HIPHEN_FORMAT;
                    case self::USA: return self::USA_HIPHEN_FORMAT;
                    case self::ISO: return self::ISO_HIPHEN_FORMAT;
                    default: break;
                }
            }
            case self::SLASH_DATE_SEPARATOR:
            {
                switch ($inputFormat)
                {
                    case self::BRE: return self::BRE_SLASH_FORMAT;
                    case self::USA: return self::USA_SLASH_FORMAT;
                    case self::ISO: return self::ISO_SLASH_FORMAT;
                    default: break;
                }
            }
            default: throw new Exception("Erro while trying to identify Date format");
        }
    }

    /**
     * Converte uma string de data ISO-8601 para outro formato
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method getDateInGivenFormatFromInternationalDateFormat
     * @param string $stringIsoDate "yyyy-mm-dd"
     * @param string $outputFormat constantes da classe [ISO, USA, BRE]
     * @param string $separator constantes da classe [HIPHEN_DATE_SEPARATOR, SLASH_DATE_SEPARATOR]
     * @return string
     */
    private static function getDateInGivenFormatFromInternationalDateFormat( $stringIsoDate
                                                                           , $outputFormat
                                                                           , $separator )
    {
        switch($separator)
        {
            case self::HIPHEN_DATE_SEPARATOR:
            {
                switch($outputFormat) 
                {
                    case self::ISO: return (new DateTime($stringIsoDate))->format(self::ISO_HIPHEN_FORMAT);
                    case self::USA: return (new DateTime($stringIsoDate))->format(self::USA_HIPHEN_FORMAT);
                    case self::BRE: return (new DateTime($stringIsoDate))->format(self::BRE_HIPHEN_FORMAT);
                    default: break;
                }
            }
            case self::SLASH_DATE_SEPARATOR:
            {
                switch($outputFormat)
                {
                    case self::ISO: return (new DateTime($stringIsoDate))->format(self::ISO_SLASH_FORMAT);
                    case self::USA: return (new DateTime($stringIsoDate))->format(self::USA_SLASH_FORMAT);
                    case self::BRE: return (new DateTime($stringIsoDate))->format(self::BRE_SLASH_FORMAT);
                    default: break;
                }
            }
            default: throw new Exception("Error while attempting to convert Date");
        }

        return (new DateTime($stringIsoDate))->format($outputFormat);
    }

    /**
     * Verifica o tipo de separador que esta sendo usado na data
     *
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version may-2022
     * @since 1.0
     * 
     * @method identifyDateSeparator
     * @param string $stringDate
     * @return string
     */
    private static function identifyDateSeparator($stringDate)
    {
        if(is_integer(strpos($stringDate, self::HIPHEN_DATE_SEPARATOR)))
            return self::HIPHEN_DATE_SEPARATOR;

        if(is_integer(strpos($stringDate, self::SLASH_DATE_SEPARATOR)))
            return self::SLASH_DATE_SEPARATOR;
    }
}
