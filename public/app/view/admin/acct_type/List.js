Ext.define('Budget.view.admin.acct_type.List' ,{
    extend: 'Budget.view.abstract.List',
    
	alias: 'widget.accttypelist',

    title: 'All accountiong types',

	store: 'Accttypes',
	
    initComponent: function() {
		
        this.columns = [{
			dataIndex: 'id',  
			flex: 1, 
			hideable: false, 
			hidden: true
		}, {
			header: 'Name',  
			dataIndex: 'name',  
			flex: 1,
			editable: true
		}, {
			header: 'Type',  
			dataIndex: 'type',  
			flex: 1,
			editable: true,
			renderer: this.renderEntryType
		}, {
			header: 'Is 1:1', 
			dataIndex: 'is11',  
			flex: 1, 
			renderer: this.renderBoolean
		}, {
			header: 'Is Tax resolver', 
			dataIndex: 'isTaxResolver',  
			flex: 1, 
			renderer: this.renderBoolean
		}, {
			header: 'Auto resolve Tax', 
			dataIndex: 'resolveTaxAutomatically',  
			flex: 1, 
			renderer: this.renderBoolean
		}];
	
		this.callParent(arguments);
    },
	
	/*
	 * Renderers
	 */
	renderEntryType: function(val) {
		return (val == 0) ? 'Income' : 'Outcome';
	}
});
