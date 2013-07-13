Ext.define('Budget.store.abstract.Store', {
    extend: 'Ext.data.Store',
	
	autoLoad: false,
	reloadAfterSync: true,
	remoteSort: true,
	
//	listeners: {
//		add: {
//			fn: function( store, records, index, eOpts ) {
//				store.reload();
//			}
//		}
//	},
	
	synchronize: function() {
		
		if (this.reloadAfterSync) {
			this.sync({
				callback: function() {
					this.clearFilter(true);
					this.reload();
				},
				scope: this
			});
		} else {
			this.sync();
		}
	}
	
});