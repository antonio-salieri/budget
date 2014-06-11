Ext.define('Budget.controller.Conto', {
    extend: 'Ext.app.Controller',

	stores: ['Contos'],
	models: ['Conto'],
	views: [
        'conto.List',
        'conto.Add',
        'conto.View',
        'conto.Filter',
        'conto.Total'
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
			},
			
			'contofilterform button[action=filter]': {
				click: this.fliterConto
			},
			
			'contofilterform button[action=reset]': {
				click: this.resetFliter,
				scope: this
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
		view.show();
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
//			win.close();
			form.form.reset();
			store.add(values);
			store.synchronize();
			store.reload();
		}
	},
	
	fliterConto: function(button) {
		var store = this.getContosStore(),
			proxy = store.getProxy(),
			form = button.up('contofilterform'),
			data = form.getValues(),
			filter_data = [];
		
		if (data.executionDateFrom) {
			filter_data.push({
				'main.executionDate': {
					oper: 'gte', 
					value: data.executionDateFrom
				}
			});
		}
		
		if (data.executionDateTo) {
			filter_data.push({
				'main.executionDate': {
					oper: 'lte', 
					value: data.executionDateTo
				}
			});
		}
		if (data.company) {
			filter_data.push({
				'c.id': {
					oper: 'eq', 
					value: data.company
				}
			});
		}
		
		if (data.type) {
			filter_data.push({
				'tt.id': {
					oper: 'in', 
					value: data.type
				}
			});
		}
		
		if (filter_data.length > 0)
		{
			form.setTitle('<em style="color:red">'+form.baseTitle+'</em>');
		} else {
			form.setTitle(form.baseTitle);
		}
		
		proxy.setExtraParam('filter', Ext.JSON.encode(filter_data));
		
//		Ext.Object.each(data, function(key, value, me) {
//			proxy.setExtraParam(key, value);
//		});
		
		store.load();
	},
	
	resetFliter: function(button) {
		var form = button.up('contofilterform');
		form.form.reset();
		this.fliterConto(button);
	}
});
