Ext.Loader.setConfig({enabled: true, disableCaching: false});

Ext.Loader.setPath('Ext.ux', '/ci/www/js/ux/');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.tip.QuickTipManager',
    'Ext.ux.LiveSearchGridPanel',
    'Ext.toolbar.Paging',
    'Ext.ux.PreviewPlugin'
]);

Ext.onReady(function () {
    Ext.QuickTips.init();

    Ext.define('myModel', {
        extend: 'Ext.data.Model',
        fields: ['code', 'article', 'mkei', 'title', 'price']
    });


    var store = Ext.create('Ext.data.Store', {
        model: 'myModel',
        proxy: {
            type: 'ajax',
            url: '/ci/product/test',
            reader: {
                type: 'json',
                root: 'product',
                totalProperty: 'result'
            }
        },
        autoLoad: true,
    });

    // create the Grid, see Ext.
    //КОД - АРТИКУЛ - НАИМЕНОВАНИЕ - ЕД.ИЗМЕРЕНИЯ- ПРОИЗВОДИТЕЛЬ- ЦЕНА
    Ext.create('Ext.ux.LiveSearchGridPanel', {
        store: store,
        columns: [
            {
                text: 'Наименование',
                sortable: false,
                dataIndex: 'title',
                width: 305
            },
            {
                text: 'Код',
                sortable: false,
                dataIndex: 'code',
                width: 136
            },
            {
                text: 'Артикул',
                sortable: false,
                dataIndex: 'article',
                width: 205
            },
            
            {
                text: 'Ед. измерения',
                flex: 1,
                sortable: false,
                dataIndex: 'mkei'
            },
            {
                text: 'Цена',
                flex: 1,
                sortable: false,
                dataIndex: 'price'
            }
        ],
        // paging bar on the bottom
        bbar: Ext.create('Ext.PagingToolbar', {
            store: store,
            displayInfo: true,
            displayMsg: '',
            emptyMsg: "",
            name: 'pageName',
        }),
        layout:'fit',
        height: 400,
        autoWidth: true,
        width: 1000,
        title: 'Поиск',
        renderTo: 'grid-ex',
        viewConfig: {
            stripeRows: true,
            plugins: [{
                ptype: 'preview',
                bodyField: 'excerpt',
                expanded: true,
                pluginId: 'preview'
            }]
        }
    });
});