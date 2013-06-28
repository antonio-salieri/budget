Ext.define('Budget.view.conto.Total' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contototal',

	frame: false,
	bodyPadding: 10,
	layout: 'anchor',
	
	store: ['Contos'],
	
    initComponent: function() {
		
		this.items = [];

		this.callParent(arguments);
	}
});
