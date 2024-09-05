<?php

namespace App\Application\Enums;

enum Status: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SUCCESS = 'success';
    case ERROR = 'error';
}
