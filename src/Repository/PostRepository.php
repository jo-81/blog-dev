<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findByCategory(Category $category): mixed
    {
        return $this->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where('c.id = :val')
            ->setParameter('val', $category)
            ->orderBy('p.id', 'ASC')
            ->andWhere('p.published = true')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategories(Post $post): mixed
    {
        return $this->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where('c.id IN (:val)')
            ->setParameter('val', $post->getCategories()->toArray())
            ->orderBy('p.id', 'ASC')
            ->andWhere('p.published = true')
            ->andWhere('p.id != '.$post->getId())
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}
