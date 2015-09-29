<?php

namespace Ten24\Tests\Component\Form\Extension\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Forms;
use Ten24\Component\Form\Extension\Type\HelpTypeExtension;

class HelpTypeTest extends \PHPUnit_Framework_TestCase
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
        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->builder    = new FormBuilder(null, null, $this->dispatcher, $this->factory);

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
        return 'text';
    }

    /**
     * Add a simple text field type to the form factory to test against
     *
     * @return array
     */
    protected function getTypes()
    {
        return [
            new TextType()
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
            new HelpTypeExtension()
        ];
    }
}