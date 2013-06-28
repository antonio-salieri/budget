/**
 * Not used yet
 */

Ext.define('Budget.controller.abstract.Controller', {
    extend: 'Ext.app.Controller',

	stores: [],
	models: [],
	views: [],
	
	showEditRecordForm: function(grid, record) {
		var view = Ext.widget('companyedit', {action: 'edit'});
		view.down('form')
			.loadRecord(record);
	},
	
	showAddRecordForm: function() {
		var view = Ext.widget('companyedit', {action: 'add'});
		return view;
	},
	
	updateRecord: function(button) {
//		console.log('Save');
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues(),
			action = button.action;

		record.set(values);
		win.close();
		this.getCompaniesStore().sync();
	},
	
	addRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			store = this.getCompaniesStore(),
			values = form.getValues();
		
		if (form.isValid())
		{
			win.close();
			store.add(values);
			store.sync();
		}
	}
});
