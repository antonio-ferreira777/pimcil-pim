<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Files
    Route::delete('files/destroy', 'FilesController@massDestroy')->name('files.massDestroy');
    Route::post('files/media', 'FilesController@storeMedia')->name('files.storeMedia');
    Route::post('files/ckmedia', 'FilesController@storeCKEditorImages')->name('files.storeCKEditorImages');
    Route::resource('files', 'FilesController');

    // Fields
    Route::delete('fields/destroy', 'FieldsController@massDestroy')->name('fields.massDestroy');
    Route::resource('fields', 'FieldsController');

    // Form Blocs
    Route::delete('form-blocs/destroy', 'FormBlocsController@massDestroy')->name('form-blocs.massDestroy');
    Route::resource('form-blocs', 'FormBlocsController');

    // Languages
    Route::delete('languages/destroy', 'LanguagesController@massDestroy')->name('languages.massDestroy');
    Route::resource('languages', 'LanguagesController');

    // Suggests
    Route::delete('suggests/destroy', 'SuggestsController@massDestroy')->name('suggests.massDestroy');
    Route::resource('suggests', 'SuggestsController');

    // Suggests Values
    Route::delete('suggests-values/destroy', 'SuggestsValuesController@massDestroy')->name('suggests-values.massDestroy');
    Route::resource('suggests-values', 'SuggestsValuesController');

    // Entities
    Route::delete('entities/destroy', 'EntitiesController@massDestroy')->name('entities.massDestroy');
    Route::resource('entities', 'EntitiesController');

    // Status
    Route::delete('statuses/destroy', 'StatusController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusController');

    // Entities Files
    Route::delete('entities-files/destroy', 'EntitiesFilesController@massDestroy')->name('entities-files.massDestroy');
    Route::resource('entities-files', 'EntitiesFilesController');

    // Entities Fields
    Route::delete('entities-fields/destroy', 'EntitiesFieldsController@massDestroy')->name('entities-fields.massDestroy');
    Route::resource('entities-fields', 'EntitiesFieldsController');

    // Taxonomy
    Route::delete('taxonomies/destroy', 'TaxonomyController@massDestroy')->name('taxonomies.massDestroy');
    Route::resource('taxonomies', 'TaxonomyController');

    // Channels
    Route::delete('channels/destroy', 'ChannelsController@massDestroy')->name('channels.massDestroy');
    Route::resource('channels', 'ChannelsController');

    // Entities Type
    Route::delete('entities-types/destroy', 'EntitiesTypeController@massDestroy')->name('entities-types.massDestroy');
    Route::resource('entities-types', 'EntitiesTypeController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Fyles Type
    Route::delete('fyles-types/destroy', 'FylesTypeController@massDestroy')->name('fyles-types.massDestroy');
    Route::resource('fyles-types', 'FylesTypeController');

    // Variations
    Route::delete('variations/destroy', 'VariationsController@massDestroy')->name('variations.massDestroy');
    Route::resource('variations', 'VariationsController');

    // Entities Versioning
    Route::delete('entities-versionings/destroy', 'EntitiesVersioningController@massDestroy')->name('entities-versionings.massDestroy');
    Route::resource('entities-versionings', 'EntitiesVersioningController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Localization
    Route::delete('localizations/destroy', 'LocalizationController@massDestroy')->name('localizations.massDestroy');
    Route::resource('localizations', 'LocalizationController');

    // Rewards
    Route::delete('rewards/destroy', 'RewardsController@massDestroy')->name('rewards.massDestroy');
    Route::post('rewards/media', 'RewardsController@storeMedia')->name('rewards.storeMedia');
    Route::post('rewards/ckmedia', 'RewardsController@storeCKEditorImages')->name('rewards.storeCKEditorImages');
    Route::resource('rewards', 'RewardsController');

    // Entities Rewards
    Route::delete('entities-rewards/destroy', 'EntitiesRewardsController@massDestroy')->name('entities-rewards.massDestroy');
    Route::resource('entities-rewards', 'EntitiesRewardsController');

    // Entities Press
    Route::delete('entities-presses/destroy', 'EntitiesPressController@massDestroy')->name('entities-presses.massDestroy');
    Route::resource('entities-presses', 'EntitiesPressController');

    // Regions
    Route::delete('regions/destroy', 'RegionsController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionsController');

    // Winemakers
    Route::delete('winemakers/destroy', 'WinemakersController@massDestroy')->name('winemakers.massDestroy');
    Route::post('winemakers/media', 'WinemakersController@storeMedia')->name('winemakers.storeMedia');
    Route::post('winemakers/ckmedia', 'WinemakersController@storeCKEditorImages')->name('winemakers.storeCKEditorImages');
    Route::resource('winemakers', 'WinemakersController');

    // Files Type
    Route::delete('files-types/destroy', 'FilesTypeController@massDestroy')->name('files-types.massDestroy');
    Route::resource('files-types', 'FilesTypeController');

    // Grapes
    Route::delete('grapes/destroy', 'GrapesController@massDestroy')->name('grapes.massDestroy');
    Route::post('grapes/media', 'GrapesController@storeMedia')->name('grapes.storeMedia');
    Route::post('grapes/ckmedia', 'GrapesController@storeCKEditorImages')->name('grapes.storeCKEditorImages');
    Route::resource('grapes', 'GrapesController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
