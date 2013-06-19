Ext.define('Budget.store.Contos', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.Conto',
	
	autoLoad: true,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/transaction',
			update	: undefined,
			create  : '/transaction/add',
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