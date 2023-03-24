<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;

class UserProcessor implements ProcessorInterface
{

    public function __construct(private ProcessorInterface $persistProcessor, private Security $security)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $client = $this->security->getUser();
        $data->setClient($client);
        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);
        return $result;
    }
}