Ext.define('Budget.view.admin.user.List' ,{
    extend: 'Budget.view.abstract.List',
    alias: 'widget.userlist',

    title: 'All Users',

	store: 'Users',
	
    initComponent: function() {
        this.columns = [{
			header: 'Id',  
			dataIndex: 'id',  
			flex: 1, 
			hideable: false, 
			hidden: true
		}, {
			header: 'First Name',
			dataIndex: 'firstName',
			flex: 1
		}, {
			header: 'Last Name',
			dataIndex: 'lastName',  
			flex: 1
		}];
		
        this.callParent(arguments);
    }
});
