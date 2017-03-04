<?php
/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 22:46
 */

?>
<div>
    <h2>Currency NBU Options</h2>
    <form name="nbu_currency_form" method="post" id="nbu_currency_form"
          action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="nbu_currency_hidden" value="Y">
        <select multiple="multiple" id="nbu_currency_chosen_currencies" size="10"
                name="nbu_currency_chosen_currencies[]">
        </select>
        <p>
            <input type="submit" value="<?php _e('Save Changes') ?>"/>
        </p>

        <table>
            <tr>
                <td valign="top">
                    <h3><?php _e('All currencies', 'nbu-currency') ?></h3>
                    <div id="sortFalse" class="list-group">
                        <?php foreach ($allCurrencies as $currency): ?>
                            <div class="list-group-item" id="<?php echo $currency->cc ?>">
                                <?php echo $currency->txt ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
                <td valign="top">
                    <h3><?php _e('Selected currencies', 'nbu-currency') ?></h3>
                    <div id="sortTrue" class="list-group">
                        <?php foreach ($chosenCurrencies as $currency): ?>
                            <div class="list-group-item" id="<?php echo $currency->cc ?>">
                                <?php echo $currency->txt ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        </table>

        <script>
            Sortable.create(sortTrue, {
                group: "sorting",
                sort: true
            });
            Sortable.create(sortFalse, {
                group: "sorting",
                sort: false
            });
        </script>
    </form>
</div>