Ext.define('Budget.store.abstract.Store', {
    extend: 'Ext.data.Store',
	
	autoLoad: true,
	reloadAfterSync: true,
	
	listeners: {
		add: {
			fn: function( store, records, index, eOpts ) {
				store.reload();
			}
		}
	},
	
	synchronize: function() {
		this.sync();
		if (this.reloadAfterSync) {
			this.reload();
		}
	}
	
});