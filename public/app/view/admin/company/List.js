Ext.define('Budget.view.admin.company.List' ,{
    extend: 'Budget.view.abstract.List',
    
	alias: 'widget.companylist',

    title: 'All Companies',

	store: 'Companies',
	
    initComponent: function() {
		
        this.columns = [{
			header: 'Id',  
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
			header: 'Is 1:1', 
			dataIndex: 'is11',  
			flex: 1, 
//			xtype: 'checkcolumn',
//			hideable: false, 
//			hidden: true,
			renderer: this.renderBoolean
		}];
	
		this.callParent(arguments);
    }
});
