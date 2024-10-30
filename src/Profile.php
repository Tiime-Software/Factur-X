<?php

namespace Tiime\FacturX;

enum Profile: string
{
    case MINIMUM  = 'minimum';
    case BASICWL  = 'basicwl';
    case BASIC    = 'basic';
    case EN16931  = 'en16931';
    case EXTENDED = 'extended';
}
