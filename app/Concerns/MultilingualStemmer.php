<?php

namespace App\Concerns;

use TeamTNT\TNTSearch\Stemmer\PorterStemmer;
use TeamTNT\TNTSearch\Stemmer\Stemmer;

/**
 * This is a reimplementation of AR-PHP Arabic stemmer.
 * The original author is Khaled Al-Sham'aa <khaled@ar-php.org>
 */

class MultilingualStemmer implements Stemmer
{
  private static $_arabicStemmer;
  private static $_englishStemmer;

  public function __construct()
  {
    self::$_arabicStemmer = new NewStemmer();
    self::$_englishStemmer = new PorterStemmer();
  }

  public static function identify($str)
    {
        $minAr  = 55436;
        $maxAr  = 55698;
        $probAr = false;
        $arFlag = false;
        $arRef  = array();
        $max    = strlen($str);

        $i = -1;
        while (++$i < $max) {
            $cDec = ord($str[$i]);

            // ignore ! " # $ % & ' ( ) * + , - . / 0 1 2 3 4 5 6 7 8 9 :
            // If it come in the Arabic context
            if ($cDec >= 33 && $cDec <= 58) {
                continue;
            }

            if (!$probAr && ($cDec == 216 || $cDec == 217)) {
                $probAr = true;
                continue;
            }

            if ($i > 0) {
                $pDec = ord($str[$i - 1]);
            } else {
                $pDec = null;
            }

            if ($probAr) {
                $utfDecCode = ($pDec << 8) + $cDec;

                if ($utfDecCode >= $minAr && $utfDecCode <= $maxAr) {
                    if (!$arFlag) {
                        $arFlag  = true;
                        $arRef[] = $i - 1;
                    }
                } else {
                    if ($arFlag) {
                        $arFlag  = false;
                        $arRef[] = $i - 1;
                    }
                }

                $probAr = false;
                continue;
            }

            if ($arFlag && !preg_match("/^\s$/", $str[$i])) {
                $arFlag  = false;
                $arRef[] = $i;
            }
        }

        return $arRef;
    }

    /**
     * Find out if given string is Arabic text or not
     *
     * @param string $str String
     *
     * @return boolean True if given string is UTF-8 Arabic, else will return False
     * @author Khaled Al-Sham'aa <khaled@ar-php.org>
     */
    public static function isArabic($str)
    {
        $isArabic = false;
        $arr      = self::identify($str);

        if (count($arr) == 1 && $arr[0] == 0) {
            $isArabic = true;
        }

        return $isArabic;
    }

  public static function stem($word)
  {
    // if the word is arabic use arabic stemmer
    if (self::isArabic($word)){
      return self::$_arabicStemmer->stem($word);
    }

    // otherwise use english stemmer
    return self::$_englishStemmer->stem($word);
  }
}
