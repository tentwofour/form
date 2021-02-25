<?php

namespace Ten24\Component\Form\Extension\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Ten24\Component\Formatter\PostalCodeFormatter;

/**
 * Class PostalCodeViewTransformer
 *
 * @package Ten24\Component\Form\Extension\DataTransformer
 */
class PostalCodeViewTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    protected $postalCodeFormat;

    /**
     * @param string $postalCodeFormat
     */
    public function __construct($postalCodeFormat = PostalCodeFormatter::FORMAT_CANADA)
    {
        $this->postalCodeFormat = $postalCodeFormat;
    }

    /**
     * Transforms a formatted postal code (db-formatted) into one that is readable
     *
     * S4P0H0 => S4P 0H0
     *
     * @param string $formattedPostalCode
     *
     * @return string
     */
    public function transform($formattedPostalCode)
    {
        if (empty($formattedPostalCode)) {
            return '';
        }

        $postalCode = new PostalCodeFormatter($formattedPostalCode, $this->postalCodeFormat);

        return $postalCode->format();
    }

    /**
     * Transforms an unformatted postal code (user-inputted) into one that conforms to better
     * database standards - 6 characters max, no special characters
     *
     * S4P   0 H 0 => S4P0H0
     *
     * @param mixed $unformattedPostalCode
     *
     * @return string
     */
    public function reverseTransform($unformattedPostalCode)
    {
        if (empty($unformattedPostalCode)) {
            return '';
        }

        $postalCode = new PostalCodeFormatter($unformattedPostalCode, $this->postalCodeFormat);

        return $postalCode->reverseFormat();
    }
}

