<?php

namespace Training\Bundle\UserNamingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettingsTransport;

class UserNamingIntegrationSettingsFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'url',
            UrlType::class,
            [
                'label' => 'oro.zendesk.zendeskresttransport.url.label',
                'required' => true,
                'tooltip' => 'oro.zendesk.form.zendesk_url.description',
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserNamingSettingsTransport::class,
        ]);
    }

}
