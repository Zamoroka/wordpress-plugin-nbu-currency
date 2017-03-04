<?php
/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 13:26
 */
require_once 'inc/Nbu.php';
require_once 'inc/View.php';

if (is_admin()) {

    add_action('admin_menu', 'nbu_currency_admin_menu');

    function nbu_currency_admin_menu()
    {
        add_options_page('Currency NBU', 'Currency NBU', 'administrator',
            'nbu-currency', 'nbu_currency_admin_html');
    }

    function nbu_currency_admin_html()
    {
        $nbu_currency_chosen_currencies = get_option('nbu_currency_chosen_currencies');
        if ($_POST['nbu_currency_hidden'] == 'Y') {
            update_option('nbu_currency_chosen_currencies', $_POST['nbu_currency_chosen_currencies']);
        }
        $nbu = new Nbu();
        ?>
        <div>
            <h2>Currency NBU Options</h2>
            <form name="nbu_currency_form" method="post"
                  action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <input type="hidden" name="nbu_currency_hidden" value="Y">
                <p>
                    <label for="display"><?php _e('Display') ?></label>
                    <select multiple="multiple" id="display" size="10" name="nbu_currency_chosen_currencies[]">
                        <?php foreach ($nbu->getAllCurrencies() as $currency): ?>
                            <?php $selected = in_array($currency->cc, $nbu_currency_chosen_currencies) ? 'selected="selected"' : '' ?>
                            <option value="<?php echo $currency->cc ?>" <?php echo $selected ?>><?php echo $currency->txt ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>

                <p>
                    <input type="submit" value="<?php _e('Save Changes') ?>"/>
                </p>
            </form>
        </div>
        <?php
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