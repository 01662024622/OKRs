$(function () {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight"
    });
    $("#sortable").disableSelection();
    $("#sortable_sub").sortable({
        placeholder: "ui-state-highlight",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
        },
    });
    $("#sortable_sub").disableSelection();
    $(".portlet-toggle").on("click", function () {
        var icon = $(this);
        icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
        icon.closest(".portlet").find(".portlet-content").toggle();
    });
    $(".content-toggle").on("click", function () {
        var icon = $(this);
        icon.find(".fa").toggleClass("fa-caret-down fa-caret-up");
        icon.closest(".ui-state-default").find(".sub-content").toggle();
    });

});
