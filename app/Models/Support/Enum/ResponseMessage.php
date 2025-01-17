<?php

declare(strict_types=1);

namespace App\Models\Support\Enum;

enum ResponseMessage: string
{
    case CREATE_SUCCESS = 'Records saved!';
    case PUT_SUCCESS = 'Records updated!';
    case ARCHIVE_SUCCESS = 'Records archived!';
    case DELETE_SUCCESS = 'Records deleted!';
    case RETRIEVE_SUCCESS = 'Record retrieved successfully!';
    case ERROR = 'An error occurred.';
    case LOGOUT_SUCCESS = 'User access token successfully deleted.';
    case AUTH_INVALID_CREDENTIAL = 'Invalid credentials.';
    case AUTH_INVALID_2FA_CODE = 'Invalid two-factor code';
    case USER_UPDATE_PROFILE_PERSONAL_INFORMATION_SUCCESS = 'Personal information updated successfully';
    case USER_UPDATE_2FA_AUTH_SETTINGS_SUCCESS = 'User 2fa auth settings updated.';
    case USER_UPDATE_EMAIL_SUCCESS = 'User email updated successfully.';
    case USER_UPDATE_MOBILE_SUCCESS = 'User mobile number updated successfully.';
    case USER_PASSWORD_MISMATCH = 'The current password does not match our records.';
    case USER_PASSWORD_UPDATE_SUCCESS = 'User updated password successfully.';
    case USER_RESET_PASSWORD_LINK_SENT = 'Reset password link sent.';
    case USER_RESET_PASSWORD_SUCCESS = 'Password reset successfully.';
    case USER_EMAIL_VERIFICATION_SENT = 'Email verification sent.';
    case NOT_FOUND = 'Records not found!';
    case EMAIL_NOT_VERIFIED = 'Email not yet verified. Verification link has been sent.';
    case EMAIL_ALREADY_VERIFIED = 'Email already verified.';
    case EMAIL_VERIFICATION_LINK_INVALID = 'Email verification link is invalid.';
    case INVALID_TOKEN = 'Invalid token.';
    case TEMPORARY_PASSWORD = 'Temporary password sent successfully.';
    case VALIDATE_BOOKING_SUCCESS = 'Booking data is valid.';
    case VALIDATE_BOOKING_ERROR = 'Booking data is invalid.';

}
