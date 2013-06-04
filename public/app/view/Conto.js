Ext.define('Budget.view.Conto' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contopanel',

	requires: ['Budget.view.conto.List'],
	
	
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
			xtype: 'panel',
			title: false,
			html: 'Totals',
			region: 'south',
			height: 100
//			flex: 1
		}];
	
		this.callParent(arguments);
	}
});
