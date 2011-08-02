<?php
/**
 * Created by JetBrains PhpStORM.
 * User: camm
 * Date: 2/08/11
 * Time: 9:47 AM
 * To change this template use File | Settings | File Templates.
 */

namespace MelbSymfony2\ForumExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column
     */
    protected $code;

}