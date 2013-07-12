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
			}, {
				xtype: 'panel',
				frame: false,
				border: false,
				html: [
					'NOTE: Property "Is 1:1" may be set to only one company.',
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Setting this property for other company will automatically',
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; this flag on currently chosen 1:1 company.'
				].join('<br/>'),
				style: 'border: 1px dashed black; background: lightyellow;'
			}]
		}];

		this.callParent(arguments);
	}
});
