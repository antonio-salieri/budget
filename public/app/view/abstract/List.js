Ext.define('Budget.view.abstract.List' ,{
    extend: 'Ext.grid.Panel',

    title: '',

	store: '',
	
	placeDeleteColumn: true,
	
    initComponent: function() {
		this.bbar = {
			xtype: "pagingtoolbar",
			store : this.store,
			displayInfo : true,
			displayMsg : "Displaying topics {0} - {1} of {2}",
			emptyMsg : "No topics to display",
			items : ["-"]
		};
		
		this.buttons = this.getButtons();
		
		if (this.placeDeleteColumn)
		{
			var delete_column = {
				xtype: "actioncolumn",
				width: 25,
				items: [{
					iconCls: "delete-icon",
					tooltip: "Delete",
					action: "deleteitem",
					title: "header",
					handler : function (grid, rowIndex, colIndex) {
						var rec = grid.getStore().getAt(rowIndex);
						var response = Ext.Msg.show({
							title:'Confirm deletion!',
							msg: 'Are you sure that you want to remove selected item?',
							buttons: Ext.Msg.YESNO,
							icon: Ext.Msg.QUESTION,
							fn: function(button_id, text, opt) {
								if (button_id == 'yes')
								{
									grid.getStore().remove(rec);
									grid.getStore().sync();
								}
							}
						});
					}
				}]
			};
			this.columns.push(delete_column);
		}
		
        this.callParent(arguments);
		this.on('afterrender', this.loadStore, this);
    },

	renderBoolean: function(val) {
		return (val == 1) ? 'yes':'no';
	},
		
	renderDateTime: function(date_obj) {
		var dt = new Date(date_obj.date);
		return Ext.Date.format(dt, 'd. m. Y. H:i:s');
	},

	renderDate: function(date_obj) {
		var dt = new Date(date_obj.date);
		return Ext.Date.format(dt, 'd. m. Y.');
	},
	
	renderName: function(val_obj) {
		if (! val_obj) {
			return '-';
		} else  if (val_obj.name) {
			return val_obj.name;
		} else if (val_obj.firstName && val_obj.lastName) {
			return val_obj.firstName+' '+val_obj.lastName;
		}
	},
	
	getButtons: function() {
		return {
			xtype: "toolbar",
			items : ["->", {
				text: "Add",
//				iconCls: "default-icon",
				action: "add"
			}]
		};
	},
	
	loadStore: function() {
		if (this.store) {
			this.store.load();
		}
	}
	
});
