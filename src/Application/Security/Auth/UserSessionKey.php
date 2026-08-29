<?php 

namespace Application\Security\Auth;

/**
 * The enum UserSessionKey contains all the keys about the information 
 * stored about the user during a session.
 */
enum UserSessionKey: string {

    /**
     * User's ID key.
     */
    case ID = 'userId';

    /**
     * User's name key.
     */
    case NAME = 'userName';

    /** 
     * User's avatar url key. 
    */
    case AVATAR_URL = 'avatarUrl';

    /** 
     * User's verification status key.
    */
    case VERIFIED = 'userVerified';
}