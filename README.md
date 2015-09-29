# form
Symfony2 Form extensions

## DataTransformers

### PhoneNumberViewTransformer

Transforms phone numbers from human-formatted (ie. +1 (123) 555-5555) to db-formatted (ie. +11235555555) values.
Database field (MySQL) of varchar(15) is sufficient to store phone numbers

#### Transform

```php
$pn = '+111234567890';
$f = new PhoneNumberViewTransformer();
$formatted = $f->transform($pn);
echo $formatted;
// Outputs: '+11 (123) 456-7890'
```

#### ReverseTransform

```php
$pn = '+(11) 123-456-7890';
$f = new PhoneNumberViewTransformer();
$formatted = $f->reverseTransform($pn);
echo $formatted;
// Outputs: '+111234567890';
```

#### Use with Symfony2 Form

```php

// src/AppBundle/Form/ProfileType.php

use Symfony\Component\Form\AbstractType;
use Ten24\Component\Form\Extension\DataTransformer;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,
                              array $options)
    {
        $transformer = new PhoneNumberViewTransformer();
        // Optionally change the display format, see PhoneNumberFormatter for all possible values
        // $transformer->setDisplayFormat(PhoneNumberFormtter::FORMAT_DOTTED)

        $builder->add($builder
                              ->create('phoneNumber1',
                                       null,
                                       [
                                           'required' => true,
                                           'attr'     => [
                                               'placeholder' => 'eg. 1.123.456.7890 or 1 (123) 456-7890'
                                           ]
                                       ])
                              ->addViewTransformer($transformer)
        );

        // ...
    }
```

## PostalCodeViewTransformer

Transforms a postal code from human-formatted (ie. S4T 3P9) to db-formatted (ie. S4T3P9) values.
Database field (MySQL) of varchar(15) is sufficient to store postal codes (North America)

Supports North America postal codes only.

### Transform

```php
$postalCode = 'S4p0H0';
$formatter = new PostalCodeViewTransformer();
$formatted = $formatter->transform($postalCode);
echo $formatted;
// Outputs: 'S4P 0H0'
```

### Reverse Transform

```php
$postalCode = 'S4p 0H0 ';
$formatter = new PostalCodeViewTransformer();
$formatted = $formatter->reverseTransform($postalCode);
echo $formatted;
// Outputs: 'S4P0H0'
```

#### Use with Symfony2 Form

```php

// src/AppBundle/Form/ProfileType.php

use Symfony\Component\Form\AbstractType;
use Ten24\Component\Form\Extension\DataTransformer;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,
                              array $options)
    {
        $transformer = new PostalCodeViewTransformer();

        $builder->add($builder
                              ->create('postalCode',
                                       null,
                                       [
                                           'required' => true,
                                       ])
                              ->addViewTransformer($transformer)
        );

        // ...
    }
```
