Ext.define('Budget.view.conto.Add' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.contoadd',

	store: ['Contos', 'Users', 'Companies', 'Accttypes'],
	
	addTitle: 'Add conto',
	viewTitle: 'View conto',
	
    initComponent: function() {
		
		this.title = this.addTitle;
		this.buttons = [{
			text: 'Add',
			action: 'add'
		}, {
			text: 'Cancel',
			scope: this,
			handler: this.close
		}];


		
        this.items = [{
			xtype: 'form',
			frame: false,
			bodyPadding: 7,
			items: [{
				xtype: 'textfield',
				name : 'income',
				disabled: (this.action != 'income'),
				allowBlank: (this.action != 'income'),
				regex: /^\d+$/i,
				maskRe: /\d/i,
				value: 0,
				fieldLabel: 'Income'
			}, {
				xtype: 'textfield',
				name : 'outcome',
				disabled: (this.action == 'income'),
				allowBlank: (this.action == 'income'),
				regex: /^\d+$/i,
				maskRe: /\d/i,
				value: 0,
				fieldLabel: 'Outcome'
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'user',
				allowBlank: (this.action != 'outcome'),
				store: 'Users',
				fieldLabel: 'User',
				queryMode: 'remote',
				triggerAction: 'all',
				valueField: 'id',
				disabled: (this.action == 'income'),
				displayField: 'firstName'
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'company',
				allowBlank: false,
				store: 'Companies',
				fieldLabel: 'Company',
				queryMode: 'remote',
				triggerAction: 'all',
				valueField: 'id',
				displayField: 'name'
			}, {
				xtype: 'combobox',
				multiSelect: false,
				name: 'type',
				allowBlank: false,
				store: 'Accttypes',
				fieldLabel: (this.action == 'income') ? 'Income type' : 'Outcome type',
				queryMode: 'remote',
				triggerAction: 'all',
				action: this.action,
				listeners: {
					afterrender: {
						fn: function() {
							this.store.clearFilter(true);
							this.store.filter('type', (this.action == 'income') ? 0 : 1);
						}//,
//						scope: this
					}
				},
//				validator: function(val_obj) {
//					if (this.action == 'income') {
//						return val_obj.type == 0;	// 0 => income type
//					} else {
//						return val_obj.type == 1;	// 1 => outcome type
//					}
//				},
				valueField: 'id',
				displayField: 'name'
			}, {
				xtype: 'datefield',
				name : 'executionDate',
				allowBlank: false,
				fieldLabel: 'Execution date',
				format: 'Y-m-d',
				value: new Date(),
				maxValue: new Date()
			}, {
				xtype: 'textarea',
				name : 'note',
				fieldLabel: 'Note',
				width: 350,
				bodyPadding: 5
			}]
		}];

		this.callParent(arguments);
	}
});
