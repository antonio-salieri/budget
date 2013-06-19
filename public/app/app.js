
Ext.application({
	name: 'Budget',    
	autoCreateViewport: true,
	launch : function () {
		Budget.App = this;
		Ext.get("loading").remove();
	},
	
	paths: {
		'Budget' : '/app',
		'Ext.ux' : '/js/extjs/ux'
	},
	
	models: ['Company', 'Conto', 'User', 'Accttype'],
	stores: ['Companies', 'Contos', 'Users', 'Accttypes'],
	controllers: ['BudgetMenu', 'Conto', 'Company', 'User', 'Accttype']
});
