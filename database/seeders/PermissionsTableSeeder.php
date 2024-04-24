<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'team_create',
            ],
            [
                'id'    => 20,
                'title' => 'team_edit',
            ],
            [
                'id'    => 21,
                'title' => 'team_show',
            ],
            [
                'id'    => 22,
                'title' => 'team_delete',
            ],
            [
                'id'    => 23,
                'title' => 'team_access',
            ],
            [
                'id'    => 24,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 27,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 28,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 29,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 32,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 33,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 34,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 38,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 39,
                'title' => 'file_create',
            ],
            [
                'id'    => 40,
                'title' => 'file_edit',
            ],
            [
                'id'    => 41,
                'title' => 'file_show',
            ],
            [
                'id'    => 42,
                'title' => 'file_delete',
            ],
            [
                'id'    => 43,
                'title' => 'file_access',
            ],
            [
                'id'    => 44,
                'title' => 'field_create',
            ],
            [
                'id'    => 45,
                'title' => 'field_edit',
            ],
            [
                'id'    => 46,
                'title' => 'field_show',
            ],
            [
                'id'    => 47,
                'title' => 'field_delete',
            ],
            [
                'id'    => 48,
                'title' => 'field_access',
            ],
            [
                'id'    => 49,
                'title' => 'admin_setting_access',
            ],
            [
                'id'    => 50,
                'title' => 'form_bloc_create',
            ],
            [
                'id'    => 51,
                'title' => 'form_bloc_edit',
            ],
            [
                'id'    => 52,
                'title' => 'form_bloc_show',
            ],
            [
                'id'    => 53,
                'title' => 'form_bloc_delete',
            ],
            [
                'id'    => 54,
                'title' => 'form_bloc_access',
            ],
            [
                'id'    => 55,
                'title' => 'language_create',
            ],
            [
                'id'    => 56,
                'title' => 'language_edit',
            ],
            [
                'id'    => 57,
                'title' => 'language_show',
            ],
            [
                'id'    => 58,
                'title' => 'language_delete',
            ],
            [
                'id'    => 59,
                'title' => 'language_access',
            ],
            [
                'id'    => 60,
                'title' => 'suggest_create',
            ],
            [
                'id'    => 61,
                'title' => 'suggest_edit',
            ],
            [
                'id'    => 62,
                'title' => 'suggest_show',
            ],
            [
                'id'    => 63,
                'title' => 'suggest_delete',
            ],
            [
                'id'    => 64,
                'title' => 'suggest_access',
            ],
            [
                'id'    => 65,
                'title' => 'suggests_value_create',
            ],
            [
                'id'    => 66,
                'title' => 'suggests_value_edit',
            ],
            [
                'id'    => 67,
                'title' => 'suggests_value_show',
            ],
            [
                'id'    => 68,
                'title' => 'suggests_value_delete',
            ],
            [
                'id'    => 69,
                'title' => 'suggests_value_access',
            ],
            [
                'id'    => 70,
                'title' => 'entity_create',
            ],
            [
                'id'    => 71,
                'title' => 'entity_edit',
            ],
            [
                'id'    => 72,
                'title' => 'entity_show',
            ],
            [
                'id'    => 73,
                'title' => 'entity_delete',
            ],
            [
                'id'    => 74,
                'title' => 'entity_access',
            ],
            [
                'id'    => 75,
                'title' => 'status_create',
            ],
            [
                'id'    => 76,
                'title' => 'status_edit',
            ],
            [
                'id'    => 77,
                'title' => 'status_show',
            ],
            [
                'id'    => 78,
                'title' => 'status_delete',
            ],
            [
                'id'    => 79,
                'title' => 'status_access',
            ],
            [
                'id'    => 80,
                'title' => 'entities_file_create',
            ],
            [
                'id'    => 81,
                'title' => 'entities_file_edit',
            ],
            [
                'id'    => 82,
                'title' => 'entities_file_show',
            ],
            [
                'id'    => 83,
                'title' => 'entities_file_delete',
            ],
            [
                'id'    => 84,
                'title' => 'entities_file_access',
            ],
            [
                'id'    => 85,
                'title' => 'entities_field_create',
            ],
            [
                'id'    => 86,
                'title' => 'entities_field_edit',
            ],
            [
                'id'    => 87,
                'title' => 'entities_field_show',
            ],
            [
                'id'    => 88,
                'title' => 'entities_field_delete',
            ],
            [
                'id'    => 89,
                'title' => 'entities_field_access',
            ],
            [
                'id'    => 90,
                'title' => 'taxonomy_create',
            ],
            [
                'id'    => 91,
                'title' => 'taxonomy_edit',
            ],
            [
                'id'    => 92,
                'title' => 'taxonomy_show',
            ],
            [
                'id'    => 93,
                'title' => 'taxonomy_delete',
            ],
            [
                'id'    => 94,
                'title' => 'taxonomy_access',
            ],
            [
                'id'    => 95,
                'title' => 'channel_create',
            ],
            [
                'id'    => 96,
                'title' => 'channel_edit',
            ],
            [
                'id'    => 97,
                'title' => 'channel_show',
            ],
            [
                'id'    => 98,
                'title' => 'channel_delete',
            ],
            [
                'id'    => 99,
                'title' => 'channel_access',
            ],
            [
                'id'    => 100,
                'title' => 'entities_type_create',
            ],
            [
                'id'    => 101,
                'title' => 'entities_type_edit',
            ],
            [
                'id'    => 102,
                'title' => 'entities_type_show',
            ],
            [
                'id'    => 103,
                'title' => 'entities_type_delete',
            ],
            [
                'id'    => 104,
                'title' => 'entities_type_access',
            ],
            [
                'id'    => 105,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 106,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 107,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 108,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 109,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 110,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 111,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 112,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 113,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 114,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 115,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 116,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 117,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 118,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 119,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 120,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 121,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 122,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 123,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 124,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 125,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 126,
                'title' => 'fyles_type_create',
            ],
            [
                'id'    => 127,
                'title' => 'fyles_type_edit',
            ],
            [
                'id'    => 128,
                'title' => 'fyles_type_show',
            ],
            [
                'id'    => 129,
                'title' => 'fyles_type_delete',
            ],
            [
                'id'    => 130,
                'title' => 'fyles_type_access',
            ],
            [
                'id'    => 131,
                'title' => 'variation_create',
            ],
            [
                'id'    => 132,
                'title' => 'variation_edit',
            ],
            [
                'id'    => 133,
                'title' => 'variation_show',
            ],
            [
                'id'    => 134,
                'title' => 'variation_delete',
            ],
            [
                'id'    => 135,
                'title' => 'variation_access',
            ],
            [
                'id'    => 136,
                'title' => 'entities_versioning_create',
            ],
            [
                'id'    => 137,
                'title' => 'entities_versioning_edit',
            ],
            [
                'id'    => 138,
                'title' => 'entities_versioning_show',
            ],
            [
                'id'    => 139,
                'title' => 'entities_versioning_delete',
            ],
            [
                'id'    => 140,
                'title' => 'entities_versioning_access',
            ],
            [
                'id'    => 141,
                'title' => 'country_create',
            ],
            [
                'id'    => 142,
                'title' => 'country_edit',
            ],
            [
                'id'    => 143,
                'title' => 'country_show',
            ],
            [
                'id'    => 144,
                'title' => 'country_delete',
            ],
            [
                'id'    => 145,
                'title' => 'country_access',
            ],
            [
                'id'    => 146,
                'title' => 'localization_create',
            ],
            [
                'id'    => 147,
                'title' => 'localization_edit',
            ],
            [
                'id'    => 148,
                'title' => 'localization_show',
            ],
            [
                'id'    => 149,
                'title' => 'localization_delete',
            ],
            [
                'id'    => 150,
                'title' => 'localization_access',
            ],
            [
                'id'    => 151,
                'title' => 'reward_create',
            ],
            [
                'id'    => 152,
                'title' => 'reward_edit',
            ],
            [
                'id'    => 153,
                'title' => 'reward_show',
            ],
            [
                'id'    => 154,
                'title' => 'reward_delete',
            ],
            [
                'id'    => 155,
                'title' => 'reward_access',
            ],
            [
                'id'    => 156,
                'title' => 'entities_reward_create',
            ],
            [
                'id'    => 157,
                'title' => 'entities_reward_edit',
            ],
            [
                'id'    => 158,
                'title' => 'entities_reward_show',
            ],
            [
                'id'    => 159,
                'title' => 'entities_reward_delete',
            ],
            [
                'id'    => 160,
                'title' => 'entities_reward_access',
            ],
            [
                'id'    => 161,
                'title' => 'entities_press_create',
            ],
            [
                'id'    => 162,
                'title' => 'entities_press_edit',
            ],
            [
                'id'    => 163,
                'title' => 'entities_press_show',
            ],
            [
                'id'    => 164,
                'title' => 'entities_press_delete',
            ],
            [
                'id'    => 165,
                'title' => 'entities_press_access',
            ],
            [
                'id'    => 166,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
