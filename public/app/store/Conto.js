Ext.define('Budget.store.Conto', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.Conto',
	
	autoLoad: true,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/conto',
			update	: undefined,
			create  : '/conto/add',
			destroy : undefined
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