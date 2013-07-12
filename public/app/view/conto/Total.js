Ext.define('Budget.view.conto.Total' ,{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contototal',

	frame: false,
	bodyPadding: 5,
	
	baseTitle: 'Totals',
	
    initComponent: function() {
		
		this.title = this.baseTitle;
		this.tpl = this.getTplDefinition();
		
		this.callParent(arguments);
		
	},
	
	getTplDefinition: function() {
		return new Ext.XTemplate(
			'<tpl for=".">',
			'<table>',
			'	<tr>',
			'		<td style="font-weight:bold">Total income: </td> <td style="float:right;padding: 1px">{[this.renderValue(values.income)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">Total outcome: </td> <td style="float:right;padding: 1px">{[this.renderValue(values.outcome)]} </td>',
			'	</tr>',
			'	<tr>',
			'		<td style="font-weight:bold">TOTAL BALANCE: </td> <td style="float:right;padding: 1px">{[this.renderValue(values.balance)]} </td>',
			'	</tr>',
			'</table>',
			'</tpl>',
			{
				disableFormats: true,
				renderValue: function(value) {
					return (value) ? Ext.util.Format.currency(value) : '-';
				}
			}
		);
	}
});
