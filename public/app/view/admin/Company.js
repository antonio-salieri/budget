Ext.define('Budget.view.admin.Company' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.companypanel',

	layout: {
		type: 'hbox',
		align: 'stretch'
	},
	
    initComponent: function() {
        this.items = [{
			xtype: 'companylist',
			title: false,
			flex: 1
		}];
	
		this.callParent(arguments);
	}
});
