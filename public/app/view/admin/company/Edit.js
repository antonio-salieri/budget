Ext.define('Budget.view.admin.company.Edit' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.companyedit',

	editTitle: 'Edit Company',
	addTitle: 'Add Company',

	store: 'Companies',
	
    initComponent: function() {
        this.items = [{
			xtype: 'form',
			frame: true,
			items: [{
				xtype: 'textfield',
				name : 'name',
				fieldLabel: 'Name'
			}, {
				xtype: 'checkbox',
				name : 'is11',
				uncheckedValue: 0,
				inputValue: 1,
				fieldLabel: 'Is 1:1'
			}]
		}];

		this.callParent(arguments);
	}
});
