Ext.define('Budget.view.conto.List' ,{
    extend: 'Budget.view.abstract.List',
    alias: 'widget.contolist',

    title: 'All bills',

	store: 'Contos',
	
	placeDeleteColumn: false,
	
    initComponent: function() {
		
		this.columns = [{
			header: 'Id',  
			dataIndex: 'id',  
			flex: 1, 
			hideable: false, 
			hidden: true
		}, {
			header: 'Income',  
			dataIndex: 'income',  
			flex: 1, 
			hideable: true
		}, {
			header: 'Outcome',  
			dataIndex: 'outcome',  
			flex: 1, 
			hideable: true
		}, {
			header: 'Entry Time',  
			dataIndex: 'entryTime',  
			flex: 1, 
			hideable: true
		}, {
			header: 'Update Time',  
			dataIndex: 'updateTime',  
			flex: 1, 
			hideable: true,
			hidden: true
		}, {
			header: 'Is 1:1',  
			dataIndex: 'is11',  
			flex: 1, 
			hideable: true,
			hidden: true
		}, {
			header: 'Type',  
			dataIndex: 'type',  
			flex: 1, 
			hideable: true
		}, {
			header: 'Note',  
			dataIndex: 'note',  
			flex: 1, 
			hideable: true,
			hidden: true
		}, {
			header: 'User',  
			dataIndex: 'user',  
			flex: 1, 
			hideable: false,
			hidden: true
		}, {
			header: 'Company',  
			dataIndex: 'company',  
			flex: 1, 
			hideable: false,
			hidden: true
		}];
		
        this.callParent(arguments);
    },
	
	getButtons: function() {
		return {
			xtype: "toolbar",
			items : ["->", {
				text: "Add income",
				iconCls: "add-icon",
				action: "add_income"
			}, {
				text: "Add outcome",
				iconCls: "delete-icon",
				action: "add_income"
			}]
		};
	}
});
