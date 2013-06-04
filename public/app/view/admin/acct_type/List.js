Ext.define('Budget.view.admin.acct_type.List' ,{
    extend: 'Budget.view.abstract.List',
    
	alias: 'widget.accttypelist',

    title: 'All accountiong types',

	store: 'Accttypes',
	
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
			header: 'Type',  
			dataIndex: 'type',  
			flex: 1,
			editable: true
		}, {
			header: 'Is 1:1', 
			dataIndex: 'is11',  
			flex: 1, 
//			xtype: 'checkcolumn',
//			hideable: false, 
//			hidden: true,
			renderer: function(val) {
				return (val == 1) ? 'yes':'no';
			}
		}];
	
		this.callParent(arguments);
    }
});