Ext.define('Budget.view.admin.acct_type.Edit' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.accttypeedit',

	editTitle: 'Edit accounting type',
	addTitle: 'Add accounting type',

	store: 'Accttypes',
	
    initComponent: function() {
        this.items = [{
			xtype: 'form',
			frame: true,
			items: []
		}];

		this.callParent(arguments);
	}
});
