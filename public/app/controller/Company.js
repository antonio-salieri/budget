Ext.define('Budget.controller.Company', {
    extend: 'Ext.app.Controller',

	stores: ['Companies'],
	models: ['Company'],
	views: [
        'admin.company.List',
        'admin.company.Edit'
    ],
	
    init: function() {
        this.control({
//            'viewport > panel': {
//                render: this.onPanelRendered
//            }
			'companylist': {
				itemdblclick: this.showEditRecordForm
			},
			
			'companylist toolbar button[action=add]': {
				click: this.showAddRecordForm
			},
			
			'companyedit button[action=add]': {
				click: this.addRecord
			},
			
			'companyedit button[action=edit]': {
				click: this.updateRecord
			}
			
        });
    },

    onPanelRendered: function() {
        console.log('The panel was rendered');
    },
	
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
