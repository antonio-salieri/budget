Ext.define('Budget.model.User', {
    extend: 'Ext.data.Model',
    fields: ['id', 'firstName', 'lastName', 'companies'],
	
	associations: [
        {type: 'hasMany', model: 'Company',    name: 'companies'}
    ]
	
});