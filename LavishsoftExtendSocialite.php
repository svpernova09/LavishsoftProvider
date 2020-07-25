<?php

namespace SocialiteProviders\Lavishsoft;

use SocialiteProviders\Manager\SocialiteWasCalled;

class LavishsoftExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('lavishsoft', Provider::class);
    }
}
