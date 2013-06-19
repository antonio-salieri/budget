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
			items: [{
				xtype: 'textfield',
				name : 'name',
				fieldLabel: 'Name',
				allowBlank: false
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'type',
				allowBlank: false,
				store: Ext.create('Ext.data.Store', {
					fields: ['id', 'name'],
					data: [{
						id: 0,
						name: 'Income'
					}, {
						id: 1,
						name: 'Outcome'
					}],
					queryMode: 'local'
				}),
				fieldLabel: 'Type',
				valueField: 'id',
				displayField: 'name'
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
