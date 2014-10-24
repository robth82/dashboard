/**
 * Created by Rob on 21-10-14.
 */


function initDashboard() {
    $('.connected').sortable({
        connectWith: '.connected'
    }).bind('sortupdate', function (ev) {
        console.log(ev);
    });
}

function dashboardRemoveWidget(widget) {
    var cl = jQuery(widget).closest('li');
    console.log(cl);
    cl.hide('slow', function () {
        cl.remove();
    });


}

function dashboardAddWidget(widget) {
    var html = '<li id="db_5445f530c8302" draggable="true"><div class="dashboardWidget">';
    html += '<div class="header">Robs dashboard<div class="actions"><div class="action close" onclick="dashboardRemoveWidget(this);">X</div></div></div>';
    html += '<div class="content">abcde</div></div></div></li>';

    jQuery('ul.no1').prepend(html);
    initDashboard();
    //alert(html);
}