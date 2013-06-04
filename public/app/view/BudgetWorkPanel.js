Ext.define('Budget.view.BudgetWorkPanel' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.budgetworkpanel',
	
//	layout: 'fit',

    initComponent: function() {
		
		this.layout = 'card';
		
		this.defaults = {
			layout: 'fit',
			closable: false
		};
        this.items = [{
			bodyStyle: 'background: #abc;',
			itemId: 'welcomepanel'
		}];
	
		this.callParent(arguments);
		
		this.activatePanel = function(panel_id) {
			var panel_obj, 
				defaults,
				item, 
				layout;
			
			defaults = {
				autoScroll: true
			};
			item = this.items.getByKey(panel_id);
			layout = this.layout;
			if (item) {
				if (layout.getActiveItem().itemId !== item.itemId) {
					layout.setActiveItem(item);
				}
			} else {
				panel_obj = Ext.apply({xtype: panel_id, itemId: panel_id}, defaults);
				this.add(panel_obj);
				layout.setActiveItem(panel_id);
			}
		};
	}
});
