Ext.define('Budget.view.conto.Edit' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.contoedit',

	store: ['Contos', 'Users', 'Companies'],
	
	addTitle: 'Add conto',
	viewTitle: 'View conto',
	
    initComponent: function() {
		
		if (this.action == 'add')
		{
			this.title = this.addTitle;
			this.buttons = [{
				text: 'Add',
				action: 'add'
			}, {
				text: 'Cancel',
				scope: this,
				handler: this.close
			}];
		} else {
			this.title = this.viewTitle;
			this.buttons = [{
				text: 'Close',
				scope: this,
				handler: this.close
			}];
		}

		
        this.items = [{
			xtype: 'form',
			frame: true,
			items: [{
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
				xtype: 'textfield',
				name : 'income',
				fieldLabel: 'Income'
			}, {
				xtype: 'textfield',
				name : 'outcome',
				fieldLabel: 'Outcome'
			}, {
				xtype: 'textarea',
				name : 'note',
				fieldLabel: 'Note',
				width: 250,
				bodyPadding: 5
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'type',
				allowBlank: false,
				store: 'Users',
				fieldLabel: 'User',
				valueField: 'id',
				displayField: 'firstName'
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'type',
				allowBlank: false,
				store: 'Companies',
				fieldLabel: 'Company',
				valueField: 'id',
				displayField: 'name'
			}]
		}];

		this.callParent(arguments);
	}
});
