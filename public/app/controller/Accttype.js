Ext.define('Budget.controller.Accttype', {
    extend: 'Ext.app.Controller',

	stores: ['Accttypes'],
	models: ['Accttype'],
	views: [
        'admin.acct_type.List',
        'admin.acct_type.Edit'
    ],
	
    init: function() {
        this.control({
			'accttypelist': {
				itemdblclick: this.showEditRecordForm
			},
			
			'accttypelist toolbar button[action=add]': {
				click: this.showAddRecordForm
			},
			
			'accttypeedit button[action=add]': {
				click: this.addRecord
			},
			
			'accttypeedit button[action=edit]': {
				click: this.updateRecord
			}
        });
    },	
	
	showEditRecordForm: function(grid, record) {
		var view = Ext.widget('accttypeedit', {action: 'edit'});
		view.down('form')
			.loadRecord(record);
	},
	
	showAddRecordForm: function() {
		var view = Ext.widget('accttypeedit', {action: 'add'});
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
		this.getAccttypesStore().sync({
			callback: function() {
				this.getAccttypesStore().reload();
			},
			scope: this
		});
	},
	
	addRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			store = this.getAccttypesStore(),
			values = form.getValues();
		
		if (form.isValid())
		{
			win.close();
			store.add(values);
			store.sync();
		}
	}
});
