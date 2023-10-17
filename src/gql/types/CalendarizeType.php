<?php

namespace unionco\calendarize\gql\types;

use craft\gql\GqlEntityRegistry;
use craft\helpers\Gql;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CalendarizeType {
    public static function getName(): string
    {
        return 'calendarize_Calendarize';
    }

    public static function getType(): Type
    {
        if ($type = GqlEntityRegistry::getEntity(self::class)) {
            return $type;
        }

        return GqlEntityRegistry::createEntity(self::class, new ObjectType([
            'name' => static::getName(),
            'fields' => self::class . '::getFieldDefinitions',
            'description' => 'This is the interface implemented by all calendarize fields.',
        ]));
    }

    public static function getFieldDefinitions(): array
    {
        return [
            'next' => [
                'name' => 'next',
                'type' => Type::listOf(Type::int()),
                'description' => 'The next occurrence of this event',
                'resolve' => function($source, $args, $context, $info) {
                    return [$source->next()->start->getTimestamp(), $source->next()->end->getTimestamp()];
                }
            ],
            'occurrences' => [
                'name' => 'occurrences',
                'type' => Type::listOf(Type::listOf(Type::int())),
                'complexity' => Gql::singleQueryComplexity(),
                'description' => 'All occurrences of this event',
                'resolve' => function($source, $args, $context, $info) {
                    $timestamps = [];

                    $occurrences = $source->getOccurrences(500);
                    foreach($occurrences as $occurrence) {
                        $timesstamps[] = [$occurrence->start->getTimestamp(), $occurrence->end->getTimestamp()];
                    }
                    return $timesstamps;
                },
            ],
        ];
    }
}
