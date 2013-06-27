Ext.define('Budget.view.abstract.Edit' ,{
	extend: 'Ext.window.Window',

	modal: true,
	editTitle: 'Edit',
	addTitle: 'Add',
	viewTitle: 'View',
	
	layout: 'fit',
	autoShow: true,
	store: 'Companies',
	
    initComponent: function() {

		
		if (!this.buttons) {
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
		}

		this.callParent(arguments);
	}
});
