<?php

return [
    'mail' => [
        'roles_updated' => [
            'notification_subject' => 'Your roles has been updated.',
            'notification_payload' => "Your user roles have been updated by the system administrator.\n\n✅ Added roles: :attached_roles\n❌ Removed roles: :detached_roles\n🔄 Updated roles: :updated_roles"
        ]
    ]
];
