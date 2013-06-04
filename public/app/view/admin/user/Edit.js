Ext.define('Budget.view.admin.user.Edit' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.useredit',

	store: 'Users',
	
	editTitle: 'Edit user',
	addTitle: 'Add user',
	
    initComponent: function() {
        this.items = [{
			xtype: 'form',
			frame: true,
			items: [{
				xtype: 'textfield',
				name : 'firstName',
				fieldLabel: 'First Name'
			}, {
				xtype: 'textfield',
				name : 'lastName',
				fieldLabel: 'Last Name'
			}, {
				xtype: 'combobox',
				multiSelect: true,
				name: 'companies',
				fieldLabel: 'Companies',
				store: 'Companies',
				valueField: 'id',
				displayField: 'name'
			}]
		}];

		this.callParent(arguments);
	}
});
