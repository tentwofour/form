<?php

namespace Ten24\Component\Form\Extension\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class HelpTypeExtension
 *
 * @package Ten24\Component\Form\Extension\Type
 * @deprecated since 1.2, to be removed in 1.3, superceded by Symfony's Core type
 */
class HelpTypeExtension extends AbstractTypeExtension
{
    /**
     * HelpTypeExtension constructor.
     *
     * This extension is deprecated
     */
    public function __construct(){
        if (class_exists('\Symfony\Component\HttpKernel\Kernel') && \Symfony\Component\HttpKernel\Kernel::VERSION >= 4.1) {
            @trigger_error(__CLASS__.'\ is deprecated since version 1.2 and will be removed in 1.3, use the built-in Symfony Core FormType instead.', \E_USER_DEPRECATED);
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null !== $options['help']) {
            $builder->setAttribute('help', $options['help']);
        }
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['help'])) {
            $view->vars['help'] = $options['help'];
        }
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'help' => null,
        ]);
    }

    /**
     * 4.2 BC layer
     * @return iterable
     */
    public function getExtendedType(): iterable
    {
        return static::getExtendedTypes();
    }

    /**
     * @return iterable
     */
    static public function getExtendedTypes(): iterable
    {
        return [FormType::class];
    }
}