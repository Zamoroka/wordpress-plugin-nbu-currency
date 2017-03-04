<?php

/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 15:22
 */
class Nbu
{
    private $_url = false;
    private $_date = false;

    public function __construct()
    {
        $this->_setDate();
    }

    protected function _setDate($time = false)
    {
        $this->_date = date('Ymd');
        if ($time) {
            $this->_date = date('Ymd', $time);
        }
        $this->_setUrl();
    }

    protected function _setUrl()
    {
        $this->_url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=' . $this->_date . '&json';
    }

    public function getAllCurrencies()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

    public function getCurrency($valcode)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->_url . '&valcode=' . $valcode);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result)[0];
    }

    public function getCurrencyStatus($chosen_currency)
    {
        $currencyToday = $this->getCurrency($chosen_currency);
        $this->_setDate(time() - (60 * 60 * 24)*3);

        $currencyYesterday = $this->getCurrency($chosen_currency);
        $this->_setDate(time());
        $currencyToday->status = $currencyToday->rate <=> $currencyYesterday->rate;
        return $currencyToday;
    }

    public function getChosenCurrencies()
    {
        $chosen_currencies = array();
        foreach (get_option('nbu_currency_chosen_currencies') as $chosen_currency) {
            $chosen_currencies[] = $this->getCurrencyStatus($chosen_currency);
        }

        return $chosen_currencies;
    }


}