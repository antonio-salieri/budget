Ext.define('Budget.view.admin.user.Edit' ,{
	extend: 'Budget.view.admin.abstract.Edit',
	alias: 'widget.useredit',

	store: 'Conto',
	
	addTitle: 'Add user',
	
    initComponent: function() {
        this.items = [{
			xtype: 'form',
			frame: true,
			items: []
		}];

		this.callParent(arguments);
	}
});
