<?php
/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 13:26
 */
if (is_admin()) {

    add_action('admin_menu', 'nbu_currency_admin_menu');

    function nbu_currency_admin_menu()
    {
        add_options_page('Currency NBU', 'Currency NBU', 'administrator',
            'nbu-currency', 'nbu_currency_admin_html');
    }

    function nbu_currency_admin_html()
    {
        ?>
        <div>
            <h2>Currency NBU Options</h2>

            <form method="post" action="options.php">
                <?php wp_nonce_field('update-options'); ?>
                <p>
                    <input type="submit" value="<?php _e('Save Changes') ?>"/>
                </p>
            </form>
        </div>
        <?php
    }

}