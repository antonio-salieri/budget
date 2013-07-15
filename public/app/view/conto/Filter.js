Ext.define('Budget.view.conto.Filter' ,{
	extend: 'Ext.form.Panel',
	alias: 'widget.contofilterform',

	frame: false,
	bodyPadding: 5,
	layout: 'anchor',
	baseTitle: 'Filter',
	
	store: ['Contos'],
	
    initComponent: function() {
		
		this.buttons = [{
			text: 'Reset',
			action: 'reset',
			disabled: false
		}, {
			text: 'Filter',
			action: 'filter',
			disabled: false
		}];
	
		this.title = this.baseTitle;
		
        this.items = [{
			xtype: 'container',
			flex: 1,
			layout: 'hbox',
			items: [{
				xtype: 'container',
				flex: 1,
				layout: 'anchor',
				items: [{
					xtype: 'datefield',
					name : 'executionDateFrom',
					allowBlank: true,
					fieldLabel: 'Executed from',
					format: 'Y-m-d'
				}, {
					xtype: 'datefield',
					name : 'executionDateTo',
					allowBlank: true,
					fieldLabel: 'Executed to',
					format: 'Y-m-d'
				}]
			}, {
				xtype: 'container',
				flex: 1,
				layout: 'anchor',
				items: [{
					xtype: 'combobox',
					multiSelect: false,
					name: 'company',
					allowBlank: true,
					store: 'Companies',
					fieldLabel: 'Company',
					queryMode: 'remote',
					triggerAction: 'all',
					valueField: 'id',
					displayField: 'name'
				}]
			}, {
				xtype: 'container',
				flex: 1,
				layout: 'anchor',
				items: [{
					xtype: 'combobox',
					multiSelect: true,
					name: 'type',
					allowBlank: true,
					store: 'Accttypes',
					fieldLabel: 'Types',
					queryMode: 'remote',
					triggerAction: 'all',
					valueField: 'id',
					displayField: 'name'
				}]
			}]
		}];

		this.callParent(arguments);
	}
});
