Ext.define('Budget.view.conto.List' ,{
    extend: 'Budget.view.abstract.List',
    alias: 'widget.contolist',

    title: 'All bills',
	deleteColumnTooltip: "Storno",
	store: 'Contos',
	
	viewConfig: {
        getRowClass: function(record) {
            if (record.get('stornoTime') !== null) {
                return 'strike-through-row';
            }
        }
    },
	
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
			align: 'right',
			flex: 1, 
			hideable: true,
			renderer: this.renderIncome,
			style: { color: 'green !important;font-weight: bold !important;' }
		}, {
			header: 'Outcome',  
			dataIndex: 'outcome',  
			align: 'right',
			flex: 1, 
			hideable: true,
			renderer: this.renderOutcome,
			style: { color: 'red !important;font-weight: bold !important;' }
		}, {
			header: 'Entry Time',  
			dataIndex: 'entryTime',  
			flex: 1, 
			hideable: true,
			hidden: true,
			renderer: this.renderDateTime
		}, {
			header: 'Storno Time',  
			dataIndex: 'stornoTime',  
			flex: 1, 
			hideable: true,
			hidden: true,
			renderer: this.renderDateTime
		}, {
			header: 'Execution Date',  
			dataIndex: 'executionDate',  
			flex: 1, 
			hideable: true,
			hidden: false,
			renderer: this.renderDate
		}, {
			header: 'Is 1:1',  
			dataIndex: 'is11',  
			flex: 1, 
			hideable: true,
			hidden: true,
			renderer: this.renderBoolean
		}, {
			header: 'Type',  
			dataIndex: 'type',
			flex: 1, 
			hideable: true,
			sortable: false,
			renderer: this.renderName
		}, {
			header: 'User',  
			dataIndex: 'user',
			flex: 1, 
			hideable: true,
			sortable: false,
			renderer: this.renderName
		}, {
			header: 'Company',  
			dataIndex: 'company',
			flex: 1, 
			hideable: true,
			sortable: false,
			renderer: this.renderName
		}, {
			header: 'Note',  
			dataIndex: 'note',  
			flex: 1, 
			hideable: true,
			hidden: true
		}, {
			header: 'Company',  
			dataIndex: 'company',  
			flex: 1, 
			hideable: false,
			sortable: false,
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
				action: "add_outcome"
			}]
		};
	},
	
//	removeItem: function(grid, rowIndex, colIndex) {
//		var response = Ext.Msg.show({
//			title:'Confirm storno process!',
//			msg: 'Are you sure that you want to storno selected item?',
//			buttons: Ext.Msg.YESNO,
//			icon: Ext.Msg.QUESTION,
//			
//			rowIndex: rowIndex,
//			colIndex: colIndex,
//			grid: grid,
//
//			fn: function(button_id, text, opt) {
//				var rec = grid.getStore().getAt(rowIndex);
//				if (button_id == 'yes')
//				{
//					rec.set('stornoTime', Ext.util.Format.date(new Date(), 'Y-m-d H:i:s'));
//					grid.getStore().synchronize();
//				}
//			}
//		});
//	},
	
	/*
	 * Renderers
	 */
	renderIncome: function(value) {
		return [
			'<span style="color: green!important; font-weight: bold !important;">',
			(value) ? Ext.util.Format.currency(value, ' ') : '-',
			'</span>'
		].join('');
	},
	
	renderOutcome: function(value) {
		return [
			'<span style="color: red !important; font-weight: bold !important;">',
			(value) ? Ext.util.Format.currency(value, ' ') : '-',
			'</span>'
		].join('');
	}
});
