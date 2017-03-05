<?php
/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 13:26
 */
require_once 'inc/Nbu.php';
require_once 'inc/View.php';

wp_register_style('nbu_currency_main_css', plugins_url('assets/css/main.css', __FILE__));
wp_enqueue_style('nbu_currency_main_css');
wp_register_script('nbu_currency_main_js', plugins_url('assets/js/main.js', __FILE__));
wp_enqueue_script('nbu_currency_main_js');

if (is_admin()) {
    wp_register_script('nbu_currency_sortable', plugins_url('assets/Sortable/Sortable.min.js', __FILE__));
    wp_enqueue_script('nbu_currency_sortable');
    add_action('admin_menu', 'nbu_currency_admin_menu');

    function nbu_currency_admin_menu()
    {
        add_options_page('Currency NBU', 'Currency NBU', 'administrator',
            'nbu-currency', 'nbu_currency_admin_html');
    }

    function nbu_currency_admin_html()
    {
        if ($_POST['nbu_currency_hidden'] == 'Y') {
            update_option('nbu_currency_chosen_currencies', $_POST['nbu_currency_chosen_currencies']);
        }
        $chosen_cc = get_option('nbu_currency_chosen_currencies');
        $nbu = new Nbu();
        $view = new View();
        $allCurrencies = $nbu->getAllCurrencies();
        $chosenCurrencies = array();
        foreach ($allCurrencies as $key => $currency) {
            if (in_array($currency->cc, $chosen_cc)) {
                $chosenCurrencies[array_search($currency->cc, $chosen_cc)] = $currency;
                unset($allCurrencies[$key]);
            }
        }
        ksort($chosenCurrencies);

        $view->assign('allCurrencies', $allCurrencies);
        $view->assign('chosenCurrencies', $chosenCurrencies);
        $view->display('view/admin-form.php');
    }
}

/** Shortcode */
function nbu_currency_shortcode()
{
    $view = new View();
    $nbu = new Nbu();
    $view->assign('currencies', $nbu->getChosenCurrencies());
    return $view->display('view/frontend-widget.php');
}

add_shortcode('nbu_currency', 'nbu_currency_shortcode');