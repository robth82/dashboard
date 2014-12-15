(function ($) {
    dashboardSettings = [];

    methods = {
        init: function (options) {
            var settings = $.extend({
                url: 'widget.php',
                paramSaveConfig: '?action=saveConfig',
                paramAddWidget: '?action=addWidget',
                paramRefreshWidget: '?action=refreshWidget'

            }, options || {});
            //settings.tableClass = settings.tableClass.replace(/\s+/g, '.');
            return this.each(function () {
                var $grid = $(this);
                var id = $grid.attr('id');
                dashboardSettings = settings;

                methods.initDashboard();
            });
        },

        saveConfig: function () {
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
                url: dashboardSettings.url + dashboardSettings.paramSaveConfig,
                data: {
                    config: JSON.stringify(config),
                    dashboardId: jQuery('div.dashboard').attr('id')
                }
            });

        },
        addWidget: function (widget) {
            if (jQuery(widget).val() == '') return;
            jQuery.ajax({
                type: "POST",
                async: true,
                url: dashboardSettings.url + dashboardSettings.paramAddWidget,
                data: { title: jQuery(widget).val(), dashboardId: jQuery('div.dashboard').attr('id')}
            })
                .done(function (msg) {
                    html = msg;
                    //alert( "Data Saved: " + msg );
                    jQuery('ul.no1').prepend(html);
                    methods.initDashboard();
                    //alert(html);

                    var test = select[0].selectize;
                    test.clear();
                    methods.saveConfig();
                });
        },

        refreshWidget: function (widget) {
            var widgetId = jQuery(widget).closest('li').attr('id');
            methods.refreshWidgetById(widgetId);
        },

        refreshWidgetById: function (widgetId) {
            var dashboardId = jQuery('div.dashboard').attr('id');


            jQuery.ajax({
                type: "GET",
                url: dashboardSettings.url + dashboardSettings.paramRefreshWidget + "&dashboardId=" + dashboardId + "&widgetId=" + widgetId
            })
                .done(function (msg) {
                    jQuery('#' + widgetId).replaceWith(msg);
                    methods.initDashboard();
                });
        },

        initDashboard: function () {
            $('.connected').sortable({
                connectWith: '.connected'
            }).bind('sortupdate', function (ev, item) {
                methods.saveConfig();
            });
        },

        removeWidget: function (widget) {
            var cl = jQuery(widget).closest('li');
            cl.hide('slow', function () {
                cl.remove();
                methods.saveConfig();
            });
        }

    };

    $.fn.dashboard = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.dashboard');
            return false;
        }
    };

})(jQuery);





