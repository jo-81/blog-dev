<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
#[ORM\HasLifecycleCallbacks]
class Admin extends User
{
    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->roles = ['ROLE_ADMIN'];
    }
}
