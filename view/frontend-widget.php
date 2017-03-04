<h2 class="title text-right"><?php _e('Exchange rate', 'nbu-currency') ?></h2>

<table class="table" id="currency">
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
        ?>
        <tr>
            <th class="col-md-2" scope="row"><?php echo $icon ?></th>
            <td class="col-md-6"><?php echo $currency->txt ?></td>
            <td class="col-md-3"><?php echo round($currency->rate, 2) ?></td>
        </tr>
    <?php endforeach; ?>


    </tbody>
</table>

<p class="text-right"><?php _e('Rates', 'nbu-currency') ?><?php echo $currencies[0]->exchangedate ?></p>
