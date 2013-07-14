Ext.define('Budget.view.Conto' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contopanel',

    initComponent: function() {
		this.layout = 'border';
		this.autoScroll = false;
		
        this.items = [{
			xtype: 'contolist',
			title: false,
			region: 'center',
			itemId: 'contolist'
		}, {
			split: true,
			floatable: true,
			collapsed: false,
			collapsible: true,
			xtype: 'contofilterform',
			title: 'Filter',
			region: 'north',
			itemId: 'contofilter'
		}, {
			split: true,
			floatable: true,
			collapsed: true,
			collapsible: true,
			xtype: 'contototal',
			html: 'Totals',
			region: 'east',
			width: 250,
			itemId: 'contototal'
		}];
	
		this.callParent(arguments);
		
		this.getComponent('contolist').getStore().on('load', this.reloadTotals, this);
	},
	
	
	reloadTotals: function(store, records, success_flag, opts) {
		
		if (success_flag) {
			var totals_data = store.getProxy().getReader().rawData.totals_data,
				totals_view = this.getComponent('contototal');

			if (totals_data.balance) {
				totals_view.setTitle(totals_view.baseTitle + ' [' + Ext.util.Format.currency(totals_data.balance) + ']');
			} else {
				totals_view.setTitle(totals_view.baseTitle);
			}
			totals_view.update(totals_data);
		}
		
	}
});
