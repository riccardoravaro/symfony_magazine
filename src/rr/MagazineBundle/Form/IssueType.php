<?php

namespace rr\MagazineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IssueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('datePublication', 'date', array(
                    'years' => range(date('Y'), date('Y', strtotime('-50 years'))),
                    'required' => TRUE,
                ))
            ->add('file')
            ->add('pubblication', 'entity', array(
                    'required' => TRUE,
                    'class' => 'rrMagazineBundle:pubblication'

                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'rr\MagazineBundle\Entity\Issue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rr_magazinebundle_issue';
    }
}
