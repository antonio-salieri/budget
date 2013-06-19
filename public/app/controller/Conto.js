Ext.define('Budget.controller.Conto', {
    extend: 'Ext.app.Controller',

	stores: ['Contos'],
	models: ['Conto'],
	views: [
        'conto.List',
        'conto.Edit'
    ],
	
    init: function() {
        this.control({
			'contolist': {
				itemdblclick: this.showItemDetails
			},
			
			'contolist toolbar button[action=add]': {
				click: this.showAddRecordForm
			},
			
			'contoedit button[action=add]': {
				click: this.addRecord
			}
        });
    },	
	
	showEditRecordForm: function(grid, record) {
		var view = Ext.widget('contoedit', {action: 'edit'});
		view.down('form').loadRecord(record);
	},
	
	showAddRecordForm: function() {
		var view = Ext.widget('contoedit', {action: 'add'});
		return view;
	},
	
	updateRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues(),
			action = button.action;

		record.set(values);
		win.close();
		this.getContosStore().sync({
			callback: function() {
				this.getContosStore().reload();
			},
			scope: this
		});
	},
	
	showItemDetails: function(grid, record) {
		var view = Ext.widget('contoedit', {action: 'view'});
		view.down('form').applyToField({disabled:true});
		view.down('form').loadRecord(record);
	},
	
	
	addRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			store = this.getContosStore(),
			values = form.getValues();
		
		if (form.isValid())
		{
			win.close();
			store.add(values);
			store.sync();
		}
	}
});
