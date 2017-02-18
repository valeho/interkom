Ext.Loader.setConfig({enabled: true});

Ext.Loader.setPath('Ext.ux', '/ci/www/src/ux/');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.tip.QuickTipManager',
    'Ext.ux.LiveSearchGridPanel',
]);

Ext.onReady(function () {
    Ext.QuickTips.init();

    Ext.define('myModel', {
        extend: 'Ext.data.Model',
        fields: ['titles']
    });


    var store = Ext.create('Ext.data.Store', {
        model: 'myModel',
        proxy: {
            type: 'ajax',
            url: 'http://localhost/ci/product/test',
            reader: {
                type: 'json',
                root: 'name'
            }
        },
        autoLoad: true,
    });

    // create the Grid, see Ext.
    Ext.create('Ext.ux.LiveSearchGridPanel', {
        store: store,
        columns: [
            {
                text: 'Название',
                flex: 1,
                sortable: false,
                dataIndex: 'titles'
            }
        ],
        height: 350,
        width: '100%',
        title: 'Поиск',
        renderTo: 'grid-example',
        viewConfig: {
            stripeRows: true
        }
    });
});