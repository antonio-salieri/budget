Ext.define('Budget.view.conto.View' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.contoview',

	store: ['Contos', 'Users', 'Companies'],
	
	viewTitle: 'View conto',
	
    initComponent: function() {
		
		this.title = this.viewTitle;
		this.buttons = [{
			text: 'Close',
			scope: this,
			handler: this.close
		}];
	
        this.items = [{
			xtype: 'panel',
			frame: true,
			bodyPadding: 7,
			
			tpl: [
				'<span style="font-weight:bold">Type: </span> <span style="float:right">{type} </span><br/>',
				'<span style="font-weight:bold">Income: </span> <span style="float:right">{income} </span><br/>',
				'<span style="font-weight:bold">Outcome: </span> <span style="float:right">{outcome} </span><br/>',
				'<span style="font-weight:bold">User: </span> <span style="float:right">{user} </span><br/>',
				'<span style="font-weight:bold">Company: </span> <span style="float:right">{company} </span><br/>',
				'<span style="font-weight:bold">Entry time: </span> <span style="float:right">{entryTime} </span><br/>',
				'<span style="font-weight:bold">Execution date: </span> <span style="float:right">{executionDate} </span><br/>',
				'<span style="font-weight:bold">Note: </span> <span style="float:right">{note} </span><br/>'
			]
		}];

		this.callParent(arguments);
	}
});
