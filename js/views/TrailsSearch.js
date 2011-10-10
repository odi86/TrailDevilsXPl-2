/**
 * @class traildevils.views.TrailsSerach
 * @extends Ext.form.Search
 * 
 */

traildevils.views.TrailsSearch = Ext.extend(Ext.form.Search, {
	placeHolder: 'Suche...',
	
	initComponent: function() {
		var _trailsStore = Ext.getStore('Trails');
		Ext.apply(this, {
            listeners: {
				scope: this,
				keyup: function(field) {
					var value = field.getValue();
					
					if (!value) {
						_trailsStore.filterBy(function() {
							return true;
						});
					} else {
						var searches = value.split(' '), regexps  = [], i;
						
						for (i = 0; i < searches.length; i++) {
							if (!searches[i]) {
								return;
							}
							regexps.push(new RegExp(searches[i], 'i'));
						};
						
						_trailsStore.filterBy(function(record) {
							var matched = [];

							for (i = 0; i < regexps.length; i++) {
								var search = regexps[i];

								if (record.get('description').match(search) || record.get('title').match(search)) matched.push(true);
								else matched.push(false);
							};

							if (regexps.length > 1 && matched.indexOf(false) != -1) {
								return false;
							} else {
								return matched[0];
							}
						});
					}
				}
			}
        });
		
        traildevils.views.TrailsSearch.superclass.initComponent.apply(this, arguments);
    }			
});

// Create xtype trailsSearch
Ext.reg('trailsSearch', traildevils.views.TrailsSearch);