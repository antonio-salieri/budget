Ext.define('Budget.store.Users', {
    extend: 'Budget.store.abstract.Store',
    model: 'Budget.model.User',

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