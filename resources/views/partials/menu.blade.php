<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('entity_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.entities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities") || request()->is("admin/entities/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.entity.title') }}
                </a>
            </li>
        @endcan
        @can('file_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.files.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/files") || request()->is("admin/files/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-images c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.file.title') }}
                </a>
            </li>
        @endcan
        @can('taxonomy_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.taxonomies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/taxonomies") || request()->is("admin/taxonomies/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taxonomy.title') }}
                </a>
            </li>
        @endcan
        @can('basic_c_r_m_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/crm-statuses*") ? "c-show" : "" }} {{ request()->is("admin/crm-customers*") ? "c-show" : "" }} {{ request()->is("admin/crm-notes*") ? "c-show" : "" }} {{ request()->is("admin/crm-documents*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.basicCRM.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('crm_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_customer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmCustomer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmNote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_document_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmDocument.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('admin_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/languages*") ? "c-show" : "" }} {{ request()->is("admin/channels*") ? "c-show" : "" }} {{ request()->is("admin/form-blocs*") ? "c-show" : "" }} {{ request()->is("admin/fields*") ? "c-show" : "" }} {{ request()->is("admin/suggests*") ? "c-show" : "" }} {{ request()->is("admin/suggests-values*") ? "c-show" : "" }} {{ request()->is("admin/statuses*") ? "c-show" : "" }} {{ request()->is("admin/entities-types*") ? "c-show" : "" }} {{ request()->is("admin/entities-fields*") ? "c-show" : "" }} {{ request()->is("admin/entities-files*") ? "c-show" : "" }} {{ request()->is("admin/fyles-types*") ? "c-show" : "" }} {{ request()->is("admin/variations*") ? "c-show" : "" }} {{ request()->is("admin/entities-versionings*") ? "c-show" : "" }} {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/localizations*") ? "c-show" : "" }} {{ request()->is("admin/rewards*") ? "c-show" : "" }} {{ request()->is("admin/entities-rewards*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.adminSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('language_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.languages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.language.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('channel_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.channels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/channels") || request()->is("admin/channels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.channel.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('form_bloc_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.form-blocs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/form-blocs") || request()->is("admin/form-blocs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.formBloc.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('field_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fields.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fields") || request()->is("admin/fields/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.field.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('suggest_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.suggests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/suggests") || request()->is("admin/suggests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.suggest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('suggests_value_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.suggests-values.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/suggests-values") || request()->is("admin/suggests-values/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.suggestsValue.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/statuses") || request()->is("admin/statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.status.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entities_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities-types") || request()->is("admin/entities-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entitiesType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entities_field_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities-fields.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities-fields") || request()->is("admin/entities-fields/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entitiesField.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entities_file_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities-files.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities-files") || request()->is("admin/entities-files/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entitiesFile.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fyles_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fyles-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fyles-types") || request()->is("admin/fyles-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.fylesType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('variation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.variations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/variations") || request()->is("admin/variations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.variation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entities_versioning_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities-versionings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities-versionings") || request()->is("admin/entities-versionings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entitiesVersioning.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('localization_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.localizations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/localizations") || request()->is("admin/localizations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.localization.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('reward_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.rewards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/rewards") || request()->is("admin/rewards/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.reward.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('entities_reward_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.entities-rewards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entities-rewards") || request()->is("admin/entities-rewards/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.entitiesReward.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                <li class="c-sidebar-nav-item">
                    <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                        <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                        </i>
                        <span>{{ trans("global.team-members") }}</span>
                    </a>
                </li>
            @endif
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>