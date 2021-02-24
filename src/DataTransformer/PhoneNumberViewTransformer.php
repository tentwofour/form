<?php

namespace Ten24\Component\Form\Extension\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Ten24\Component\Formatter\PhoneNumberFormatter;

/**
 * Class PhoneNumberViewTransformer
 *
 * @package Ten24\Component\Form\Extension\DataTransformer
 */
class PhoneNumberViewTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    protected $phoneNumberFormat;

    /**
     * @param string $phoneNumberFormat
     */
    public function __construct($phoneNumberFormat = PhoneNumberFormatter::FORMAT_NA)
    {
        $this->phoneNumberFormat = $phoneNumberFormat;
    }

    /**
     * Transforms a formatted phone number (db-formatted) into one that
     * is readable
     *
     * 12324567890 => 1.232.456.7890
     *
     * @param mixed $formattedPhoneNumber
     *
     * @return mixed|void
     */
    public function transform($formattedPhoneNumber)
    {
        $phoneNumber = new PhoneNumberFormatter($formattedPhoneNumber, $this->phoneNumberFormat);

        return $phoneNumber->format();
    }

    /**
     * Transforms an unformatted phone number (user-inputted) into one that conforms to better
     * database standards - 15 characters, no special characters
     *
     * 1.232.456.7890 => 12324567890
     *
     * @param mixed $unformattedPhoneNumber
     *
     * @return mixed|void
     */
    public function reverseTransform($unformattedPhoneNumber)
    {
        $phoneNumber = new PhoneNumberFormatter($unformattedPhoneNumber, $this->phoneNumberFormat);

        return $phoneNumber->reverseFormat();
    }
}

