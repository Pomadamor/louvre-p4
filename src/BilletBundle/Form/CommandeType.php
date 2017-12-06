<?php

namespace BilletBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
  /**
  * {@inheritdoc}
  */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('email',       EmailType::class)
    ->add('dateVisite',  DateType::class)
    ->add('journee',     ChoiceType::class, array(
      'choices'  => array(
        'Journee entiere' => true,
        'demi journee' => false,
        ),
      ))
    ->add('billets',     CollectionType::class, array(
           'entry_type'   => BilletType::class,
           'allow_add'    => true,
           'allow_delete' => true))
    ->add('Payer',      SubmitType::class);
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'BilletBundle\Entity\Commande'
      ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
      return 'billetbundle_commande';
  }
}
