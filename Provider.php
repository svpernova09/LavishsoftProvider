<?php

namespace SocialiteProviders\Lavishsoft;

use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'LAVISHSOFT';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['lavish basic email'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://isboxer2.lavishsoft.com/getToken.php/authorize',
            $state
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://isboxer2.lavishsoft.com/getToken.php/access_token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://isboxer2.lavishsoft.com/me',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true)['user'];
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'name' => $user['display_name'],
            'email' => $user['email'],
            'is_admin' => $user['is_admin'],
            'is_support_team' => $user['is_support_team'],
            'is_subscriber' => $user['is_subscriber'],
            'account_status' => $user['account_status'],
            'has_isboxer_beta' => $user['has_isboxer_beta'],
            'has_isboxer2_beta' => $user['has_isboxer2_beta'],
            'subscription_expires' => $user['subscription_expires'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
