<?php 

namespace Application\Security\Auth;

enum UserSessionKey: string {
    case ID = 'userId';
    case NAME = 'userName';
    case AVATAR_URL = 'avatarUrl';
}