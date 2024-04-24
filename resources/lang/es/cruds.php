<?php

return [
    'userManagement' => [
        'title'          => 'Gestionar usuarios',
        'title_singular' => 'Gestionar usuarios',
    ],
    'permission' => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'team' => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'file' => [
        'title'          => 'Files',
        'title_singular' => 'File',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'path'              => 'Path',
            'path_helper'       => ' ',
            'ext'               => 'Ext',
            'ext_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'file'              => 'File',
            'file_helper'       => ' ',
            'size'              => 'Size',
            'size_helper'       => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
        ],
    ],
    'field' => [
        'title'          => 'Fields',
        'title_singular' => 'Field',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'name'                           => 'Name',
            'name_helper'                    => ' ',
            'description'                    => 'Description',
            'description_helper'             => ' ',
            'type'                           => 'Type',
            'type_helper'                    => ' ',
            'nullable'                       => 'Nullable',
            'nullable_helper'                => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'default'                        => 'Default',
            'default_helper'                 => ' ',
            'form_bloc'                      => 'Form Bloc',
            'form_bloc_helper'               => ' ',
            'status'                         => 'Status',
            'status_helper'                  => ' ',
            'taxonomy'                       => 'Taxonomy',
            'taxonomy_helper'                => ' ',
            'channel'                        => 'Channel',
            'channel_helper'                 => ' ',
            'channels_transversality'        => 'Channels Transversality',
            'channels_transversality_helper' => ' ',
            'language_transversality'        => 'Language Transversality',
            'language_transversality_helper' => ' ',
            'display_order'                  => 'Display Order',
            'display_order_helper'           => ' ',
            'data_source'                    => 'Data Source',
            'data_source_helper'             => ' ',
        ],
    ],
    'adminSetting' => [
        'title'          => 'Admin Settings',
        'title_singular' => 'Admin Setting',
    ],
    'formBloc' => [
        'title'          => 'Form Blocs',
        'title_singular' => 'Form Bloc',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'display_order'        => 'Display Order',
            'display_order_helper' => ' ',
        ],
    ],
    'language' => [
        'title'          => 'Languages',
        'title_singular' => 'Language',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'suggest' => [
        'title'          => 'Suggests',
        'title_singular' => 'Suggest',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'editable'          => 'Editable',
            'editable_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'suggestsValue' => [
        'title'          => 'Suggests Values',
        'title_singular' => 'Suggests Value',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'suggest'           => 'suggest',
            'suggest_helper'    => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'language'          => 'Language',
            'language_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'entity' => [
        'title'          => 'Entities',
        'title_singular' => 'Entity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'ref'               => 'Ref',
            'ref_helper'        => ' ',
            'ean'               => 'Ean',
            'ean_helper'        => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'language'          => 'Language',
            'language_helper'   => ' ',
            'is_master'         => 'Is Master',
            'is_master_helper'  => ' ',
            'valid_from'        => 'Valid From',
            'valid_from_helper' => ' ',
            'valid_to'          => 'Valid To',
            'valid_to_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'taxonomy'          => 'Taxonomy',
            'taxonomy_helper'   => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
        ],
    ],
    'status' => [
        'title'          => 'Status',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'entitiesFile' => [
        'title'          => 'Entities Files',
        'title_singular' => 'Entities File',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'entity'               => 'Entity',
            'entity_helper'        => ' ',
            'file'                 => 'File',
            'file_helper'          => ' ',
            'display_order'        => 'Display Order',
            'display_order_helper' => ' ',
            'is_default'           => 'Is Default',
            'is_default_helper'    => ' ',
            'to_use'               => 'To Use',
            'to_use_helper'        => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'entitiesField' => [
        'title'          => 'Entities Fields',
        'title_singular' => 'Entities Field',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'entity'             => 'Entity',
            'entity_helper'      => ' ',
            'field'              => 'Field',
            'field_helper'       => ' ',
            'field_value'        => 'Field Value',
            'field_value_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'language'           => 'Language',
            'language_helper'    => ' ',
        ],
    ],
    'taxonomy' => [
        'title'          => 'Taxonomy',
        'title_singular' => 'Taxonomy',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'id_parent'          => 'Id Parent',
            'id_parent_helper'   => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'channel' => [
        'title'          => 'Channels',
        'title_singular' => 'Channel',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'entitiesType' => [
        'title'          => 'Entities Type',
        'title_singular' => 'Entities Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'basicCRM' => [
        'title'          => 'Basic CRM',
        'title_singular' => 'Basic CRM',
    ],
    'crmStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'crmCustomer' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'first_name'         => 'First name',
            'first_name_helper'  => ' ',
            'last_name'          => 'Last name',
            'last_name_helper'   => ' ',
            'email'              => 'Email',
            'email_helper'       => ' ',
            'phone'              => 'Phone',
            'phone_helper'       => ' ',
            'address'            => 'Address',
            'address_helper'     => ' ',
            'skype'              => 'Skype',
            'skype_helper'       => ' ',
            'website'            => 'Website',
            'website_helper'     => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
        ],
    ],
    'crmNote' => [
        'title'          => 'Notes',
        'title_singular' => 'Note',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'customer'          => 'Customer',
            'customer_helper'   => ' ',
            'note'              => 'Note',
            'note_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'crmDocument' => [
        'title'          => 'Documents',
        'title_singular' => 'Document',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'customer'             => 'Customer',
            'customer_helper'      => ' ',
            'document_file'        => 'File',
            'document_file_helper' => ' ',
            'name'                 => 'Document name',
            'name_helper'          => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
        ],
    ],
    'fylesType' => [
        'title'          => 'Fyles Type',
        'title_singular' => 'Fyles Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'variation' => [
        'title'          => 'Variations',
        'title_singular' => 'Variation',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'entity'               => 'Entity',
            'entity_helper'        => ' ',
            'field'                => 'Field',
            'field_helper'         => ' ',
            'master_entity'        => 'Master Entity',
            'master_entity_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'entitiesVersioning' => [
        'title'          => 'Entities Versioning',
        'title_singular' => 'Entities Versioning',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'entity'            => 'Entity',
            'entity_helper'     => ' ',
            'values'            => 'Values',
            'values_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'localization' => [
        'title'          => 'Localization',
        'title_singular' => 'Localization',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'data_table'        => 'Data Table',
            'data_table_helper' => ' ',
            'data'              => 'Data',
            'data_helper'       => ' ',
            'data_value'        => 'Data Value',
            'data_value_helper' => ' ',
            'language'          => 'Language',
            'language_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'reward' => [
        'title'          => 'Rewards',
        'title_singular' => 'Reward',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'picto'             => 'Picto',
            'picto_helper'      => ' ',
            'doc'               => 'Doc',
            'doc_helper'        => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'entitiesReward' => [
        'title'          => 'Entities Rewards',
        'title_singular' => 'Entities Reward',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'entity'            => 'Entity',
            'entity_helper'     => ' ',
            'reward'            => 'Reward',
            'reward_helper'     => ' ',
            'year'              => 'Year',
            'year_helper'       => ' ',
            'date'              => 'Date',
            'date_helper'       => ' ',
            'points'            => 'Points',
            'points_helper'     => ' ',
            'comment'           => 'Comment',
            'comment_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'entitiesPress' => [
        'title'          => 'Entities Press',
        'title_singular' => 'Entities Press',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'entity'            => 'Entity',
            'entity_helper'     => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'date'              => 'Date',
            'date_helper'       => ' ',
            'comment'           => 'Comment',
            'comment_helper'    => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

];
