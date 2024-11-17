<?php
namespace App\Enums;

enum TaskStatus: string
{


    case TO_DO = 'To Do';
    case IN_PROGRESS = 'In Progress';
    case DONE = 'Done';

    public static function getValues(): array
    {
        return [
            self::TO_DO->value,
            self::IN_PROGRESS->value,
            self::DONE->value,
        ];
    }

    public function displayName(): string
{
    return match ($this) {
        self::TO_DO => 'To Do',
        self::IN_PROGRESS => 'In Progress',
        self::DONE => 'Done',
    };
}


public static function isValidStatus(string $value): bool
{
    return in_array($value, self::getValues());
}



}
