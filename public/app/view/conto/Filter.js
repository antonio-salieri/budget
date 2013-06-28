Ext.define('Budget.view.conto.Filter' ,{
	extend: 'Ext.form.Panel',
	alias: 'widget.contofilterform',

	frame: false,
	bodyPadding: 10,
	layout: 'anchor',
	
	store: ['Contos'],
	
    initComponent: function() {
		
		this.buttons = [{
			text: 'Filter',
			action: 'filter'
		}];

        this.items = [{
			xtype: 'datefield',
			name : 'executionDateFrom',
			allowBlank: false,
			fieldLabel: 'Executed from',
			format: 'Y-m-d',
			toFrontOnShow: true
		}, {
			xtype: 'datefield',
			name : 'executionDateTo',
			allowBlank: false,
			fieldLabel: 'Executed to',
			format: 'Y-m-d',
			toFrontOnShow: true
		}];

		this.callParent(arguments);
	}
});
