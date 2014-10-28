/**
 * Created by Rob on 21-10-14.
 */

var henk;

function initDashboard() {
    $('.connected').sortable({
        connectWith: '.connected'
    }).bind('sortupdate', function (ev, item) {
        saveConfig();
    });
}

function dashboardRemoveWidget(widget) {
    var cl = jQuery(widget).closest('li');
    console.log(cl);
    cl.hide('slow', function () {
        cl.remove();
        saveConfig();
    });


}

function dashboardAddWidget(widget) {
    if (jQuery(widget).val() == '') return;
    console.log('aa');
    jQuery.ajax({
        type: "POST",
        url: "widget.php?action=addWidget",
        data: { title: jQuery(widget).val(), id: jQuery('div.dashboard').attr('id')}
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
        data: { config: JSON.stringify(config), id: jQuery('div.dashboard').attr('id') }
    });


}

function changeDashboard(dashboard) {
    var dashboardId = jQuery(dashboard).val();
    window.location = 'index.php?dashboard=' + dashboardId;

}