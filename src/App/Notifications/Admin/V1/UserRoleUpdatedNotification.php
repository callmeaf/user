<?php

namespace Callmeaf\User\App\Notifications\Admin\V1;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRoleUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @var User $user
     */
    public function __construct(public $user,public array $attachedRolesNames,public array $detachedRolesNames,public array $updatedRolesNames)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

//    /**
//     * Determine which queues should be used for each notification channel.
//     *
//     * @return array<string, string>
//     */
//    public function viaQueues(): array
//    {
//        return [
//            'mail' => 'notifications',
//        ];
//    }

    /**
     * Determine which connections should be used for each notification channel.
     *
     * @return array<string, string>
     */
    public function viaConnections(): array
    {
        return [
            'database' => 'sync',
        ];
    }

//    /**
//     * Get the mail representation of the notification.
//     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        return (new MailMessage)->subject(
//            __('callmeaf-user::admin_v1.mail.roles_updated.subject')
//        )->markdown('callmeaf-user::admin.v1.mail.users.roles_updated',[
//            'url' => explode(',',config('app.frontend_url'))[0],
//        ]);
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "subject" => __('callmeaf-user::admin_v1.mail.roles_updated.notification_subject'),
            'payload' => __('callmeaf-user::admin_v1.mail.roles_updated.notification_payload',[
                'attached_roles' => implode(', ',$this->attachedRolesNames),
                'detached_roles' => implode(', ',$this->detachedRolesNames),
                'updated_roles' => implode(',',$this->updatedRolesNames),
            ]),
        ];
    }
}
