Ext.define('Budget.store.Companies', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.Company',
	
	autoLoad: true,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/company',
			update	: '/company/update',
			create  : '/company/add',
			destroy : '/company/delete'
		},
		reader: {
			type: 'json',
			root: 'result',
			successProperty: 'success'
		},
		writer : {
			type : "json",
			writeAllFields : false
		}
	}
	
});