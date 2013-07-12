Ext.define('Budget.view.conto.View' ,{
	extend: 'Budget.view.abstract.Edit',
	alias: 'widget.contoview',

	store: ['Contos', 'Users', 'Companies'],
	
	viewTitle: 'View conto',
	autoShow: false,
	
    initComponent: function() {
		
		this.title = this.viewTitle;
		this.buttons = [{
			text: 'Close',
			scope: this,
			handler: this.close
		}];
	
		var tpl = new Ext.XTemplate(
			'<tpl for=".">',
			'<table>',
			'	<tr>',
			'		<td style="font-weight:bold">Type: </td> <td style="float:right;padding: 1px">{type.name} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Income: </td> <td style="float:right;padding: 1px">{[this.renderValue(values.income)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Outcome: </td> <td style="float:right;padding: 1px">{[this.renderValue(values.outcome)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">User: </td> <td style="float:right;padding: 1px">{[this.getUserFullName(values.user)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Company: </td> <td style="float:right;padding: 1px">{company.name} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Entry time: </td> <td style="float:right;padding: 1px">{[this.renderDateTime(values.entryTime)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Execution date: </td> <td style="float:right;padding: 1px">{[this.renderDate(values.executionDate)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold;vertical-align: top;">Note: </td> <td style="float:right;padding: 1px">{[this.renderNote(values.note)]} </td>',
			'	</tr>',
			'</table>',
			'</tpl>',
			{
				disableFormats: true,
				getUserFullName: function(user) {
					return user.firstName+" "+user.lastName;
				},
				renderDate: function(date_obj) {
					var dt = new Date(date_obj.date);
					return Ext.Date.format(dt, 'd. m. Y.');
				},
				renderDateTime: function(datetime_obj) {
					var dt = new Date(datetime_obj.date);
					return Ext.Date.format(dt, 'd. m. Y. H:i:s');
				},
				renderValue: function(value) {
					return (value) ? value : '-';
				},
				renderNote: function(note) {
					return Ext.util.Format.nl2br(note);
				}
			}
		);
        this.items = [{
			xtype: 'panel',
			autoScroll: true,
			frame: false,
			bodyPadding: 7,
			
			tpl: tpl
		}];

		this.callParent(arguments);
	}
});
