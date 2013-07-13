Ext.define('Budget.model.Accttype', {
	
    extend: 'Ext.data.Model',
	
//	requires:[
//        'Budget.model.Conto'
//    ],
	
    fields: ['id', 'name', 'is11', 'type', 'isTaxResolver', 'resolveTaxAutomatically'],
	belongsTo: [{model: 'Budget.model.Conto', associationKey: 'id', foreignKey: 'type'}]
});