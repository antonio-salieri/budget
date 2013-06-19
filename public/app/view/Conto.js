Ext.define('Budget.view.Conto' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contopanel',

    initComponent: function() {
		this.layout = 'border';
		this.autoScroll = false;
		
        this.items = [{
			xtype: 'contolist',
			title: false,
			region: 'center'
//			flex: 10
		}, {
			split: true,
			floatable : true,
			collapsed:true,
			xtype: 'panel',
			title: 'Totals',
			collapsible : true,
			html: 'Totals',
			region: 'east',
			width: 250
		}, {
			split: true,
			floatable : true,
			collapsed:true,
			xtype: 'panel',
			title: 'Filter',
			collapsible : true,
			html: 'Filters',
			region: 'north',
			height: 50
		}];
	
		this.callParent(arguments);
	}
});
