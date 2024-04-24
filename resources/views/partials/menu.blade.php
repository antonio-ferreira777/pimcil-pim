<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('entity_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.entities.index") }}" class="nav-link {{ request()->is("admin/entities") || request()->is("admin/entities/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-shopping-cart">

                            </i>
                            <p>
                                {{ trans('cruds.entity.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('file_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.files.index") }}" class="nav-link {{ request()->is("admin/files") || request()->is("admin/files/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-images">

                            </i>
                            <p>
                                {{ trans('cruds.file.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('taxonomy_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.taxonomies.index") }}" class="nav-link {{ request()->is("admin/taxonomies") || request()->is("admin/taxonomies/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-folder">

                            </i>
                            <p>
                                {{ trans('cruds.taxonomy.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('country_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-flag">

                            </i>
                            <p>
                                {{ trans('cruds.country.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('reward_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.rewards.index") }}" class="nav-link {{ request()->is("admin/rewards") || request()->is("admin/rewards/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.reward.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('region_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.regions.index") }}" class="nav-link {{ request()->is("admin/regions") || request()->is("admin/regions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.region.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('winemaker_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.winemakers.index") }}" class="nav-link {{ request()->is("admin/winemakers") || request()->is("admin/winemakers/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.winemaker.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('grape_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.grapes.index") }}" class="nav-link {{ request()->is("admin/grapes") || request()->is("admin/grapes/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.grape.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }} {{ request()->is("admin/user-alerts*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }} {{ request()->is("admin/teams*") ? "active" : "" }} {{ request()->is("admin/user-alerts*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.team.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bell">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userAlert.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('basic_c_r_m_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/crm-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/crm-customers*") ? "menu-open" : "" }} {{ request()->is("admin/crm-notes*") ? "menu-open" : "" }} {{ request()->is("admin/crm-documents*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/crm-statuses*") ? "active" : "" }} {{ request()->is("admin/crm-customers*") ? "active" : "" }} {{ request()->is("admin/crm-notes*") ? "active" : "" }} {{ request()->is("admin/crm-documents*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.basicCRM.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('crm_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-statuses.index") }}" class="nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-customers.index") }}" class="nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmCustomer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-notes.index") }}" class="nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sticky-note">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-documents.index") }}" class="nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/faq-categories*") ? "active" : "" }} {{ request()->is("admin/faq-questions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin_setting_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/languages*") ? "menu-open" : "" }} {{ request()->is("admin/channels*") ? "menu-open" : "" }} {{ request()->is("admin/form-blocs*") ? "menu-open" : "" }} {{ request()->is("admin/fields*") ? "menu-open" : "" }} {{ request()->is("admin/suggests*") ? "menu-open" : "" }} {{ request()->is("admin/suggests-values*") ? "menu-open" : "" }} {{ request()->is("admin/statuses*") ? "menu-open" : "" }} {{ request()->is("admin/entities-types*") ? "menu-open" : "" }} {{ request()->is("admin/entities-fields*") ? "menu-open" : "" }} {{ request()->is("admin/entities-files*") ? "menu-open" : "" }} {{ request()->is("admin/variations*") ? "menu-open" : "" }} {{ request()->is("admin/entities-versionings*") ? "menu-open" : "" }} {{ request()->is("admin/localizations*") ? "menu-open" : "" }} {{ request()->is("admin/entities-rewards*") ? "menu-open" : "" }} {{ request()->is("admin/entities-presses*") ? "menu-open" : "" }} {{ request()->is("admin/files-types*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/languages*") ? "active" : "" }} {{ request()->is("admin/channels*") ? "active" : "" }} {{ request()->is("admin/form-blocs*") ? "active" : "" }} {{ request()->is("admin/fields*") ? "active" : "" }} {{ request()->is("admin/suggests*") ? "active" : "" }} {{ request()->is("admin/suggests-values*") ? "active" : "" }} {{ request()->is("admin/statuses*") ? "active" : "" }} {{ request()->is("admin/entities-types*") ? "active" : "" }} {{ request()->is("admin/entities-fields*") ? "active" : "" }} {{ request()->is("admin/entities-files*") ? "active" : "" }} {{ request()->is("admin/variations*") ? "active" : "" }} {{ request()->is("admin/entities-versionings*") ? "active" : "" }} {{ request()->is("admin/localizations*") ? "active" : "" }} {{ request()->is("admin/entities-rewards*") ? "active" : "" }} {{ request()->is("admin/entities-presses*") ? "active" : "" }} {{ request()->is("admin/files-types*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.adminSetting.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('language_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.languages.index") }}" class="nav-link {{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.language.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('channel_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.channels.index") }}" class="nav-link {{ request()->is("admin/channels") || request()->is("admin/channels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.channel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('form_bloc_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.form-blocs.index") }}" class="nav-link {{ request()->is("admin/form-blocs") || request()->is("admin/form-blocs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.formBloc.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('field_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.fields.index") }}" class="nav-link {{ request()->is("admin/fields") || request()->is("admin/fields/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cog">

                                        </i>
                                        <p>
                                            {{ trans('cruds.field.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('suggest_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.suggests.index") }}" class="nav-link {{ request()->is("admin/suggests") || request()->is("admin/suggests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.suggest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('suggests_value_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.suggests-values.index") }}" class="nav-link {{ request()->is("admin/suggests-values") || request()->is("admin/suggests-values/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.suggestsValue.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.statuses.index") }}" class="nav-link {{ request()->is("admin/statuses") || request()->is("admin/statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.status.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-types.index") }}" class="nav-link {{ request()->is("admin/entities-types") || request()->is("admin/entities-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_field_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-fields.index") }}" class="nav-link {{ request()->is("admin/entities-fields") || request()->is("admin/entities-fields/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesField.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_file_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-files.index") }}" class="nav-link {{ request()->is("admin/entities-files") || request()->is("admin/entities-files/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesFile.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('variation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.variations.index") }}" class="nav-link {{ request()->is("admin/variations") || request()->is("admin/variations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.variation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_versioning_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-versionings.index") }}" class="nav-link {{ request()->is("admin/entities-versionings") || request()->is("admin/entities-versionings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesVersioning.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('localization_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.localizations.index") }}" class="nav-link {{ request()->is("admin/localizations") || request()->is("admin/localizations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.localization.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_reward_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-rewards.index") }}" class="nav-link {{ request()->is("admin/entities-rewards") || request()->is("admin/entities-rewards/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesReward.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('entities_press_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.entities-presses.index") }}" class="nav-link {{ request()->is("admin/entities-presses") || request()->is("admin/entities-presses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.entitiesPress.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('files_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.files-types.index") }}" class="nav-link {{ request()->is("admin/files-types") || request()->is("admin/files-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.filesType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                        <li class="nav-item">
                            <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                                <i class="fa-fw fa fa-users nav-icon">
                                </i>
                                <p>
                                    {{ trans("global.team-members") }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>