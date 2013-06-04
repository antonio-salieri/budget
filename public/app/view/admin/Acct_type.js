Ext.define('Budget.view.admin.Acct_type' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.accttypepanel',

	layout: {
		type: 'hbox',
		align: 'stretch'
	},
	
    initComponent: function() {
        this.items = [{
			xtype: 'accttypelist',
			title: false,
			flex: 1
		}];
	
		this.callParent(arguments);
	}
});
