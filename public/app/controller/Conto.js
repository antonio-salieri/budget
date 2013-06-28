Ext.define('Budget.controller.Conto', {
    extend: 'Ext.app.Controller',

	stores: ['Contos'],
	models: ['Conto'],
	views: [
        'conto.List',
        'conto.Add',
        'conto.View',
        'conto.Filter'
    ],
	
    init: function() {
        this.control({
			'contolist': {
				itemdblclick: this.showItemDetails
			},
			
			'contolist toolbar button[action=add_income]': {
				click: this.showAddIncomeForm
			},
			
			'contolist toolbar button[action=add_outcome]': {
				click: this.showAddOutcomeForm
			},
			
			'contoadd button[action=add]': {
				click: this.addRecord
			}
        });
    },	
	
	showAddIncomeForm: function() {
		var view = Ext.widget('contoadd', {action: 'income'});
		return view;
	},
	
	showAddOutcomeForm: function() {
		var view = Ext.widget('contoadd', {action: 'outcome'});
		return view;
	},
	
	
	showItemDetails: function(grid, record) {
		var view = Ext.widget('contoview');
		view.down('panel').update(record.getData());
	},
	
	addRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			store = this.getContosStore(),
			values = form.getValues();
		
		values.is11 = false;
		values.updateTime = null;
		values.entryTime = Ext.util.Format.date(new Date(), 'Y-m-d H:i:s');
		values.income = parseFloat(values.income);
		values.outcome = parseFloat(values.outcome);
		
		if (form.isValid())
		{
			win.close();
			store.add(values);
			store.synchronize();
		}
	}
});
