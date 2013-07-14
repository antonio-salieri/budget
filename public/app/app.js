Ext.BLANK_IMAGE_URL = '/img/s.gif';


Ext.Ajax.on("requestcomplete", function(oConn, oResp, oOpts) {
    var oData = Ext.decode(oResp.responseText);
    if (Ext.type(oData) === 'object' && !oData.success) {
		if (oData.msg) {
            Ext.Msg.show({title: 'Greška!',msg: oData.msg,icon: Ext.MessageBox.ERROR,buttons: Ext.Msg.OK});
            return false;
        } else {
            Ext.Msg.show({title: 'Greška na serveru',msg: 'Nedefinisana greška', icon: Ext.MessageBox.ERROR,buttons: Ext.Msg.OK});
            return false;
        }
    }
});

Ext.Ajax.on("requestexception", 
	function(oConn, oResp, oOpts) {
		if (oResp.isTimeout && oResp.isAbort) {
			Ext.Msg.show({title: "Greška pri dobavljanju podataka sa servera.",msg: "Isteklo je dozvoljeno vreme od " + oConn.timeout / 1000 + "s za preuzimanje podataka",icon: Ext.MessageBox.ERROR,buttons: Ext.Msg.OK});
			return false;
		} else if (oResp.status !== 200) {
			Ext.Msg.show({title: "Server error: " + oResp.statusText,icon: Ext.MessageBox.ERROR,buttons: Ext.Msg.OK});
			return false;
		}
	}
);


Ext.application({
	name: 'Budget',    
	autoCreateViewport: true,
	launch : function () {
		Budget.App = this;
		Ext.get("loading").remove();
	},
	
	paths: {
		'Budget' : '/app',
		'Ext.ux' : '/js/extjs/ux'
	},
	
	models: ['Company', 'Conto', 'User', 'Accttype'],
	stores: ['Companies', 'Contos', 'Users', 'Accttypes'],
	controllers: ['BudgetMenu', 'Conto', 'Company', 'User', 'Accttype']
});
