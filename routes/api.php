<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Files
    Route::post('files/media', 'FilesApiController@storeMedia')->name('files.storeMedia');
    Route::apiResource('files', 'FilesApiController');

    // Fields
    Route::apiResource('fields', 'FieldsApiController');

    // Form Blocs
    Route::apiResource('form-blocs', 'FormBlocsApiController');

    // Languages
    Route::apiResource('languages', 'LanguagesApiController');

    // Suggests
    Route::apiResource('suggests', 'SuggestsApiController');

    // Suggests Values
    Route::apiResource('suggests-values', 'SuggestsValuesApiController');

    // Entities
    Route::apiResource('entities', 'EntitiesApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Entities Files
    Route::apiResource('entities-files', 'EntitiesFilesApiController');

    // Entities Fields
    Route::apiResource('entities-fields', 'EntitiesFieldsApiController');

    // Taxonomy
    Route::apiResource('taxonomies', 'TaxonomyApiController');

    // Channels
    Route::apiResource('channels', 'ChannelsApiController');

    // Entities Type
    Route::apiResource('entities-types', 'EntitiesTypeApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Fyles Type
    Route::apiResource('fyles-types', 'FylesTypeApiController');

    // Variations
    Route::apiResource('variations', 'VariationsApiController');

    // Entities Versioning
    Route::apiResource('entities-versionings', 'EntitiesVersioningApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Localization
    Route::apiResource('localizations', 'LocalizationApiController');

    // Entities Rewards
    Route::apiResource('entities-rewards', 'EntitiesRewardsApiController');

    // Entities Press
    Route::apiResource('entities-presses', 'EntitiesPressApiController');

    // Files Type
    Route::apiResource('files-types', 'FilesTypeApiController');
});
