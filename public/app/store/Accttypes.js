Ext.define('Budget.store.Accttypes', {
    extend: 'Budget.store.abstract.Store',
    model: 'Budget.model.Accttype',
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/transactiontype',
			update	: '/transactiontype/update',
			create  : '/transactiontype/add',
			destroy : '/transactiontype/delete'
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