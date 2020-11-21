<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Sortable - Display as grid</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable > li {
            margin: 15px;
            padding: 1px;
            float: left;
            width: 16%;
            height: 300px;
            font-size: 4em;
            text-align: center;
            overflow-y: auto;
        }

        #sortable_sub {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable_sub > li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            font-size: 14px;
            min-height: 20px
        }

        #sortable_sub > li > span {
            position: absolute;
            margin-left: 1.3em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
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
        });
    </script>
</head>
<body>

<ul id="sortable">
    <li class="ui-state-default">
        <div class="portlet-header ui-widget-header ui-corner-all">Shopping <span
                class='ui-icon ui-icon-grip-dotted-vertical'></span>
        </div>
        <ul id="sortable_sub">
            <li class="ui-state-default">1 <br><br><br>x</li>
            <li class="ui-state-default">2</li>
            <li class="ui-state-default">3</li>
            <li class="ui-state-default">4</li>
            <li class="ui-state-default">5</li>
            <li class="ui-state-default">6</li>
            <li class="ui-state-default">7</li>
            <li class="ui-state-default">8</li>
            <li class="ui-state-default">9</li>
            <li class="ui-state-default">10</li>
            <li class="ui-state-default">11</li>
            <li class="ui-state-default">12</li>
        </ul>
    </li>
    <li class="ui-state-default">2</li>
    <li class="ui-state-default">3</li>
    <li class="ui-state-default">4</li>
    <li class="ui-state-default">5</li>
    <li class="ui-state-default">6</li>
    <li class="ui-state-default">7</li>
    <li class="ui-state-default">8</li>
    <li class="ui-state-default">9</li>
    <li class="ui-state-default">10</li>
    <li class="ui-state-default">11</li>
    <li class="ui-state-default">12</li>
</ul>


</body>
</html>


{{--    <!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>jQuery UI Sortable - Portlets</title>--}}
{{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            min-width: 520px;--}}
{{--        }--}}


{{--        .portlet {--}}
{{--            margin: 0 1em 1em 0;--}}
{{--            padding: 0.3em;--}}
{{--            width: 25%;--}}
{{--        }--}}

{{--        .portlet-header {--}}
{{--            padding: 0.2em 0.3em;--}}
{{--            margin-bottom: 0.5em;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .portlet-toggle {--}}
{{--            position: absolute;--}}
{{--            top: 50%;--}}
{{--            right: 0;--}}
{{--            margin-top: -8px;--}}
{{--        }--}}

{{--        .portlet-content {--}}
{{--            padding: 0.4em;--}}
{{--        }--}}

{{--        .portlet-placeholder {--}}
{{--            border: 1px dotted black;--}}
{{--            margin: 0 1em 1em 0;--}}
{{--            height: 50px;--}}
{{--        }--}}

{{--        #sortable_sub {--}}
{{--            list-style-type: none;--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            width: 100%;--}}
{{--        }--}}

{{--        #sortable_sub > li {--}}
{{--            margin: 0 3px 3px 3px;--}}
{{--            padding: 0.4em;--}}
{{--            padding-left: 1.5em;--}}
{{--            font-size: 14px;--}}
{{--            min-height: 20px--}}
{{--        }--}}

{{--        #sortable_sub > li > span {--}}
{{--            position: absolute;--}}
{{--            margin-left: 1.3em;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $(".column").sortable({--}}
{{--                scrollSensitivity: true,--}}
{{--                connectWith: ".column",--}}
{{--                handle: ".portlet-header",--}}
{{--                cancel: ".portlet-toggle",--}}
{{--                placeholder: "portlet-placeholder ui-corner-all"--}}
{{--            });--}}


{{--            $(".portlet-toggle").on("click", function () {--}}
{{--                var icon = $(this);--}}
{{--                icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");--}}
{{--                icon.closest(".portlet").find(".portlet-content").toggle();--}}
{{--            });--}}

{{--            $("#sortable_sub").sortable({--}}
{{--                connectWith: ".column",--}}
{{--                start: function(e, ui){--}}
{{--                    ui.placeholder.height(ui.item.height());--}}
{{--                },--}}
{{--                placeholder: "ui-state-highlight",--}}
{{--            });--}}
{{--            $("#sortable_sub").disableSelection();--}}

{{--        });--}}
{{--    </script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="column">--}}

{{--    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">--}}
{{--        <div class="portlet-header ui-widget-header ui-corner-all">Feeds <span--}}
{{--                class='ui-icon ui-icon-minusthick portlet-toggle'></span></div>--}}
{{--        <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>--}}
{{--    </div>--}}

{{--    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">--}}
{{--        <div class="portlet-header ui-widget-header ui-corner-all">News <span--}}
{{--                class='ui-icon ui-icon-minusthick portlet-toggle'></span></div>--}}
{{--        <div class="portlet-content">--}}
{{--            Lorem ipsum dolor sit amet, consectetuer adipiscing elit--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">--}}
{{--        <div class="portlet-header ui-widget-header ui-corner-all">Shopping <span--}}
{{--                class='ui-icon ui-icon-minusthick portlet-toggle'></span></div>--}}
{{--        <div class="portlet-content">--}}
{{--            <ul id="sortable_sub">--}}
{{--                <li class="ui-state-default">1 <br><br><br>x</li>--}}
{{--                <li class="ui-state-default">2</li>--}}
{{--                <li class="ui-state-default">3</li>--}}
{{--                <li class="ui-state-default">4</li>--}}
{{--                <li class="ui-state-default">5</li>--}}
{{--                <li class="ui-state-default">6</li>--}}
{{--                <li class="ui-state-default">7</li>--}}
{{--                <li class="ui-state-default">8</li>--}}
{{--                <li class="ui-state-default">9</li>--}}
{{--                <li class="ui-state-default">10</li>--}}
{{--                <li class="ui-state-default">11</li>--}}
{{--                <li class="ui-state-default">12</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">--}}
{{--        <div class="portlet-header ui-widget-header ui-corner-all">Links <span--}}
{{--                class='ui-icon ui-icon-minusthick portlet-toggle'></span></div>--}}
{{--        <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>--}}
{{--    </div>--}}

{{--    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">--}}
{{--        <div class="portlet-header ui-widget-header ui-corner-all">Images <span--}}
{{--                class='ui-icon ui-icon-minusthick portlet-toggle'></span></div>--}}
{{--        <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>--}}
{{--    </div>--}}

{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
