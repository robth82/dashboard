/**
 * Created by Rob on 21-10-14.
 */

(function ($) {

    $.fn.dashboard = function (action) {

        if (action === "saveConfig") {

        }

        if (action === "close") {
            console.log('close');
        }
    };

    function privateFunction() {
        console.log('private function');
    }

    function saveConfig() {
        var config = new Array();

        jQuery('div.dashboard').find('ul.connected').each(function (column, columnData) {
            var colnr = jQuery(columnData).attr('class');
            var columnConfig = new Array();
            jQuery(columnData).find('li.widget').each(function (order, widgetdata) {
                columnConfig[order] = jQuery(widgetdata).attr('id');
            });
            config.push(columnConfig);

        });

        jQuery.ajax({
            type: "POST",
            url: "widget.php?action=saveConfig",
            data: { config: JSON.stringify(config), dashboardId: jQuery('div.dashboard').attr('id') }
        });

    }

}(jQuery));


function initDashboard() {
    $('.connected').sortable({
        connectWith: '.connected'
    }).bind('sortupdate', function (ev, item) {
        saveConfig();
    });
}

function dashboardRemoveWidget(widget) {
    var cl = jQuery(widget).closest('li');
    cl.hide('slow', function () {
        cl.remove();
        saveConfig();
    });
}

function dashboardRefreshWidget(widget) {
    var widgetId = jQuery(widget).closest('li').attr('id');

    dashboardRefreshWidgetById(widgetId);
}

function dashboardRefreshWidgetById(widgetId) {
    //console.log('refresh widget ' + widgetId);
    var dashboardId = jQuery('div.dashboard').attr('id');

    jQuery.ajax({
        type: "GET",
        url: "widget.php?action=refreshWidget&dashboardId=" + dashboardId + "&widgetId=" + widgetId
    })
        .done(function (msg) {
            jQuery('#' + widgetId).replaceWith(msg);
            initDashboard();
        });
}

function dashboardAddWidget(widget) {
    if (jQuery(widget).val() == '') return;
    jQuery.ajax({
        type: "POST",
        async: true,
        url: "widget.php?action=addWidget",
        data: { title: jQuery(widget).val(), dashboardId: jQuery('div.dashboard').attr('id')}
    })
        .done(function (msg) {
            html = msg;
            //alert( "Data Saved: " + msg );
            jQuery('ul.no1').prepend(html);
            initDashboard();
            //alert(html);

            var test = select[0].selectize;
            test.clear();
            saveConfig();
        });
}

function saveConfig() {
    console.log('Deprecated.');
    var config = new Array();
    jQuery('div.dashboard').find('ul.connected').each(function (column, columnData) {
        var colnr = jQuery(columnData).attr('class');
        var columnConfig = new Array();
        jQuery(columnData).find('li.widget').each(function (order, widgetdata) {
            columnConfig[order] = jQuery(widgetdata).attr('id');
        });
        config.push(columnConfig);

    });

    jQuery.ajax({
        type: "POST",
        url: "widget.php?action=saveConfig",
        data: { config: JSON.stringify(config), dashboardId: jQuery('div.dashboard').attr('id') }
    });


}

function changeDashboard(dashboard) {
    //var dashboardId = jQuery(dashboard).val();
    if (dashboard != '') {
        window.location = 'index.php?dashboard=' + dashboard;
    }
}