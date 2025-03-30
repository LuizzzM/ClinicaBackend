<?php

namespace App;

enum ExamSchedulingStatusEnum: string
{
    case SCHEDULED = 'agendado';
    case COMPLETED = 'realizado';
    case CANCELED = 'cancelado';
}
