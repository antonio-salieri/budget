Ext.define('Budget.view.Viewport', {
	
    extend: 'Ext.container.Viewport',
	requires: [
		'Budget.view.BudgetMenu',
		'Budget.view.BudgetWorkPanel',
		'Budget.view.admin.Admin',
		'Budget.view.Conto',
		'Ext.ux.statusbar'
    ],
	layout: {
		type: 'border',
		align: 'stretch'
	},
	
    initComponent: function() {
		this.defaults = {
			border: false
		};
		this.items = [{
			xtype: 'budgetworkpanel',
			region: 'center'
		}, {
			region: 'north',
			xtype: 'budgetmenu'
		}, {
			xtype: 'statusbar',
			region: 'south',
			defaultText: '&copy; ' + (new Date().getYear() + 1900) + ' Budget Inc.',
			defaultIconCls: 'default-icon',
			bodyStyle: 'font-weight: bold;'
//			text: 'Ready',
//			iconCls: 'ready-icon',
//			items: [{
//				text: 'A Button'
//			}, '-', 'Plain Text']
		}];
		
		this.bbar = [];
		
        this.callParent();
    }
});