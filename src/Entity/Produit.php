<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_cat_prod", columns={"id_cat_prod"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Prod", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProd;

    /**
     * @var int
     *
     * @ORM\Column(name="id_cat_prod", type="integer", nullable=false)
     */
    private $idCatProd;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Prod", type="string", length=20, nullable=false)
     */
    private $typeProd;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_Prod", type="text", length=65535, nullable=false)
     */
    private $descriptionProd;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix_Prod", type="integer", nullable=false)
     */
    private $prixProd;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=255, nullable=false)
     */
    private $url;

    public function getIdProd(): ?int
    {
        return $this->idProd;
    }

    public function getIdCatProd(): ?int
    {
        return $this->idCatProd;
    }

    public function setIdCatProd(int $idCatProd): self
    {
        $this->idCatProd = $idCatProd;

        return $this;
    }

    public function getTypeProd(): ?string
    {
        return $this->typeProd;
    }

    public function setTypeProd(string $typeProd): self
    {
        $this->typeProd = $typeProd;

        return $this;
    }

    public function getDescriptionProd(): ?string
    {
        return $this->descriptionProd;
    }

    public function setDescriptionProd(string $descriptionProd): self
    {
        $this->descriptionProd = $descriptionProd;

        return $this;
    }

    public function getPrixProd(): ?int
    {
        return $this->prixProd;
    }

    public function setPrixProd(int $prixProd): self
    {
        $this->prixProd = $prixProd;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }


}
