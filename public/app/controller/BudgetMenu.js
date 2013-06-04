Ext.define('Budget.controller.BudgetMenu', {
    extend: 'Ext.app.Controller',

//	views: ['BudgetMenu', 'BudgetWorkPanel'],
	refs: [{
		ref: 'workpanel',
		selector: 'budgetworkpanel'
	}],
	
    init: function() {
        this.control({
			'budgetmenu panel': {
				click: this.processMenuClick
			},
			'budgetmenu button': {
				click: this.processMenuClick
			}
        });
    },
	
	processMenuClick: function(button, ev)
	{
		var work_panel = this.getWorkpanel();
		if (work_panel)
		{
			work_panel.activatePanel(button.action);
		}
	}
	
	
});
