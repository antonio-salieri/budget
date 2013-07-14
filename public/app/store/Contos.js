Ext.define('Budget.store.Contos', {
    extend: 'Budget.store.abstract.Store',
    model: 'Budget.model.Conto',
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/transaction',
			update	: undefined,
			create  : '/transaction/add',
			destroy : '/transaction/storno'
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