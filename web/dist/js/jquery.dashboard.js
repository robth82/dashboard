(function ($) {
    dashboardSettings = [];
    noRefresh = false;


    methods = {
        init: function (options) {
            var settings = $.extend({
                url: 'widget.php',
                paramSaveConfig: '?action=saveConfig',
                paramAddWidget: '?action=addWidget',
                paramRefreshWidget: '?action=refreshWidget',
                paramRemoveWidget: '?action=removeWidget'

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


        },
        addWidget: function (title) {
            jQuery.ajax({
                method: "GET",
                dataType: "json",
                url: dashboardSettings.url + dashboardSettings.paramAddWidget + '&title=' + title
            }).done(function (widget) {
                var grid = $('.grid-stack').data('gridstack');
                grid.add_widget(widget.html);
                $('#myModal').modal('toggle');
                eval(widget.javascript);
            });

        },

        refreshWidget: function (widget) {
            var elWidget = jQuery(widget).closest('.grid-stack-item');
            methods.refreshWidgetInternal(elWidget);

        },

        refreshWidgetById: function (widgetId) {
            var elWidget = jQuery('div.grid-stack-item[data-widget-id="' + widgetId + '"]');
            methods.refreshWidgetInternal(elWidget)

        },

        refreshWidgetInternal: function (elWidget) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: dashboardSettings.url + dashboardSettings.paramRefreshWidget + '&widgetId=' + elWidget.attr('data-widget-id')
            }).done(function(newWidget) {
                var grid = $('.grid-stack').data('gridstack');
                grid.remove_widget(elWidget);

                grid.add_widget(newWidget.html);
                eval(newWidget.javascript);
            });
        },


        initDashboard: function () {
            var options = {
                cell_height: 30,
                vertical_margin: 10,
                handle: '.grid-stack-item-content',
                draggable  : {handle: '.move-widget', scroll: true, appendTo: 'body'},
            float : true

            };
            $('.grid-stack').gridstack(options);

            $('.grid-stack').on('change', function (e, items) {
                var updatedWidgets = [];
                res = _.map(items, function (el) {
                    var id = $(el.el).attr('data-widget-id');
                    //el = $(el);
                    //var node = el.data('_gridstack_node');
                    updatedWidgets.push(el.el);
                    return {
                        method: 'widgetConf',
                        id: id,
                        x: el.x,
                        y: el.y,
                        width: el.width,
                        height: el.height
                    };
                });
                $.ajax({
                    method: "POST",
                    url: dashboardSettings.url + dashboardSettings.paramSaveConfig,
                    data: 'data=' + JSON.stringify(res)
                }).done(function (msg) {
                    jQuery.each(updatedWidgets, function() {
                       methods.refreshWidget(this);
                    });

                });
            });

            $('.grid-stack').on('dragstart', function (e, items) {
                noRefresh = true;
            });
            $('.grid-stack').on('dragstop', function (e, items) {
                noRefresh = false;
            });
            $('.grid-stack').on('resizestart', function (e, items) {
                noRefresh = true;
            });
            $('.grid-stack').on('resizestop', function (e, items) {
                noRefresh = false;
            });

            setInterval(function(){ methods.refreshWidgets(); }, 1000);
        },

        refreshWidgets: function () {

            jQuery('.grid-stack-item').each( function() {
                var timestempNextRefresh = jQuery(this).attr('timestampNextRefresh');
                if(timestempNextRefresh != '' && timestempNextRefresh != undefined) {
                    if(new Date() > new Date(jQuery(this).attr('timestampNextRefresh') * 1000)) {
                        if(!noRefresh) {
                            methods.refreshWidget(this);
                        }

                    }
                }

            });
        },

        removeWidget: function (widget) {
            var elWidget = jQuery(widget).closest('.grid-stack-item');
            $.ajax({
                method: "GET",
                url: dashboardSettings.url + dashboardSettings.paramRemoveWidget + '&widgetId=' + elWidget.attr('data-widget-id')
            }).done(function() {
                var grid = $('.grid-stack').data('gridstack');
                grid.remove_widget(elWidget);
            });
        },

        setUserOption: function (widget, option, value) {
            var elWidget = jQuery(widget).closest('.grid-stack-item');

            var widgetOptions;
            widgetOptions = {
                method: 'userOptions',
                id: elWidget.attr('data-widget-id'),
                option: option,
                value: value
            }
            widgetOptionsArray = [widgetOptions];

            $.ajax({
                method: "POST",
                url: dashboardSettings.url + dashboardSettings.paramSaveConfig,
                data: 'data=' + JSON.stringify(widgetOptionsArray)
            }).done(function (msg) {

            });
        },

        canRefresh: function () {
            return !noRefresh;
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





