jQuery(function ($) {
    $('#nbu_currency_form').on('submit', function () {
        var IDs = $("#sortTrue .list-group-item[id]").map(function () {
            return this.id;
        }).get();

        $("#nbu_currency_chosen_currencies").html('');
        $.each(IDs, function (i, e) {
            $("#nbu_currency_chosen_currencies").append('<option value="' + e + '" selected="selected">' + e + '</option>');
        });
    })
});