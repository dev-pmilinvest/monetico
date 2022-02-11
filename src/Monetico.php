<?php

namespace Pmilinvest\Monetico;

use Pmilinvest\Monetico\Exceptions\Exception;
use Pmilinvest\Monetico\Requests\AbstractRequest;
use Pmilinvest\Monetico\Responses\AbstractResponse;

class Monetico
{
    /** @var string */
    private $service_version = '3.0';

    /** @var string */
    const MAIN_REQUEST_URL =   'https://p.monetico-services.com';

    /** @var string */
    const MISC_REQUEST_URL = 'https://payment-api.e-i.com';

    /** @var string|null */
    private $eptCode =  null;

    /** @var string|null */
    private $securityKey =  null;

    /** @var string|null */
    private $companyCode = null;


    public function __construct(){
        $this->eptCode =  config('service_version');
        $this->securityKey =  config('service_version');
        $this->companyCode = config('service_version');
    }
    /**
     * Transform security key for seal
     *
     * @param string $key
     * @return string
     */
    public static function getUsableKey(string $key): string
    {
        $hexStrKey = substr($key, 0, 38);
        $hexFinal = '' . substr($key, 38, 2) . '00';

        $cca0 = ord($hexFinal);

        if ($cca0 > 70 && $cca0 < 97) {
            $hexStrKey .= chr($cca0 - 23) . $hexFinal[1];
        } else {
            if ($hexFinal[1] === 'M') {
                $hexStrKey .= $hexFinal[0] . '0';
            } else {
                $hexStrKey .= substr($hexFinal, 0, 2);
            }
        }

        return pack('H*', $hexStrKey);
    }

    /**
     * Return array fields required on bank interface
     *
     * @param AbstractRequest $request
     * @return array
     */
    public function getFields(AbstractRequest $request): array
    {
        $fields = $request->fieldsToArray(
            $this->eptCode,
            $this->companyCode,
            self::SERVICE_VERSION
        );

        $seal = $request->generateSeal(
            $this->securityKey,
            $fields
        );

        $fields = $request->generateFields(
            $seal,
            $fields
        );

        return $fields;
    }

    /**
     * Validate seal from response
     *
     * @param AbstractResponse $response
     * @return bool
     */
    public function validate(AbstractResponse $response): bool
    {
        $seal = $response->validateSeal(
            $this->eptCode,
            $this->securityKey
        );

        return $seal;
    }
}
