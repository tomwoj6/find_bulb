<?php

namespace UserBundle; 

use Symfony\Component\HttpKernel\Bundle\Bundle;
//use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
//use Symfony\Component\DependencyInjection\ContainerBuilder;


class UserBundle extends Bundle{
    
    //nadpisujemy mapowanie domyslnych encji FOS - mozna zmienic zapis ROLE w bazie
//    public function build(ContainerBuilder $container){
//        parent::build($container);
//        $mappings = array(
//            realpath(__DIR__ . '/Resources/config/doctrine-mapping') => 'FOS\UserBundle\Model',
//        );
//
//        $container->addCompilerPass(
//            DoctrineOrmMappingsPass::createXmlMappingDriver(
//                $mappings, array('fos_user.model_manager_name'), false
//            )
//        );
//    }
    //Pobieramy jako parenta FOS - pozwala na przeciazanie szablonow
    function getParent() {
        return 'FOSUserBundle';
    }
}
