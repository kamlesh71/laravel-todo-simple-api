<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TASK_NEW = 'new';
    case TASK_COMPLETED  = 'completed';
    case TASK_INCOMPLETE = 'incomplete';
}
