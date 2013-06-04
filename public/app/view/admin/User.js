Ext.define('Budget.view.admin.User' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.userpanel',

	layout: {
		type: 'hbox',
		align: 'stretch'
	},
	
    initComponent: function() {
        this.items = [{
			xtype: 'userlist',
			title: false,
			flex: 1
		}];
	
		this.callParent(arguments);
	}
});
