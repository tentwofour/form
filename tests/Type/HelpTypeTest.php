<?php

namespace Ten24\Tests\Component\Form\Extension\Type;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Forms;
use Ten24\Component\Form\Extension\Type\HelpTypeExtension;

/**
 * Class HelpTypeTest
 *
 * @package Ten24\Tests\Component\Form\Extension\Type
 * @deprecated since 1.2, to be removed in 1.3, superceded by Symfony's Core type
 */
class HelpTypeTest extends TestCase
{
    /**
     * @var \Symfony\Component\Form\FormBuilder
     */
    protected $builder;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $factory;

    /**
     *
     */
    protected function setUp()
    {
        $this->factory    = Forms::createFormFactoryBuilder()
                                 ->addTypes($this->getTypes())
                                 ->addTypeExtensions($this->getTypeExtensions())
                                 ->getFormFactory();
        $this->dispatcher = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->builder    = $this->getMockClass('Symfony\Component\Form\FormBuilder', [], [
            'null', 'null', $this->dispatcher, $this->factory
        ]);
    }

    public function testSetInvalidYearsOption()
    {
        $help = 'Having trouble with the internets? Tell us about it.';
        $form = $this->factory->createNamed('__test___field',
            $this->getTestedType(),
            null,
            [
                'help' => $help,
            ]);

        $view = $form->createView();

        $this->assertSame($help, $view->vars['help']);
    }

    protected function getTestedType()
    {
        return TextType::class;
    }

    /**
     * Add a simple text field type to the form factory to test against
     *
     * @return array
     */
    protected function getTypes()
    {
        return [
            new TextType(),
        ];
    }

    /**
     * Add in our help type extension
     *
     * @return array
     */
    protected function getTypeExtensions()
    {
        return [
            new HelpTypeExtension(),
        ];
    }
}