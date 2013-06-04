Ext.define('Budget.store.Accttypes', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.Accttype',
	
	autoLoad: false,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/accttype',
			update	: '/accttype/update',
			create  : '/accttype/add',
			destroy : '/accttype/delete'
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