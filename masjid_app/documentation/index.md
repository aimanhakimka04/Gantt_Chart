# Documentation Index

This index is automatically generated and lists all documentation files:

* **app/**
  * **Console/**
    * **Commands/**
      * [Documentation: MigrateToNewUserSystem.php](app\Console\Commands\MigrateToNewUserSystem.md)
  * **Http/**
    * **Controllers/**
      * **Auth/**
        * [Documentation: AuthenticatedSessionController.php](app\Http\Controllers\Auth\AuthenticatedSessionController.md)
        * [Documentation: ConfirmablePasswordController.php](app\Http\Controllers\Auth\ConfirmablePasswordController.md)
        * [Documentation: EmailVerificationNotificationController.php](app\Http\Controllers\Auth\EmailVerificationNotificationController.md)
        * [Documentation: EmailVerificationPromptController.php](app\Http\Controllers\Auth\EmailVerificationPromptController.md)
        * [Documentation: NewPasswordController.php](app\Http\Controllers\Auth\NewPasswordController.md)
        * [Documentation: PasswordController.php](app\Http\Controllers\Auth\PasswordController.md)
        * [Documentation: PasswordResetLinkController.php](app\Http\Controllers\Auth\PasswordResetLinkController.md)
        * [Documentation: RegisteredUserController.php](app\Http\Controllers\Auth\RegisteredUserController.md)
        * [Documentation: VerifyEmailController.php](app\Http\Controllers\Auth\VerifyEmailController.md)
      * [Documentation: AdminController.php](app\Http\Controllers\AdminController.md)
      * [Documentation: ChatController.php](app\Http\Controllers\ChatController.md)
      * [Documentation: Controller.php](app\Http\Controllers\Controller.md)
      * [Documentation: EventController.php](app\Http\Controllers\EventController.md)
      * [Documentation: ProfileController.php](app\Http\Controllers\ProfileController.md)
      * [Documentation: SolatController.php](app\Http\Controllers\SolatController.md)
    * **Middleware/**
      * [Documentation: AdminMiddleware.php](app\Http\Middleware\AdminMiddleware.md)
    * **Requests/**
      * **Auth/**
        * [Documentation: LoginRequest.php](app\Http\Requests\Auth\LoginRequest.md)
      * [Documentation: ProfileUpdateRequest.php](app\Http\Requests\ProfileUpdateRequest.md)
    * [Documentation: Kernel.php](app\Http\Kernel.md)
  * **Models/**
    * [Documentation: Committee.php](app\Models\Committee.md)
    * [Documentation: Event.php](app\Models\Event.md)
    * [Documentation: Participant.php](app\Models\Participant.md)
    * [Documentation: Registration.php](app\Models\Registration.md)
    * [Documentation: ServiceRequest.php](app\Models\ServiceRequest.md)
    * [Documentation: User.php](app\Models\User.md)
  * **Notifications/**
    * [Documentation: EventReminder.php](app\Notifications\EventReminder.md)
  * **Providers/**
    * [Documentation: AppServiceProvider.php](app\Providers\AppServiceProvider.md)
    * [Documentation: RouteServiceProvider.php](app\Providers\RouteServiceProvider.md)
  * **View/**
    * **Components/**
      * [Documentation: AppLayout.php](app\View\Components\AppLayout.md)
      * [Documentation: GuestLayout.php](app\View\Components\GuestLayout.md)
* **config/**
  * [Documentation: app.php](config\app.md)
  * [Documentation: auth.php](config\auth.md)
  * [Documentation: cache.php](config\cache.md)
  * [Documentation: database.php](config\database.md)
  * [Documentation: docudoodle.php](config\docudoodle.md)
  * [Documentation: filesystems.php](config\filesystems.md)
  * [Documentation: logging.php](config\logging.md)
  * [Documentation: mail.php](config\mail.md)
  * [Documentation: openai.php](config\openai.md)
  * [Documentation: queue.php](config\queue.md)
  * [Documentation: services.php](config\services.md)
  * [Documentation: session.php](config\session.md)
* **database/**
  * **factories/**
    * [Documentation: ParticipantFactory.php](database\factories\ParticipantFactory.md)
    * [Documentation: UserFactory.php](database\factories\UserFactory.md)
  * **migrations/**
    * [Documentation: 0001_01_01_000000_create_users_table.php](database\migrations\0001_01_01_000000_create_users_table.md)
    * [Documentation: 0001_01_01_000001_create_cache_table.php](database\migrations\0001_01_01_000001_create_cache_table.md)
    * [Documentation: 0001_01_01_000002_create_jobs_table.php](database\migrations\0001_01_01_000002_create_jobs_table.md)
    * [Documentation: 2025_01_20_000000_create_participants_table.php](database\migrations\2025_01_20_000000_create_participants_table.md)
    * [Documentation: 2025_01_20_000001_create_committees_table.php](database\migrations\2025_01_20_000001_create_committees_table.md)
    * [Documentation: 2025_07_30_030502_add_is_admin_to_users_table.php](database\migrations\2025_07_30_030502_add_is_admin_to_users_table.md)
    * [Documentation: 2025_07_31_032710_create_events_table.php](database\migrations\2025_07_31_032710_create_events_table.md)
    * [Documentation: 2025_08_04_105800_add_capacity_to_events_table.php](database\migrations\2025_08_04_105800_add_capacity_to_events_table.md)
    * [Documentation: 2025_08_04_105900_create_registrations_table.php](database\migrations\2025_08_04_105900_create_registrations_table.md)
    * [Documentation: 2025_08_11_030550_create_service_requests_table.php](database\migrations\2025_08_11_030550_create_service_requests_table.md)
    * [Documentation: 2025_08_15_035405_add_venue_to_events_table.php](database\migrations\2025_08_15_035405_add_venue_to_events_table.md)
    * [Documentation: 2025_08_15_040417_add_date_to_service_request_table.php](database\migrations\2025_08_15_040417_add_date_to_service_request_table.md)
    * [Documentation: 2025_08_20_000004_drop_users_table.php](database\migrations\2025_08_20_000004_drop_users_table.md)
  * **seeders/**
    * [Documentation: DatabaseSeeder.php](database\seeders\DatabaseSeeder.md)
    * [Documentation: MigrateUsersToParticipantsSeeder.php](database\seeders\MigrateUsersToParticipantsSeeder.md)
* **routes/**
  * [Documentation: auth.php](routes\auth.md)
  * [Documentation: console.php](routes\console.md)
  * [Documentation: web.php](routes\web.md)
