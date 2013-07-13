Ext.define('Budget.view.admin.Admin' ,{
	extend: 'Ext.tab.Panel',
	alias: 'widget.adminpanel',
	
	requires : [
		'Budget.view.admin.Company',
		'Budget.view.admin.company.List',
		'Budget.view.admin.User',
		'Budget.view.admin.user.List',
		'Budget.view.admin.Acct_type',
		'Budget.view.admin.acct_type.List'
	],

//	layout: 'fit',
	
    initComponent: function() {
		this.defaults = {
			layout: 'fit',
			closable: false
		};
        this.items = [{
			title: 'Companies',
			xtype: 'companypanel'
		}, {
			title: 'Users',
			xtype: 'userpanel'
		}, {
			title: 'Accounting types',
			xtype: 'accttypepanel'
		}];
	
		this.callParent(arguments);
	}
});
