Ext.define('Budget.model.Conto', {
    extend: 'Ext.data.Model',
	
	requires:[
        'Budget.model.Accttype'
    ],
	
    fields: ['id','income','outcome','entryTime',/*'updateTime',*/'executionDate','is11','type','note','user','company','stornoTime'],
	associations: [
        {type: 'hasOne', model: 'Budget.model.Accttype', name: 'type',associationKey: 'id', foreignKey: 'type'}
    ]
});