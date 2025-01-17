<?php

declare(strict_types=1);

namespace App\Models\Support\Enum;

use App\Models\Support\Traits\HasEnumCases;

enum EmailEnum: string
{
    use HasEnumCases;

    case SUBJECT_EMAIL_VERIFICATION = 'Hawaii.com - Verify your email';

    case SUBJECT_WELCOME_USER = 'Hawaii.com - Welcome to Hawaii.com';

    case SUBJECT_2FA_CODE = 'Hawaii.com - 2FA code';

    case SUBJECT_PASSWORD_RESET = 'Hawaii.com - Password reset';

    case SUBJECT_TEMPORARY_PASSWORD = 'Hawaii.com - Temporary password';

}
