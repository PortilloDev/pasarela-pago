<?php


namespace App\Resolvers;

use App\PaymentPlatform;
use Exception;

class PaymentPlatformResolver
{
    protected $paymentPlataforms;

    public function __construct()
    {
        $this->paymentPlataforms = PaymentPlatform::all();
    }

    public function resolveService($paymentPlatformId) {
        $name = strtolower($this->paymentPlataforms->firstWhere('id', $paymentPlatformId));

        $service = config("services.{$name}.class");

        if($service) {
            return resolve($service);
        }

        throw new Exception('The selected payment platform is not in the configuration');
    }
}
