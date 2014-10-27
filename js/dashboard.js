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
    if (jQuery(widget).val() == '') return;

    jQuery.ajax({
        type: "POST",
        url: "widget.php",
        data: { title: jQuery(widget).val()}
    })
        .done(function (msg) {
            html = msg;
            //alert( "Data Saved: " + msg );
            jQuery('ul.no1').prepend(html);
            initDashboard();
            //alert(html);

            var test = select[0].selectize;
            test.clear();
        });
}