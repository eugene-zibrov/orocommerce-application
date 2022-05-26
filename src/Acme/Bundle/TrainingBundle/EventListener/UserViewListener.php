<?php

namespace Acme\Bundle\TrainingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Oro\Bundle\UserBundle\Entity\User;

class UserViewListener
{
    public function onUserView(BeforeListRenderEvent $event)
    {
        /** @var User $user */
        $userEntity = $event->getEntity();
        if (!is_a($userEntity, User::class)) {
            return;
        }

        $template = $event->getEnvironment()->render(
            '@AcmeTraining/user/user_naming.html.twig',
            ['entity' => $userEntity]
        );

        $subBlockId = $event->getScrollData()->addSubBlock(0);
        $event->getScrollData()->addSubBlockData(0, $subBlockId, $template);
    }
}
