<?php

namespace App\EventSubscriber;

use App\Event\ArticleExpressionCreated;
use App\Event\ArticlePublicationCreated;
use App\Event\ArticlePublicationDeleted;
use App\Event\ArticlePublicationUpdated;

use Google\Cloud\PubSub\MessageBuilder;
use Google\Cloud\PubSub\PubSubClient;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ArticleSubscriber implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ArticlePublicationCreated::NAME => 'onPublicationCreated',
            ArticlePublicationUpdated::NAME => 'onPublicationUpdated',
            ArticlePublicationDeleted::NAME => 'onPublicationDeleted',
            ArticleExpressionCreated::NAME => 'onExpressionCreated',
        ];
    }

    public function onPublicationCreated(ArticlePublicationCreated $event)
    {
        $pubsub = new PubSubClient([
            'projectId' => $projectId,
        ]);

        $topic = $pubsub->topic(getenv(ARTICLE_TOPIC));
        $topic->publish((new MessageBuilder)->setData($message)->build());

    }
    public function onPublicationUpdated(ArticlePublicationUpdated $event)
    {
        echo $event->getType();
        echo "<br>\n";
        echo $event->getName();
        echo "<br>\n";
    }

    public function onPublicationDeleted(ArticlePublicationDeleted $event)
    {
        echo $event->getType();
        echo "<br>\n";
        echo $event->getName();
        echo "<br>\n";
    }

    public function onExpressionCreated(ArticleExpressionCreated $event)
    {
        echo $event->getType();
        echo "<br>\n";
        echo $event->getName();
        echo "<br>\n";
    }
}
