Ext.define('Budget.view.conto.List' ,{
    extend: 'Budget.view.abstract.List',
    alias: 'widget.contolist',

    title: 'All bills',

	store: 'Conto',
	
    initComponent: function() {
        this.columns = [{
			header: 'Id',  
			dataIndex: 'id',  
			flex: 1, 
			hideable: false, 
			hidden: true
		}];
		
        this.callParent(arguments);
    }
});
