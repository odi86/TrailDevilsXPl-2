/**
 * This file sets up the TrailDevils application. We register an application called 'traildevils' - this automatically sets up
 * a global variable with the same name.
 * 
 */ 
Ext.regApplication({
	name: 'traildevils',
	tabletStartupScreen: 'view/images/phone_startup.jpg',
	phoneStartupScreen: 'view/images/phone_startup.jpg',
	icon: 'view/images/app_icon.jpg',
	glossOnIcon: true,
	defaultUrl: 'TrailsListController/index',
	statusBarStyle: 'black',
	fullscreen: true,
	
	launch: function() {
		traildevils.views.viewport = new traildevils.views.Viewport();
		
		// viewport Components
		traildevils.views.trailsListMainPanel = traildevils.views.viewport.getComponent('trailsListMainPanel');
		
		// trailsListMainPanel Components
		traildevils.views.trailsListPanel = traildevils.views.trailsListMainPanel.getComponent('trailsListPanel');
		
		// trailsListPanel Components
		traildevils.views.trailsList = traildevils.views.trailsListPanel.getComponent('trailsList');
	}
});
