Ext.define('Budget.controller.User', {
    extend: 'Ext.app.Controller',

	stores: ['Users'],
	models: ['User'],
	views: [
        'admin.user.List',
        'admin.user.Edit'
    ],
	
    init: function() {
        this.control({
//            'viewport > panel': {
//                render: this.onPanelRendered
//            }
			'userlist': {
				itemdblclick: this.showEditRecordForm
			},
			
			'userlist toolbar button[action=add]': {
				click: this.showAddRecordForm
			},
			
			'useredit button[action=add]': {
				click: this.addRecord
			},
			
			'useredit button[action=edit]': {
				click: this.updateRecord
			}
			
        });
    },	
	
	showEditRecordForm: function(grid, record) {
		var view = Ext.widget('useredit', {action: 'edit'});
		view.down('form')
			.loadRecord(record);
	},
	
	showAddRecordForm: function() {
		var view = Ext.widget('useredit', {action: 'add'});
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
		this.getUsersStore().sync({
			callback: function() {
				this.getUsersStore().reload();
			},
			scope: this
		});
	},
	
	addRecord: function(button) {
		var win = button.up('window'),
			form = win.down('form'),
			store = this.getUsersStore(),
			values = form.getValues();
		
		if (form.isValid())
		{
			win.close();
			store.add(values);
			store.sync();
		}
	}
});
