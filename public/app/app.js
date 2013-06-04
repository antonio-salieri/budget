
Ext.application({
	name: 'Budget',    
	autoCreateViewport: true,
	launch : function () {
		Budget.App = this;
		Ext.get("loading").remove()
	},
	paths: {
		'Budget' : '/app',
		'Ext.ux' : '/js/extjs/ux'
	},
	
	models: ['Company', 'User', 'Accttype', 'Conto'],
	stores: ['Companies', 'Users', 'Accttypes', 'Conto'],
	controllers: ['BudgetMenu', 'Company', 'User']
});
