Ext.define('Budget.store.UserCompanies', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.UserCompany',
	
	autoLoad: true,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/user/companies',
			update	: undefined,
			create  : undefined,
			destroy : undefined
		},
		reader: {
			type: 'json',
			root: 'result',
			successProperty: 'success'
		}
	}
	
});