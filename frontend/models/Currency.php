<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Currency is the model get currency.
 */
class Currency extends Model
{
    const API_URL = 'https://api.privatbank.ua/p24api/exchange_rates?json';

    //Привести дату к подходящему виду для запроса к API 
    //@return string current date
    public static function formatDate($date = 'now') {
        return date('d.m.Y', strtotime($date));
    }
    
    /**
     * Generate an array of string dates between 2 dates
     *
     * @param string $start Start date
     * @param string $end End date
     * @param string $format Output format (Default: d.m.Y)
     *
     * @return array
     */
    public static function getDatesFromRange($start, $end, $format = 'd.m.Y') {
        $array = array();
        $interval = new \DateInterval('P1D');
    
        $realEnd = new \DateTime($end);
        $realEnd->add($interval);
    
        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);
    
        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }
    
        return $array;
    }
    
    /**
     * Get collection currencies.
     *
     * @param string $email the target email address
     * @return array rates
     */
    public static function getRates($date, $monetary_unit_list = ['USD'])
    {
        $data = [];
        try {
            $rates = (array)json_decode(file_get_contents(self::API_URL.'&date='.self::formatDate($date)));
        } catch (ErrorException $e) {
            //something processing
        }
        
        if(!empty($rates['exchangeRate'])){
            foreach ($rates['exchangeRate'] as $rate) {
                if(!empty($rate->currency)){
                    foreach ($monetary_unit_list as $money_code => $money_name) {
                        if($rate->currency == $money_name)
                            $data[] = (array)$rate;
                    }
                }
            }
        }
        
        return $data;
    }
}
