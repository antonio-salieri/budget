Ext.define('Budget.view.abstract.Edit' ,{
	extend: 'Ext.window.Window',

	editTitle: 'Edit',
	addTitle: 'Add',
	
	layout: 'fit',
	autoShow: true,
	store: 'Companies',
	
    initComponent: function() {

		var action, caption;
		if (this.action == 'edit')
		{
			action = 'edit';
			caption = 'Save';
			this.title = this.editTitle;
		} else {
			action = 'add';
			caption = 'Add';
			this.title = this.addTitle;
		}

		this.buttons = [{
			text: caption,
			action: action
		}, {
			text: 'Cancel',
			scope: this,
			handler: this.close
		}];

		this.callParent(arguments);
	}
});
