<?php

namespace SocialiteProviders\Lavishsoft;

use SocialiteProviders\Manager\SocialiteWasCalled;

class LavishsoftExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('lavishsoft', Provider::class);
    }
}
