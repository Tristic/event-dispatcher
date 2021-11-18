<?php

namespace App\EventSubscriber;

use App\Event\SiteCreated;
use App\Event\SiteDeleted;
use App\Event\SiteUpdated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SiteSubscriber implements EventSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            SiteCreated::NAME => 'onSiteCreated',
            SiteDeleted::NAME => 'onSiteDeleted',
            SiteUpdated::NAME => 'onSiteUpdated',
        ];
    }
}
