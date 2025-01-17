<?php

declare(strict_types=1);

namespace App\Models\Support\Enum;

enum RouteEnum: string
{
    case LOGIN = 'login';

    case AUTH_LOGIN = 'auth.login';

    case AUTH_LOGOUT = 'auth.logout';

    case POST_CREATE = 'post.create';

    case POST_UPDATE = 'post.update';

    case POST_LIST = 'post.list';

    case POST_SHOW = 'post.show';

    case POST_DELETE = 'post.delete';

    case VIDEO_CREATE = 'video.create';

    case VIDEO_CREATE_COMMENT = 'video.comment.create';

    case VIDEO_UPDATE = 'video.update';

    case VIDEO_LIST = 'video.list';

    case VIDEO_SHOW = 'video.show';

    case VIDEO_DELETE = 'video.delete';

    case PHOTO_CREATE = 'photo.create';

    case PHOTO_UPDATE = 'photo.update';

    case PHOTO_LIST = 'photo.list';

    case PHOTO_SHOW = 'photo.show';

    case PHOTO_DELETE = 'photo.delete';

    case COMMENT_CREATE = 'comment.create';

    case COMMENT_UPDATE = 'comment.update';

    case COMMENT_LIST = 'comment.list';

    case COMMENT_SHOW = 'comment.show';

    case COMMENT_DELETE = 'comment.delete';

}
