<div class="row">
    <h2 class="title text-right"><?php _e('Exchange rate', 'nbu-currency') ?></h2>

    <table class="table nbu-currency" id="currency">
        <tbody>
        <?php foreach ($currencies as $currency) : ?>

            <?php
            switch ($currency->status) {
                case '1':
                    $icon = '<i class="text-success fa fa-caret-up" aria-hidden="true"></i>';
                    break;
                case '-1':
                    $icon = '<i class="text-danger fa fa-caret-down" aria-hidden="true"></i>';
                    break;
                default:
                    $icon = '<i class="text-warning fa fa-minus" aria-hidden="true"></i>';
                    break;
            }
            if ($currency->cc == 'XAU' || $currency->cc == 'XAG') {
                $rate = round($currency->rate / $rateUSD, 2) . ' $';
            } else {
                $rate = round($currency->rate, 2) . ' ₴';
            }
            ?>
            <tr>
                <th class="col-md-6"><?php echo $currency->txt ?></th>
                <td class="col-md-6"><?php echo $icon ?>&nbsp<?php echo $rate; ?></td>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>

    <p class="rates text-right"><?php _e('Rates', 'nbu-currency'); ?>&nbsp<?php echo $currencies[0]->exchangedate ?></p>
</div>