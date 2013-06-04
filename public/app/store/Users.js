Ext.define('Budget.store.Users', {
    extend: 'Ext.data.Store',
    model: 'Budget.model.User',
	
	autoLoad: true,
	
	proxy: {
		type: 'ajax',
//		headers: {'Accept':'application/json'},
		api: {
			read	: '/user',
			update	: '/user/update',
			create  : '/user/add',
			destroy : '/user/delete'
		},
		reader: {
			type: 'json',
			root: 'result',
			successProperty: 'success'
		}
	}
	
});