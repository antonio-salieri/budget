Ext.define('Budget.view.BudgetMenu', {
	
    extend: 'Ext.toolbar.Toolbar',
	requires: [],
	alias: 'widget.budgetmenu',

	initComponent: function() {
		this.defaults = {
			border: false
		};
		this.height = 50;
		
		this.items = [{
			xtype: 'panel',
			html: '<div class="navbar"><a class="brand" href="/">Budget</a></div>',
			border: false,
			frame: false,
			baseCls: 'brand',
			action: 'welcomepanel'
		}, '->',/* {
			xtype: 'buttongroup',
			title: 'Calculations',
			position: 'bottom',
			items: [{
				text: 'Add',
				scale: 'small',
				action: 'contoaddpanel'
			}, {
				text: 'View',
				scale: 'small',
				action: 'contolistpanel'
			}]
		},*/ {
			text: 'Conto',
			scale: 'large',
			action: 'contopanel'
		}, {
			text: 'Reports',
			scale: 'large',
			action: 'reportspanel'
		}, {
			text: 'Administration',
			scale: 'large',
			action: 'adminpanel'
		}];
		
        this.callParent();
    }
});
