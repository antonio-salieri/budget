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
				itemdblclick: this.editRecord
			},
			
			'userlist toolbar button[action=add]': {
				click: this.addRecord
			},
			
			'useredit button[action=add]': {
				click: this.updateRecord
			},
			
			'useredit button[action=edit]': {
				click: this.updateRecord
			}
			
        });
    },

//    onPanelRendered: function() {
//        console.log('The panel was rendered');
//    },
	
	editRecord: function(grid, record) {
		var view = Ext.widget('useredit', {action: 'edit'});
		view.down('form')
			.loadRecord(record);
	},
	
	addRecord: function(grid, record) {
		var view = Ext.widget('useredit', {action: 'add'});
		return view;
	},
	
	updateRecord: function(button) {
//		console.log('Save');
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues(),
			action = button.action;

		if (action == 'edit') {
			record.set(values);
		} else {
			record.add(values);
		}
		win.close();
		this.getUsersStore().sync();
	}
});
